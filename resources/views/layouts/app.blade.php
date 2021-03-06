<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>{{ $title or config('app.name') }}</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
  
  <!-- Ionicons -->
  <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">

  <!-- Google Font: Source Sans Pro -->
  <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  @stack('css')
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#">
            <i class="fa fa-bars"></i>
          </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="{{ route('dashboard') }}" class="nav-link">{{ __('Home') }}</a>
        </li>
        @auth
          <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('profile') }}" class="nav-link">{{ __('Profile') }}</a>
          </li>
        @else
          <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('login') }}" class="nav-link">{{ __('Login') }}</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('register') }}" class="nav-link">{{ __('Register') }}</a>
          </li>
        @endif
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
      </form>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-comments-o"></i>
            <span class="badge badge-danger navbar-badge">
              {{ optional(auth()->user()->unreadNotifications)->count() }}
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            @foreach (optional(auth()->user())->unreadNotifications as $notification)
            <a href="{{ route('notification.redirect', $notification) }}" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="{{ $notification['data']['image'] }}" alt="{{ $notification['data']['image'] }}" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    {{ $notification['data']['title'] }}
                    <span class="float-right text-sm text-{{ $notification['data']['type'] ?? 'info' }}">
                      <i class="fa fa-star"></i>
                    </span>
                  </h3>
                  <p class="text-sm">
                    {{ str_limit($notification['data']['text'], 40) }}
                  </p>
                  <p class="text-sm text-muted">
                    <i class="fa fa-clock-o mr-1"></i> {{ $notification->created_at->diffForHumans() }}</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            @endforeach

            <a href="{{ route('profile') }}" class="dropdown-item dropdown-footer">{{ __('See all notifications') }}</a>
          </div>
        </li>

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-bell-o"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fa fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fa fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fa fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        @endauth

        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
            <i class="fa fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('dashboard') }}" class="brand-link">
        {{-- <img src="{{ asset('img/AdminLTELogo.png') }}" alt="{{ config('app.name') }}" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        @auth
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ optional(auth()->user())->gravatar ?? 'http://via.placeholder.com/128x128' }}" class="img-circle elevation-2"
              alt="{{ optional(auth()->user())->name }}">
          </div>
          <div class="info">
            <a href="{{ route('profile') }}" class="d-block">
              {{ optional(auth()->user())->name }}
            </a>
          </div>
        </div>
        @endauth

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @auth
            <li class="nav-item">
              <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="nav-icon fa fa-dashboard"></i>
                <p>{{ __('Dashboard') }}</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('widget') }}" class="nav-link {{ request()->routeIs('widget') ? 'active' : '' }}">
                <i class="nav-icon fa fa-th"></i>
                <p>
                  {{ __('Widgets') }}
                  <span class="right badge badge-danger">{{ __('New') }}</span>
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview {{ request()->routeIs('charts.*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ request()->routeIs('charts.*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-pie-chart"></i>
                <p>
                  {{ __('Charts') }}
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('charts.chartjs') }}" class="nav-link {{ request()->routeIs('charts.chartjs') ? 'active' : '' }}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ __('ChartJS') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('charts.flot') }}" class="nav-link {{ request()->routeIs('charts.flot') ? 'active' : '' }}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ __('Flot') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('charts.inline') }}" class="nav-link {{ request()->routeIs('charts.inline') ? 'active' : '' }}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ __('Inline') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview {{ request()->routeIs('ui.*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ request()->routeIs('ui.*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-tree"></i>
                <p>
                  {{ __('UI Elements') }}
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('ui.general') }}" class="nav-link {{ request()->routeIs('ui.general') ? 'active' : '' }}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ __('General') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('ui.icon') }}" class="nav-link {{ request()->routeIs('ui.icon') ? 'active' : '' }}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ __('Icons') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('ui.button') }}" class="nav-link {{ request()->routeIs('ui.button') ? 'active' : '' }}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ __('Buttons') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('ui.slider') }}" class="nav-link {{ request()->routeIs('ui.slider') ? 'active' : '' }}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ __('Sliders') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview {{ request()->routeIs('forms.*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ request()->routeIs('forms.*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-edit"></i>
                <p>
                  {{ __('Forms') }}
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('forms.general') }}" class="nav-link {{ request()->routeIs('forms.general') ? 'active' : '' }}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ __('General') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('forms.advanced') }}" class="nav-link {{ request()->routeIs('forms.advanced') ? 'active' : '' }}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ __('Advanced') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('forms.editor') }}" class="nav-link {{ request()->routeIs('forms.editor') ? 'active' : '' }}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ __('Editor') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview {{ request()->routeIs('tables.*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ request()->routeIs('tables.*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-table"></i>
                <p>
                  {{ __('Tables') }}
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('tables.simple') }}" class="nav-link {{ request()->routeIs('tables.simple') ? 'active' : '' }}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ __('Simple Tables') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('tables.datatable') }}" class="nav-link {{ request()->routeIs('tables.datatable') ? 'active' : '' }}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ __('Data Tables') }}</p>
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-header">{{ __('EXAMPLES') }}</li>

            <li class="nav-item">
              <a href="{{ route('calendar') }}" class="nav-link {{ request()->routeIs('calendar') ? 'active' : '' }}">
                <i class="nav-icon fa fa-calendar"></i>
                <p>{{ __('Calendar') }} <span class="badge badge-info right">2</span></p>                
              </a>
            </li>
            <li class="nav-item has-treeview {{ request()->routeIs('mails.*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ request()->routeIs('mails.*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-envelope-o"></i>
                <p>
                  {{ __('Mailbox') }}
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('mails.inbox') }}" class="nav-link {{ request()->routeIs('mails.inbox') ? 'active' : '' }}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ __('Inbox') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('mails.compose') }}" class="nav-link {{ request()->routeIs('mails.compose') ? 'active' : '' }}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ __('Compose') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('mails.read') }}" class="nav-link {{ request()->routeIs('mails.read') ? 'active' : '' }}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ __('Read') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview {{ request()->routeIs('pages.*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ request()->routeIs('pages.*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-book"></i>
                <p>
                  {{ __('Pages') }}
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('pages.invoice') }}" class="nav-link {{ request()->routeIs('pages.invoice') ? 'active' : '' }}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ __('Invoice') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('profile') }}" class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ __('Profile') }}</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('pages.lockscreen') }}" class="nav-link {{ request()->routeIs('pages.lockscreen') ? 'active' : '' }}">
                    <i class="fa fa-circle-o nav-icon"></i>
                    <p>{{ __('Lockscreen') }}</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview {{ request()->routeIs('examples.*') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link {{ request()->routeIs('examples.*') ? 'active' : '' }}">
                <i class="nav-icon fa fa-plus-square-o"></i>
                <p>
                  {{ __('Extras') }}
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('examples.blank') }}" class="nav-link {{ request()->routeIs('examples.blank') ? 'active' : '' }}">
                      <i class="nav-icon fa fa-circle-o nav-icon"></i>
                      <p>{{ __('Blank Page') }}</p>
                    </a>
                  </li>                   
                  <li class="nav-item">
                    <a href="{{ route('examples.starter') }}" class="nav-link {{ request()->routeIs('examples.starter') ? 'active' : '' }}">
                      <i class="nav-icon fa fa-circle-o nav-icon"></i>
                      <p>{{ __('Starter Page') }}</p>
                    </a>
                  </li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="{{ route('logout') }}" class="nav-link">
                <i class="nav-icon fa fa-sign-out"></i>
                <p>{{ __('Logout') }}</p>
              </a>
            </li>
            @else
              <li class="nav-item">
                <a href="{{ route('guest') }}" class="nav-link {{ request()->routeIs('guest') ? 'active' : '' }}">
                  <i class="nav-icon fa fa-plus-square-o"></i>
                  <p>{{ __('Guest Page') }}</p>
                </a>
              </li>
            @endauth
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              @if (! empty($title))
              <h1 class="m-0 text-dark">{{ $title }}</h1>
              @endif
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a>
                </li>
                @if (! empty($title))
                <li class="breadcrumb-item active">{{ $title }}</li>
                @endif
              </ol>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        @yield('content')
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>{{ __('Logs') }}</h5>
        <p>{{ __('No logs at current time.') }}</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        {{ config('app.name') }}
      </div>
      <!-- Default to the left -->
      <strong>{{ __('Copyright') }} &copy; 2014-2018
        <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

  <!-- Bootstrap 4 -->
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- AdminLTE App -->
  <script src="{{ asset('js/adminlte.min.js') }}"></script>

  <script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
  <script src="{{ asset('js/demo.js') }}"></script>

  @stack('js')
</body>

</html>