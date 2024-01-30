<?php 
use Startups\Market\Stm_Utils;
$user_id = get_current_user_id();

$pending_balance_without_fee = get_user_meta( $user_id, 'pending_balance', true );
$available_balance_without_fee = get_user_meta( $user_id, 'available_balance', true );


// Convert string values to integers
$pending_balance_without_fee = floatval($pending_balance_without_fee);
$available_balance_without_fee = floatval($available_balance_without_fee);

$total_pending_balance = Stm_Utils::calculateEarningsAndFee( $pending_balance_without_fee );
$total_available_balance = Stm_Utils::calculateEarningsAndFee( $available_balance_without_fee );

$args = [
  'posts_per_page' => -1,
  'post_type' => 'business',
  'author' => $user_id,
  'post_status' => 'sold_out'
];

$query = new WP_Query( $args );

$count_sold_out_posts = $query->post_count;
$current_user = wp_get_current_user();
$full_name = $current_user->display_name;
$bank_name = get_user_meta( $user_id, 'stm_bank_name', true );
$account = get_user_meta( $user_id, 'stm_bank_account', true );
$account_type = get_user_meta( $user_id, 'stm_account_type', true );
$routing = get_user_meta( $user_id, 'stm_bank_routing', true );

$get_withdrawal_data = get_withdrawal_data( $user_id );

