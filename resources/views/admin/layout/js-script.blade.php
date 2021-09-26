<!-- jQuery 3 -->
<script src="{{URL::asset('admin_template/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{URL::asset('admin_template/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- DataTables JS -->
{!! Html::script('admin_template/bower_components/datatables.net/js/jquery.dataTables.min.js') !!}
{!! Html::script('admin_template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') !!}

<!-- SELECT2 jS -->
<script src="{{URL::asset('admin_template/bower_components/select2/dist/js/select2.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{URL::asset('admin_template/dist/js/adminlte.min.js')}}"></script>
<!-- chartjs -->
<script type="text/javascript" src="{{ URL::asset('admin_template/bower_components/chart.js/Chart.min.js') }}"></script>
<!-- Fakeloader -->
<script type="text/javascript" src="{{ URL::asset('admin_template/bower_components/fakeloader/fakeloader.min.js') }}"></script>
@yield('push-javascript')
<script type="text/javascript">
        // Handling get longitude - latitude
        $(document).ready(function(){
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, getError);

            } else {
                alert("Geolocation is not supported by this browser.");
                console.log("Geolocation is not supported by this browser.");

            }
        })

        // Success get longitude - latitude
        function showPosition(position) {
            $('input[name="hidden-long"]').val(position.coords.longitude);
            $('input[name="hidden-lat"]').val(position.coords.latitude);
            // $('input#lng').val(position.coords.longitude);
            // $('input#lat').val(position.coords.latitude);

            console.log("Success generate longitude" + position.coords.longitude + " - latitude : " + position.coords.latitude + ".");
        }

        // Fail get longitude - latitude
        function getError() {
            console.log("Default longitude - latitude set.");
        }

        $.ajaxSetup({
            data: {
                long: $('input[name="hidden-long"]').val(),
                lat: $('input[name="hidden-lat"]').val()
            }
        });

    </script>