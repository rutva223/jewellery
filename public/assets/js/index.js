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
            // select2();
        },
        error: function(data) {
            data = data.responseJSON;
            show_toastr('Error', data.error, 'error')
        }
    });
});

