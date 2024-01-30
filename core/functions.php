<?php 

/**
 * Get Country List
 *
 * @return array
 */
function get_countries_list() {
    $transient_key = 'countries_list';
    $countries = get_transient( $transient_key );

    if ( false === $countries ) {
        $api_url = 'https://restcountries.com/v3.1/all';

        $response = wp_remote_get( $api_url );

        if ( is_wp_error( $response ) ) {
            // Handle the error (you might log it or return a default value)
            return [];
        }

        $body = wp_remote_retrieve_body( $response );
        $countries = json_decode( $body, true );

        if ( empty( $countries ) ) {
            // Handle the case where no countries are returned
            return [];
        }

        // Extract relevant information 
        $formatted_countries = [];
        foreach ( $countries as $country ) {
            $formatted_countries[ $country[ 'cca2' ] ] = $country[ 'name' ][ 'common' ];
        }

        asort( $formatted_countries );

        // Set transient with an appropriate expiration time (e.g., 1 day)
        set_transient( $transient_key, $formatted_countries, DAY_IN_SECONDS );

        return $formatted_countries;
    }

    return $countries;
}

/**
 * Insert Function For Widthrawal Data
 */

 function insert_widthrawal_data( $user_id, $amount ){
    global $wpdb;

    $table_name = $wpdb->prefix . 'stm_withdrawals';

    $data = [
        'user_id' => $user_id,
        'amount' => $amount,
        'status' => 'pending',
        'admin_action' => 0,
        'withdrawal_date' => current_time('mysql', 1),
    ];

    $wpdb->insert( $table_name, $data );

 }

 /**
  * Update Admin Approval
  *
  * @param int $withdrawal_id
  * @param bool $admin_action
  * @return void
  */
 function update_admin_action($withdrawal_id, $admin_action) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'stm_withdrawals';

    // Set the new status to 'completed'
    $new_status = 'completed';

    $data = array(
        'admin_action' => $admin_action,
        'status' => $new_status
    );

    $where = array('id' => $withdrawal_id);

    $wpdb->update($table_name, $data, $where);
}

/**
 * Widthrawl Data for a user
 *
 * @param int $user_id
 * @return
 */
function get_withdrawal_data($user_id) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'stm_withdrawals';

    $results = $wpdb->get_results("SELECT * FROM $table_name WHERE user_id = $user_id", ARRAY_A);

    return $results;
}

/**
 * Get All data of Widthraw
 *
 * @return
 */
function get_all_withdrawal_data() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'stm_withdrawals';

    $query = "SELECT * FROM $table_name";

    // Fetch results
    $results = $wpdb->get_results($query, ARRAY_A);

    return $results;
}

/**
 * Delete Function for Withdrawal Data
 */
function delete_withdrawal_data($withdrawal_id) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'stm_withdrawals';

    // Ensure $withdrawal_id is a valid positive integer
    $withdrawal_id = absint($withdrawal_id);

    if ($withdrawal_id > 0) {
        $wpdb->delete($table_name, array('id' => $withdrawal_id));
    }
}