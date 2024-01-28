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



?>

<!-- Wallet added-second -->
<section class="smt-my-wallet contianer-fluid menuItem" id="my-wallet-page">
  <div class="wallet-box-container">
    <div class="available-balance-box wallet-box">
      <h2>$<?php echo $total_available_balance[ 'earnings' ]; ?></h2>
      <h5>Available Balance</h5>
    </div>
    <div class="earning-box wallet-box">
      <h2>$<?php echo $total_pending_balance[ 'earnings' ]; ?></h2>
      <h5>Pending Total</h5>
    </div>
    <div class="order-box wallet-box">
      <h2>0</h2>
      <h5>Total Order</h5>
    </div>
  </div>
  <div class="earning-status">
    <div class="earning-status-header pb-2">
      <h2 class="pe-2">Earnings</h2>
      <p>Fee <span class="fw-bold">7%</span></p>
    </div>
    <div class="earning-table">
      <table class="table">
        <thead>
          <tr class="earning-status-th">
            <th scope="col">BUSINESS</th>
            <th scope="col">DATE</th>
            <th scope="col">PRICE</th>
            <th scope="col">FEE</th>
            <th scope="col">EARNINGS</th>
            <th scope="col">STATUS</th>
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
          endif; ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="payout-container">
    <div class="payout-history px-4 py-3">
      <h3>Payout History</h3>
      <div class="payout-table pt-3">
        <table class="table">
          <thead>
            <tr class="payout-th">
              <th scope="col">AMOUNT</th>
              <th scope="col">PAYOUT METHOD</th>
              <th scope="col">DATE</th>
            </tr>
          </thead>
          <tbody>
            <tr class="payout-td">
              <td>EMPTY</td>
              <td>EMPTY</td>
              <td>EMPTY</td>
            </tr> 
          </tbody>
        </table>
      </div>
    </div>
    <div class="payout-method py-3 px-4">
      <h3 class="pb-2">Payout Method</h3>
      <p class="py-3"></p>
    </div>
  </div>
</section>