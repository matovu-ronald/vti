<header class="main-header">
  <!-- Logo -->
  <a href="{{ url('/') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">
      {!! backpack_user()->hasRole('admin') ?  config('backpack.base.logo_mini') : mini_logo(backpack_auth()->user()->vti->name) !!}
    </span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg" style="font-size: 15px;">
      {!! backpack_user()->hasRole('admin') ? config('backpack.base.logo_lg') : backpack_auth()->user()->vti->name !!}
    </span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">{{ trans('backpack::base.toggle_navigation') }}</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>

    @include('backpack::inc.menu')
  </nav>
</header>