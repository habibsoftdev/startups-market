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