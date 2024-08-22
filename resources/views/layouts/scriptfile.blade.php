<script src="{{ asset('panel_style/vendor/global/global.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/intro.js/minified/intro.min.js"></script>

<script src="{{ asset('panel_style/vendor/chart-js/chart.bundle.min.js') }}"></script>
<script src="{{ asset('panel_style/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/bundles/mainscripts.bundle.js') }}"></script>
<!-- Apex Chart -->
<script src="{{ asset('assets/vendor/toastr/toastr.js') }}"></script>
<script src="{{ asset('panel_style/vendor/apexchart/apexchart.js') }}"></script>
<!-- Chart piety plugin files -->
<script src="{{ asset('panel_style/vendor/peity/jquery.peity.min.js') }}"></script>

<!--swiper-slider-->
<script src="{{ asset('panel_style/vendor/swiper/js/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('panel_style/vendor/select2/js/select2.full.min.js') }}"></script>
<!-- Dashboard 1 -->
<script src="{{ asset('panel_style/vendor/wow-master/dist/wow.min.js') }}"></script>
<script src="{{ asset('panel_style/vendor/bootstrap-datetimepicker/js/moment.js') }}"></script>
<script src="{{ asset('panel_style/vendor/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('panel_style/vendor/bootstrap-select-country/js/bootstrap-select-country.min.js') }}"></script>
<script src="{{ asset('panel_style/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js') }}"></script>

<!--datatables-->
<script src="{{ asset('panel_style/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('panel_style/js/plugins-init/datatables.init.js') }}"></script>

<script src="{{ asset('panel_style/js/dlabnav-init.js') }}"></script>
<script src="{{ asset('panel_style/js/custom.min.js') }}"></script>
<script src="{{ asset('panel_style/js/plugins-init/select2-init.js') }}"></script>
<script src="{{ asset('panel_style/js/ckeditor.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}"></script>
<!-- <script src="{{ asset('assets/js/index.js') }}"></script> -->

<script>
    $(function() {
        var custom_url = "{{ url('/') }}";

        $("#datepicker").datepicker({
            autoclose: true,
            todayHighlight: true
        }).datepicker('update', new Date());
        $(document).on('click', 'a[data-ajax-popup="true"]', function() {
            var title1 = $(this).data("title");
            var title2 = $(this).data("bs-original-title");
            var title = (title1 != undefined) ? title1 : title2;
            var size = ($(this).data('size') == '') ? 'md' : $(this).data('size');
            var url = $(this).data('url');
            $("#staticBackdrop .modal-title").html(title);
            $("#staticBackdrop .modal-dialog").addClass('modal-' + size);
            $.ajax({
                url: url,
                success: function(data) {
                    $('#staticBackdrop .body').html(data);
                    $("#staticBackdrop").modal('show');
                    // daterange_set();
                    // taskCheckbox();
                    // common_bind("#commonModal");
                    // commonLoader();
                    $('#single-select1').select2({
                        dropdownParent: $('#staticBackdrop') // Replace with the actual ID of your modal
                    });
                },
                error: function(data) {
                    data = data.responseJSON;
                    show_toastr('Error', data.error, 'error')
                }
            });
        });
    });


    $(document).ready(function() {
        $(".booking-calender .fa.fa-clock-o").removeClass(this);
        $(".booking-calender .fa.fa-clock-o").addClass('fa-clock');
    });
    $('.my-select').selectpicker();


    setTimeout(function() {
        $('.ResponseMessage').css("display", "none");
    }, 2000);
</script>

<script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>

<script>
    function confirmLogout(event) {
        event.preventDefault(); // Prevent the default action
        Swal.fire({
            title: 'Are you sure you want to logout?',
            text: 'You will need to log in again to continue.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, logout!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>

<script>
    var exampleModal = document.getElementById('staticBackdrop')
    exampleModal.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = exampleModal.querySelector('.modal-title')
        var modalBodyInput = exampleModal.querySelector('.modal-body input')
    })
</script>


<style>
    .dropdown.bootstrap-select.swal2-select {
        display: none !important;
    }
</style>