?>
<p class="pr-notice"></p>
<!-- Wallet added-second -->
<section class="smt-my-wallet contianer-fluid menuItem" id="my-wallet-page">
  <div class="wallet-box-container">
    <div class="available-balance-box wallet-box">
      <h2>$<?php echo $total_available_balance[ 'earnings' ]; ?></h2>
      <h5><?php echo esc_html__( 'Available Balance', 'startups-market' ); ?></h5>
      <?php if( $total_available_balance[ 'earnings' ] > 20 ): ?>
      <form action="" method="POST">
      <button type="submit" name="widthraw-button" id="widthraw-button" class="widthraw-button listing-submit-btn w-50 mb-4 py-1 d-block wdtr-back" > Widthraw Now </button>
      </form>
      <?php endif; ?>
    </div>
    <div class="earning-box wallet-box">
      <h2>$<?php echo $total_pending_balance[ 'earnings' ]; ?></h2>
      <h5><?php echo esc_html__( 'Pending Total', 'startups-market' ); ?></h5>
    </div>
    <div class="order-box wallet-box">
      <h2><?php echo esc_html( $count_sold_out_posts ); ?></h2>
      <h5><?php echo esc_html__( 'Total Order', 'startups-market' ); ?></h5>
    </div>
  </div>
  <div class="earning-status">
    <div class="earning-status-header pb-2">
      <h2 class="pe-2"><?php echo esc_html__( 'Earnings', 'startups-market' ); ?></h2>
      <p><?php echo esc_html__( 'Fee', 'startups-market' ); ?> <span class="fw-bold"><?php echo esc_html__( '7%', 'startups-market' ); ?></span></p>
    </div>
    <div class="earning-table">
      <table class="table">
        <thead>
          <tr class="earning-status-th">
            <th scope="col"><?php echo esc_html__( 'BUSINESS', 'startups-market' ); ?></th>
            <th scope="col"><?php echo esc_html__( 'DATE', 'startups-market' ); ?></th>
            <th scope="col"><?php echo esc_html__( 'PRICE', 'startups-market' ); ?></th>
            <th scope="col"><?php echo esc_html__( 'FEE', 'startups-market' ); ?></th>
            <th scope="col"><?php echo esc_html__( 'EARNINGS', 'startups-market' ); ?></th>
            <th scope="col"><?php echo esc_html__( 'STATUS', 'startups-market' ); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php if($query->have_posts()) :

            while( $query->have_posts() ) :

              $query->the_post();
              $title = get_the_title();
              $date = Stm_Utils::get_post_status_last_modified_date( get_the_ID() );
              $price = get_post_meta( get_the_ID(), 'stm_price', true );
              $price_with_fee = floatval($price);
              $earnings = Stm_Utils::calculateEarningsAndFee( $price_with_fee );


              ?>
              <tr class="earning-status-td">
                
                <td><?php echo substr( $title, 0, 25 ). '...'; ?></td>
                <td><?php echo $date; ?></td>
                <td>$<?php echo $price; ?></td>
                <td>$<?php echo $earnings['fee']; ?></td>
                <td>$<?php echo $earnings['earnings']; ?></td>
                <td><?php echo __('SOLD OUT', 'startups-market'); ?></td>
                
                
              </tr> 
            <?php endwhile;
          endif;
          wp_reset_postdata();
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="payout-container">
    <div class="payout-history px-4 py-3">
      <h3><?php echo esc_html__( 'Payout History', 'startups-market' ); ?></h3>
      <div class="payout-table pt-3">
        <table class="table">
          <thead>
            <tr class="payout-th">
              <th scope="col"><?php echo esc_html__( 'REQUEST ID', 'startups-market' ); ?></th>
              <th scope="col"><?php echo esc_html__( 'PAYOUT METHOD', 'startups-market' ); ?></th>
              <th scope="col"><?php echo esc_html__( 'AMOUNT', 'startups-market' ); ?></th>
              <th scope="col"><?php echo esc_html__( 'DATE', 'startups-market' ); ?></th>
              <th scope="col"><?php echo esc_html__( 'STATUS', 'startups-market' ); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php 
            if( $get_withdrawal_data ):
            foreach( $get_withdrawal_data as $data ):
            ?>
            <tr class="payout-td">
              <td>#<?php echo $data['id']; ?></td>
              <td><?php echo __( 'Wire', 'startups-market' ); ?></td>
              <td>$<?php echo  $data['amount']; ?></td>
              <td><?php //echo date('F j, Y H:i:s', strtotime($data['withdrawal_date'])); ?></td>
              <td><?php echo $data['status']; ?></td>
            </tr> 

            <?php 
             endforeach;
            endif;
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="payout-method py-3 px-4">
      <h3 class="pb-2"><?php echo esc_html__( 'Payout Method', 'startups-market' ); ?></h3>
      <p class="py-3">
      <?php echo esc_html__( 'Wire Transfer', 'startups-market' ); ?>
      </p>
      <form action="" method="POST" id="paymentinfo" >
      <div class="mb-3 mx-4 mt-4">
          <label for="wdt_display_name" class="form-label "><?php esc_html_e( 'Full Name', 'startups-market'); ?></label>
            <input type="text" class="form-control" id="wdt_display_name" placeholder="Full Name" name="wdt_display_name" value="<?php esc_attr_e( $full_name ); ?>" disabled>
      </div>
      <div class="mb-3 mx-4 mt-4">
          <label for="wdt_bank_name" class="form-label "><?php esc_html_e( 'Bank Name', 'startups-market'); ?></label>
            <input type="text" class="form-control" id="wdt_bank_name" placeholder="Bank Name" name="wdt_bank_name" value="<?php esc_attr_e( $bank_name ); ?>" required>
      </div>
      <div class="mb-3 mx-4 mt-4">
          <label for="wdt_account_number" class="form-label "><?php esc_html_e( 'Account Number', 'startups-market'); ?></label>
            <input type="text" class="form-control" id="wdt_account_number" placeholder="Account Number" name="wdt_account_number" value="<?php esc_attr_e( $account ); ?>" required>
      </div>
      <div class="mb-3 mx-4 mt-4">
          <label for="wdt_account_type" class="form-label "><?php esc_html_e( 'Account Type', 'startups-market'); ?></label>
            <input type="text" class="form-control" id="wdt_account_type" placeholder="Account Type" name="wdt_account_type" value="<?php esc_attr_e( $account_type ); ?>" required>
      </div>
      <div class="mb-3 mx-4 mt-4">
          <label for="wdt_routing_number" class="form-label "><?php esc_html_e( 'Routing Number', 'startups-market'); ?></label>
            <input type="text" class="form-control" id="wdt_routing_number" placeholder="Routing Number" name="wdt_routing_number" value="<?php esc_attr_e( $routing ); ?>" required>
      </div>

      <div class="container-fluid px-4">
                    <button class="form-dashboard-button py-2 mb-3 mt-2 fw-semibold" type="submit" name="wdt_save_changes" ><?php esc_html_e( 'Save Changes', 'startups-market'); ?></button>
                </div>
        </form>
    </div>
  </div>
</section>