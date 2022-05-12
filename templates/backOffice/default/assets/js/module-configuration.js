$(function() {
    // Set proper image ID in delete from
    $('a.hookfetes-delete').click(function(ev) {
        $('#hookfetes_delete_id').val($(this).data('id'));
    });
});