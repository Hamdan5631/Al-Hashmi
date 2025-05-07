<script src="{{ asset('assets/vendor/js/jquery.js') }}"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
<script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

<script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/vendor/js/menu.js')}}"></script>
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js ')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
<script src="{{ asset('assets/vendor/toastr/toastr.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-validation/additional-methods.min.js') }}"></script>
<script src="{{ asset('assets/vendor/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-fixedheader/dataTables.fixedHeader.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-fixedcolumns/dataTables.fixedColumns.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-rowgroup/dataTables.rowGroup.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-scroller/dataTables.scroller.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-responsive/dataTables.responsive.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-responsive-bs4/responsive.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/dataTables.buttons.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/buttons.html5.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/buttons.flash.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/buttons.print.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons/buttons.colVis.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables.net-buttons-bs4/buttons.bootstrap4.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/buttons.server-side.js') }}"></script>
<script src="{{ asset('assets/vendor/ladda/spin.min.js') }}"></script>
<script src="{{ asset('assets/vendor/ladda/ladda.min.js') }}"></script>
<script src="{{ asset('assets/vendor/alertify/alertify.js') }}"></script>
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    jQuery.validator.setDefaults({
        debug: false,
        validClass: "is-valid",
        errorClass: "is-invalid",
        errorElement: "span",
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');

            if ($(element).parent().is('.dropify-wrapper')) {
                error.insertAfter($(element).parent());
            } else if ($(element).parent().is('.input-group')) {
                error.insertAfter($(element).parent());
            } else if ($(element).parent().is('.intl-tel-input')) {
                error.insertAfter($(element).parent());
            } else if ($(element).parent().is('.validator-group')) {
                error.insertAfter($(element).parent());
            } else {
                error.appendTo($(element).parent());
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass(errorClass).removeClass(validClass);
            $(element).closest('.form-group').addClass(errorClass).removeClass(validClass);
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass(errorClass).addClass(validClass);
            $(element).closest('.form-group').removeClass(errorClass).addClass(validClass);
        }
    });

    (function (document, window, $) {
        'use strict';

        let Site = window.Site;
        // $(document).ready(function(){
        //     Site.run();
        // });

        $(document).ajaxSuccess(function (event, jqxhr, settings) {
            console.log(jqxhr);
            console.log(settings);

            var responseJSON = jqxhr.responseJSON;

            if (!responseJSON) {
                responseJSON = $.parseJSON(jqxhr.responseText);
            }

            if (responseJSON.success) {
                toastr.success(responseJSON.success);
            }

            if (responseJSON.info) {
                toastr.info(responseJSON.info);
            }

            if (responseJSON.warning) {
                toastr.warning(responseJSON.warning);
            }

            if (responseJSON.error) {
                toastr.error(responseJSON.error);
            }
        });

        $(document).ajaxError(function (event, jqxhr, settings, thrownError) {
            console.log(jqxhr);

            var responseJSON = jqxhr.responseJSON;

            if (!responseJSON) {
                responseJSON = $.parseJSON(jqxhr.responseText);
            }

            if (jqxhr.status == 419) {
                location.reload();
            }

            if (responseJSON.message) {
                toastr.error(responseJSON.message);
            }
        });

        $('.select2').change(function () {
            $(this).valid();
        });

        $('.select2').select2({width: '100%'})

        $("select").on("select2:close", function (e) {
            $(this).valid();
        });
    })(document, window, jQuery);

    jQuery.validator.addMethod("noSpace", function (value, element) {
        return value == '' || value.trim().length != 0;
    }, "No space please and don't leave it empty");
</script>

<script>
    (function (document, window, $) {
        'use strict';

        <?php
        $alerts = ['success', 'info', 'warning', 'error'];
        ?>

            @foreach($alerts as $alert)
            @if(session()->has($alert))
            toastr['{{ $alert }}']('{{ session()->get($alert) }}');
        @endif
        @endforeach

        <?php
        session()->forget($alerts);
        ?>

    })(document, window, jQuery);
</script>
@stack('scripts')
