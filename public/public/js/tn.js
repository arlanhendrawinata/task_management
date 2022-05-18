$(document).ready(function() {
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  });
});

$(document).on('click', '.btn-edit', function(event) {
  event.preventDefault();
  let href = $(this).attr('data-attr');
  $.ajax({
      url: href,
      success: function(response) {
        $('#editNoteModal').modal("show");
          $('.edit-form').html('');
          $('.edit-form').append(response);
      }
  })
});

// $(document).on('click', '.btn-revisi', function(event) {
//   event.preventDefault();
//   let href = $(this).attr('data-attr');
//   $.ajax({
//       url: href,
//       success: function(response) {
//         $('#editNoteModal').modal("show");
//           $('.edit-form').html('');
//           $('.edit-form').append(response);
//       }
//   })
// });

$(document).on('click', '.btn-detail', function(event) {
  event.preventDefault();
  let href = $(this).attr('data-attr');
  $.ajax({
      url: href,
      success: function(response) {
        $('#detailModal').modal("show");
          $('#detailBody').html('');
          $('#detailBody').append(response);

      }
  })
});

$(document).on('click', '.btn-delete', function(event) {
  event.preventDefault();
  let id = $(this).attr('data-id');
  let href = $(this).attr('data-link');
  $('#tambahPICModal').modal('hide');
  // $('#tambahPICModal').attr("style", "display:hidden");
  $('#detailModal').modal('hide');
  $('#deleteModal').modal('show');
  $('.modal-footer-delete').html('');
  $('.modal-footer-delete').html('<a href="'+ href +'" type="submit" class="btn btn-primary">Delete</a><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>');
  $('.btn-close').click(function (e) { 
    $('.modal-backdrop').remove();
  });
});

$(document).on('click', '.btn-verif', function(event) {
  event.preventDefault();
  let id = $(this).attr('data-id');
  let href = $(this).attr('data-link');
  $('#detailModal').modal('hide');
  $('#verifikasiModal').modal('show');
  $('.modal-footer').html('');
  $('.modal-footer').html('<a href="'+ href +'" type="submit" class="btn btn-success">Verification</a><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>');
  $('.btn-close').click(function (e) { 
    $('.modal-backdrop').remove();
  });
});

$(document).on('click', '.btn-delete-note', function(event) {
  event.preventDefault();
  let id = $(this).attr('data-id');
  $('#detailModal').modal('hide');
  $('#deleteModal').modal('show');
  $('.modal-footer').html('');
  $('.modal-footer').html('<form class="deleteForm" action="notes/'+ id +'/delete"><button type="submit" class="btn btn-primary">Delete</button></form>');
});