jQuery(document).ready(function($) {
    $('.approve-btn').on('click', function() {
        var withdrawalId = $(this).data('withdrawal-id');
        var adminAction = $(this).data('admin-action');

        if (adminAction === 1) {
            // Already approved, do nothing
            alert('This withdrawal is already approved.');
        } else if (confirm('Are you sure you want to approve this withdrawal?')) {
            var data = {
                'action': 'approve_withdrawal',
                'withdrawal_id': withdrawalId,
                'nonce': withdraw_action_object.nonce, // Pass nonce to the server
            };

            $.post(withdraw_action_object.ajax_url, data, function(response) {
                if (response.success) {
                    // Update button appearance
                    var button = $('.approve-btn[data-withdrawal-id="' + withdrawalId + '"]');
                    button.removeClass('button-primary').addClass('button-success approved').text('Approved');
                    alert('Withdrawal approved successfully!');
                } else {
                    alert('Error approving withdrawal. Please try again.');
                }
            });
        }
    });
});