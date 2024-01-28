<?php 


if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    $customer_order = wc_get_orders([
        'customer' => $current_user->ID,
        'status' => 'all',
    ]);
}
?>

<section class="smt-my-history container-fluid menuItem" id="my-history-page">
    <table class="table shadow-sm">
        <thead class="table-header-container">
            <tr>
                <th class="border border-light-subtle table-history-content" scope="col">Order Number</th>
                <th class="border border-light-subtle table-history-content" scope="col">Amount</th>
                <th class="border border-light-subtle table-history-content" scope="col">Order Status</th>
                <th class="border border-light-subtle table-history-content" scope="col">Order date</th>
                <th class="border border-light-subtle table-history-content" scope="col">Payment Status</th>
                <th class="border border-light-subtle table-history-content" scope="col">Confirm Approval</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($customer_order):
                foreach ($customer_order as $order):
                    $order_items = $order->get_items();
                    foreach ($order_items as $item_id => $item) :
                        $approval_status = wc_get_order_item_meta($item_id, 'approval_status', true) ? wc_get_order_item_meta($item_id, 'approval_status', true) : 0;
                        ?>
                        <tr>
                            <td class="border border-light-subtle table-history-content">#<?php echo $order->get_order_number(); ?></td>
                            <td class="border border-light-subtle table-history-content"><?php echo wc_price($order->get_total()); ?></td>
                            <td class="border border-light-subtle table-history-content"><?php echo $order->get_status(); ?></td>
                            <td class="border border-light-subtle table-history-content"><?php echo $order->get_date_created()->format('F j, Y'); ?></td>
                            <td class="border border-light-subtle table-history-content"><?php echo $order->is_paid() ? 'Paid' : 'Unpaid'; ?></td>
                            <form action="" method="POST" >
                                <?php if ($approval_status === '1'): ?>
                                    <td class="border border-light-subtle table-history-content text-center">
                                        <button type="submit" name="confirm-button"
                                                class="confirm-button listing-submit-btn w-100 mb-4 py-1 d-block confirmed-button"
                                                data-order-id="<?php echo $order->get_id(); ?>" disabled="disabled" > Approved</button>
                                    </td>
                                <?php else: ?>
                                    <td class="border border-light-subtle table-history-content text-center">
                                        <button type="submit" name="confirm-button"
                                                class="confirm-button listing-submit-btn w-100 mb-4 py-1 d-block"
                                                data-order-id="<?php echo $order->get_id(); ?>" >Confirm </button>
                                    </td>
                                <?php endif; ?>
                            </form>
                        </tr>
                    <?php endforeach;
                endforeach;
            endif; ?>
        </tbody>
    </table>
</section>
