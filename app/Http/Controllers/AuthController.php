<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Cloudinary\Cloudinary;
// Use Composer to manage your PHP library dependency
// require DIR . '/vendor/autoload.php';

use Cloudinary\Configuration\Configuration;
// Use the SearchApi class for searching assets
use Cloudinary\Api\Search\SearchApi;
// Use the AdminApi class for managing assets
use Cloudinary\Api\Admin\AdminApi;
// Use the UploadApi class for uploading assets
use Cloudinary\Api\Upload\UploadApi;

Configuration::instance('cloudinary://752128321289437:nrQ7Hp0MvkMLMeGWxydz4QWXyNA@dubdppkki?secure=true');

class AuthController extends Controller
{
   
    public function login(){
        //dd(Hash::make(123456));
   
         if(!empty(Auth::check())){
                
           if(Auth::user()->user_type == 1){
               return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type == 2){
               return redirect('teacher/dashboard');
            }
            else if(Auth::user()->user_type == 3){
               return redirect('student/dashboard');
            }
            else if(Auth::user()->user_type == 4){
               return redirect('parent/dashboard');
            }
         }
   
          return view('auth.login');
        
      }

   

    public function AuthLogin(Request $request)
    {
        $remember = !empty($request->remember);
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            
            // Obtener el usuario autenticado
            $user = Auth::user();

            if(Auth::user()->user_type == 1){
                return redirect('admin/dashboard')->with('welcomeMessage', '¡Bienvenido al sistema, ' . $user->name . '!');;
             }
             else if(Auth::user()->user_type == 2){
                return redirect('teacher/dashboard')->with('welcomeMessage', '¡Bienvenido al sistema, ' . $user->name . '!');;
             }
             else if(Auth::user()->user_type == 3){
                return redirect('student/dashboard')->with('welcomeMessage', '¡Bienvenido al sistema, ' . $user->name . '!');;
             }
             else if(Auth::user()->user_type == 4){
                return redirect('parent/dashboard')->with('welcomeMessage', '¡Bienvenido al sistema, ' . $user->name . '!');;
             }

        } else {
            return redirect()->back()->with('error', 'Por favor introduzca las credenciales correctas');
        }
    }

    public function showRegisterForm()
   {
    return view('auth.register');
   }


   public function registerUser(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'email' => [
            'required',
            'email',
            Rule::unique('users')->ignore($request->user()),
            'max:250',
            function ($attribute, $value, $fail) {
                // Verificar si el correo electrónico es de Gmail o del dominio usonsonate.edu.sv
                if (
                    !filter_var($value, FILTER_VALIDATE_EMAIL) || // Asegurarse de que sea una dirección de correo electrónico válida
                    strpos($value, '@gmail.com') === false &&
                    strpos($value, '@usonsonate.edu.sv') === false
                ) {
                    $fail('No se permiten correos temporales o con el dominio ingresado.');
                }
            },
        ],
        'password' => [
            'required',
            'min:8',
            'confirmed',
            function ($attribute, $value, $fail) {
                // Verificar si la contraseña cumple con los requisitos deseados
                if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[$._@$!%*#?&])[A-Za-z\d$._@$!%*#?&]{8,}$/', $value)) {
                    $fail('La contraseña debe contener al menos una letra, un número y uno de los siguientes caracteres especiales: $._@$!%*#?&');
                }
            },
        ],
        'user_photo' => [
            'nullable',
            'image',
            'max:2048',
            'mimes:jpeg,png,jpg,webp,bmp', // Añadir los formatos permitidos (excluir gif y svg)
        ],
    ]);

    if ($validator->fails()) {
        // Redirigir de vuelta con mensajes de error y datos de entrada
        return redirect()->back()->withErrors($validator)->withInput();
    }

    try {
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_photo' => null
        ]);        
    
        if ($request->hasFile('user_photo')) {
            $imageFile = $request->file('user_photo');
        
            // Configuración de Cloudinary (reemplaza con tus propias credenciales)
            Configuration::instance([
                'cloud' => [
                    'cloud_name' => 'dubdppkki',
                    'api_key'    => '752128321289437',
                    'api_secret' => 'nrQ7Hp0MvkMLMeGWxydz4QWXyNA',
                ],
                'url' => [
                    'secure' => true,
                ],
            ]);
        
            // Crear una instancia de Cloudinary
            $cloudinary = new Cloudinary();
        
            // Crear una instancia de UploadApi
            $uploadApi = $cloudinary->uploadApi();
        
            // Subir la imagen a Cloudinary
            $result = $uploadApi->upload($imageFile->getRealPath(), ['folder' => 'user-profile']);
        
            // Obtener la URL de la imagen subida
            $imageUrl = $result['secure_url'];
        
            // Actualizar el campo 'user_photo' en la base de datos con la URL de la imagen en Cloudinary
            $user->update(['user_photo' => $imageUrl]);
        }
         else {
            $user->update(['user_photo' => 'https://res.cloudinary.com/dubdppkki/image/upload/v1709234706/user-profile/shh2inrxlfejbdxl3fcn.jpg']);
        }


        // Autenticar al usuario
        if (Auth::login($user)) {
            // Redirigir al dashboard según el tipo de usuario
            switch ($user->user_type) {
                case 3:
                dd(session('welcomeMessage'));
                return redirect('student/dashboard')->with('welcomeMessage', 'Cuenta creada con éxito. ¡Bienvenido , ' . $request->name . '!');                
                default:
                    return redirect(url(''))->with('success', 'Cuenta creada con éxito, inicia sesión con tus credenciales.');
            }
        }

        return redirect(url(''))->with('error', 'Error al autenticar al usuario. Inténtalo de nuevo.');

    } catch (\Exception $e) {
        // Manejar el error (por ejemplo, redirigir de vuelta con un mensaje de error)
        return redirect()->back()->with('error', 'Ha ocurrido un error al crear la cuenta. Detalles del error: ' . $e->getMessage());
    }
    }

    public function forgotpassword()
    {
      return view('auth.forgot');
    }   


    public function PostForgotPassword(Request $request){
      //dd($request->all());

      $user = User::getEmailSingle($request->email);
      if(!empty($user)){
         
         $user->remember_token = Str::random(30);
         $user->save();
         Mail::to($user->email)->send(new ForgotPasswordMail($user));
         return redirect()->back()->with('success',"Por favor revise su Email y restablezca su contraseña. ");
         

      }else {
           return redirect()->back()->with('error','El email no fue encontrado en el sistema. ');

      }

    }
   

    public function reset($remember_token){
       $user = User::getTokenSingle($remember_token);

       if (!empty($user)){

         $data['user'] = $user;
         return view('auth.reset', $data);

       }else{
         abort(404);
       }
     
    }



    public function PostReset($token, Request $request){

     if($request->password == $request->cpassword){
       
      $user = User::getTokenSingle($token);
      $user->password = Hash::make($request->password);
      $user->remember_token = Str::random(30);
      $user->save();

      return redirect(url(''))->with('success','Contraseña correctamente restablecida.');

     }else{

      return redirect()->back()->with('error','Contraseñas no coinciden. ');

     }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('');
    }
}