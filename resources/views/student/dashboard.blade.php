@extends('layouts.app')

@section('content')

<aside class="main-sidebar sidebar-dark-primary">
  <!-- Brand Logo -->
  <a href="#" class="brand-link text-white pt-3 d-flex align-items-center">
    <img src="{{ url('images/logo-uso.svg') }}" alt="Logo" class="text-white pl-2" style="width: 3rem;">
    <span class="brand-text font-weight-bold" style="font-size: 2.5rem;">AEFI</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        @if(Auth::user()->user_type == 1)
        <li class="nav-item">
          <a href="{{ url('admin/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('admin/admin/list') }}" class="nav-link @if(Request::segment(2) == 'admin') active @endif">
            <i class="nav-icon far fa-user"></i>
            <p>Admin</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('admin/class/list') }}" class="nav-link @if(Request::segment(2) == 'class') active @endif">
            <i class="nav-icon far fa-user"></i>
            <p>Clases</p>
          </a>
        </li>
        @elseif(Auth::user()->user_type == 2)
        <li class="nav-item">
          <a href="{{ url('teacher/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <!-- Otras secciones específicas para maestros -->

        @elseif(Auth::user()->user_type == 3)
        <li class="nav-item">
          <a href="{{ url('student/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <!-- Otras secciones específicas para estudiantes -->

        @elseif(Auth::user()->user_type == 4)
        <li class="nav-item">
          <a href="{{ url('parent/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
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
  <div class="content-header">
    <h1 class="text-4xl font-extrabold text-center mt-8">🌟 ¡BIENVENIDO A LA PLATAFORMA "AEFI" 🌟</h1>
    <h2 class="text-2xl font-semibold text-center mb-8">MIRA LAS ACTIVIDADES RECIENTES</h2>
  </div>

  <div class="flex justify-center items-center md:items-start md:justify-start min-h-screen p-4">
    <div class="flex flex-col md:flex-row gap-4 p-4 max-w-7xl mx-auto w-full">
      <div class="card bg-white dark:bg-zinc-800 shadow-md rounded-lg overflow-hidden w-full md:w-1/3 max-w-md transform transition-transform duration-300 hover:scale-105 relative group">
        <img src="{{ url('images/internetUSO.jpeg') }}" alt="Card 1" class="w-full h-48 object-cover" />
        <div class="p-4">
          <h2 class="text-xl font-bold text-green-600 dark:text-green-400">DÍA DEL INTERNET USO</h2>
          <button onclick="toggleDescription('desc1')" class="mt-2 text-blue-500">17/05/2024</button>
          <p id="desc1" class="hidden mt-2 text-zinc-600 dark:text-zinc-400">
            This is the description for card 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
        </div>
        <div class="absolute inset-0 bg-gradient-to-br from-green-500 via-green-600 to-green-700 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          <p class="p-4">
            This is the description for card 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
        </div>
      </div>
      <div class="card bg-white dark:bg-zinc-800 shadow-md rounded-lg overflow-hidden w-full md:w-1/3 max-w-md transform transition-transform duration-300 hover:scale-105 relative group">
        <img src="{{ url('images/charlasUSO.jpeg') }}" alt="Card 2" class="w-full h-48 object-cover" />
        <div class="p-4">
          <h2 class="text-xl font-bold text-purple-600 dark:text-purple-400">CHARLAS A INSTITUTOS</h2>
          <button onclick="toggleDescription('desc2')" class="mt-2 text-blue-500">24/04/2024</button>
          <p id="desc2" class="hidden mt-2 text-zinc-600 dark:text-zinc-400">
            This is the description for card 2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
        </div>
        <div class="absolute inset-0 bg-gradient-to-br from-green-500 via-green-600 to-green-700 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          <p class="p-4">
            This is the description for card 2. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
        </div>
      </div>
      <div class="card bg-white dark:bg-zinc-800 shadow-md rounded-lg overflow-hidden w-full md:w-1/3 max-w-md transform transition-transform duration-300 hover:scale-105 relative group">
        <img src="{{ url('images/congresoUSO.jpeg') }}" alt="Card 3" class="w-full h-48 object-cover" />
        <div class="p-4">
          <h2 class="text-xl font-bold text-indigo-600 dark:text-indigo-400">CONGRESOS DE INGENIERÍA</h2>
          <button onclick="toggleDescription('desc3')" class="mt-2 text-blue-500">18/11/2023</button>
          <p id="desc3" class="hidden mt-2 text-zinc-600 dark:text-zinc-400">
            This is the description for card 3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
        </div>
        <div class="absolute inset-0 bg-gradient-to-br from-green-500 via-green-600 to-green-700 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          <p class="p-4">
            This is the description for card 3. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
        </div>
      </div>
    </div>
  </div>

  <script>
    function toggleDescription(id) {
      const desc = document.getElementById(id);
      desc.classList.toggle('hidden');
    }
  </script>

</div>
<!-- /.content-wrapper -->

@endsection
