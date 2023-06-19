@include('admin.auth.layouts.head')
<body class="vertical-layout vertical-menu-modern 1-column   menu-expanded blank-page blank-page"
      data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        @yield('content')

    </div>
</div>
@include('admin.auth.layouts.scripts')
