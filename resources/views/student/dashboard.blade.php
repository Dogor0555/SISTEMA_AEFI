@extends('layouts.app')

@section('content')

<aside class="main-sidebar bg-dark">
  <!-- Brand Logo -->
  <a href="#" class="brand-link text-white d-flex align-items-center py-3">
    <img src="{{ secure_asset('images/logo-uso.svg') }}" alt="Logo" class="pl-2" style="width: 3rem;">
    <span class="brand-text font-weight-bold ml-3" style="font-size: 2.5rem;">AEFI</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        @if(Auth::user()->user_type == 1)
        <li class="nav-item">
          <a href="{{ secure_asset('admin/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ secure_asset('admin/admin/list') }}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
            <i class="nav-icon far fa-user"></i>
            <p>Admin</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ secure_asset('admin/class/list') }}" class="nav-link @if(Request::segment(2) == 'class') active @endif">
            <i class="nav-icon far fa-user"></i>
            <p>Clases</p>
          </a>
        </li>
        @elseif(Auth::user()->user_type == 2)
        <li class="nav-item">
          <a href="{{ secure_asset('teacher/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <!-- Otras secciones específicas para maestros -->

        @elseif(Auth::user()->user_type == 3)
        <li class="nav-item">
          <a href="{{ secure_asset('student/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <!-- Otras secciones específicas para estudiantes -->

        @elseif(Auth::user()->user_type == 4)
        <li class="nav-item">
          <a href="{{ secure_asset('parent/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <!-- Otras secciones específicas para padres -->

        @endif

        <li class="nav-item">
          <a href="{{ url('logout') }}" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Cerrar Sesión</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<div class="content-wrapper">
  <div class="content-header text-center my-4">
    <h1 class="display-4 font-weight-bold">🌟 ¡BIENVENIDO A LA PLATAFORMA "AEFI" 🌟</h1>
    <h2 class="h4 font-weight-semibold mb-4">MIRA LAS ACTIVIDADES RECIENTES</h2>
  </div>

  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="row w-100">
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
          <img src="{{ secure_asset('images/internetUSO.jpeg') }}" class="card-img-top" alt="Card 1">
          <div class="card-body">
            <h5 class="card-title text-success">DÍA DEL INTERNET USO</h5>
            <button class="btn btn-link p-0" onclick="toggleDescription('desc1')">17/05/2024</button>
            <p id="desc1" class="card-text d-none mt-2">
              This is the description for card 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </p>
          </div>
          <div class="card-footer text-white bg-success d-flex justify-content-center align-items-center d-none" id="overlay1">
            <p class="m-0">
              En el marco de la celebración del Día del Internet en la USO, se llevaron a cabo diversas actividades destacadas. El evento incluyó ponencias en el auditorio Los Fundadores, donde reconocidos profesionales nacionales e internacionales disertaron sobre la accesibilidad web y la generación de código libre, proporcionando valiosos conocimientos y perspectivas sobre estos temas cruciales.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
          <img src="{{ secure_asset('images/charlasUSO.jpeg') }}" class="card-img-top" alt="Card 2">
          <div class="card-body">
            <h5 class="card-title text-purple">CHARLAS A INSTITUTOS</h5>
            <button class="btn btn-link p-0" onclick="toggleDescription('desc2')">24/04/2024</button>
            <p id="desc2" class="card-text d-none mt-2">
              This is the description for card 2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </p>
          </div>
          <div class="card-footer text-white bg-purple d-flex justify-content-center align-items-center d-none" id="overlay2">
            <p class="m-0">
              Las directivas de Ingeniería en Sistemas e Innovación y Tecnologías Humanitarias de la USO han estado activamente impartiendo charlas técnicas sobre la privacidad y seguridad de los datos en varias instituciones educativas, reforzando su compromiso con la labor social y el desarrollo tecnológico en El Salvador.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
          <img src="{{ secure_asset('images/congresoUSO.jpeg') }}" class="card-img-top" alt="Card 3">
          <div class="card-body">
            <h5 class="card-title text-indigo">CONGRESOS DE INGENIERÍA</h5>
            <button class="btn btn-link p-0" onclick="toggleDescription('desc3')">18/11/2023</button>
            <p id="desc3" class="card-text d-none mt-2">
              This is the description for card 3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </p>
          </div>
          <div class="card-footer text-white bg-indigo d-flex justify-content-center align-items-center d-none" id="overlay3">
            <p class="m-0">
              La Asociación Estudiantil de la Facultad de Ingeniería, desarrollo la CUARTA EDICIÓN DEL CONGRESO DE ESTUDIANTES DE INGENIERÍA UNIVERSIDAD DE SONSONATE.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function toggleDescription(id) {
      const desc = document.getElementById(id);
      desc.classList.toggle('d-none');
    }
  </script>

</div>
<!-- /.content-wrapper -->

@endsection
