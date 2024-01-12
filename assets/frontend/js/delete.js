jQuery(document).ready(function($) {
    $('.delete-list').on('click', function(e) {
        e.preventDefault();

        var postId = $(this).data('list-id');

        // Show a confirmation dialog
        var confirmDelete = confirm(stm_delete_object.confirm_message);

        if (confirmDelete) {
            var deleteRow = $(this).closest('tr'); // Get the parent tr element
            var deleteNonce = stm_delete_object.delete_nonce;

            // Perform AJAX request
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: stm_delete_object.ajax_url, // Make sure to localize this in your script
                data: {
                    action: 'delete_listing',
                    listing_id: postId,
                    nonce: deleteNonce,
                },
                success: function(response) {
                    if (response.success) {
                        // Successfully deleted, fade out and remove the row
                        deleteRow.fadeOut('slow', function() {
                            $(this).remove();
                        });
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
    });
});
