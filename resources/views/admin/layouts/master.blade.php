<!DOCTYPE html>
<html class="loading" lang="ar" data-textdirection="rtl">
@include('admin.layouts.head')
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
      data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
<!-- fixed-top-->
@include('admin.layouts.navbar')
<!-- ////////////////////////////////////////////////////////////////////////////-->
@include('admin.layouts.sidebar')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">إدارة المشتركين</h3>
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">@yield('sub_title')</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#"> @yield('title_head')</a>
                            </li>

                        </ol>
                    </div>
                </div>
            </div>

        </div>
        @include('admin.messages.alert')
        <div class="content-body">
        @yield('content')
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
@include('admin.layouts.footer')

@include('admin.layouts.scripts')
</body>
</html>
