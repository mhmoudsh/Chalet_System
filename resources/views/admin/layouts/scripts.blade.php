<!-- BEGIN VENDOR JS-->
<script src="{{asset('dashboard/app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="{{asset('dashboard/app-assets/vendors/js/charts/chartist.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/app-assets/vendors/js/charts/chartist-plugin-tooltip.min.js')}}"
        type="text/javascript"></script>
<script src="{{asset('dashboard/app-assets/vendors/js/charts/raphael-min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/app-assets/vendors/js/charts/morris.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/app-assets/vendors/js/timeline/horizontal-timeline.js')}}" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="{{asset('dashboard/app-assets/js/core/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/app-assets/js/core/app.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/app-assets/js/scripts/customizer.js')}}" type="text/javascript"></script>
<!-- END MODERN JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{asset('dashboard/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="{{asset('dashboard/app-assets/js/scripts/tables/datatables-extensions/datatables-sources.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
<script >
    $(document).ready(function () {
        $('.selectize').selectize({
            sortField: 'text'

        });


    });
</script>

@yield('scripts')
