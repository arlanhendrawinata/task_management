$(document).on('click', '.btn-detail-listtask', function(event) {
    event.preventDefault();
    let href = $(this).attr('data-attr');
    $.ajax({
        url: href,
        success: function(response) {
            console.log();
            $('#detailModal').modal("show");
            $('#detailBody').html('');
            $('#detailBody').append(response);

        }
    })
});
$(document).on('click', '.btn-delete-leadtask', function(event) {
    event.preventDefault();
    let id = $(this).attr('data-id');
    $('#detailModal').modal('hide');
    $('#deleteModal').modal('show');
    $('.modal-footer-delete').html('');
    $('.modal-footer-delete').html('<a href="/leadtim/task/delete/' + id + '" type="submit" class="btn btn-primary">Delete</a>');
});
