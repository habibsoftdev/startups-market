<?php 

/**
 * Get Country List
 *
 * @return array
 */
function get_countries_list(){

    $api_url = 'https://restcountries.com/v3.1/all';

    $response = wp_remote_get($api_url);

    if (is_wp_error($response)) {
        return [];
    }

    $body = wp_remote_retrieve_body($response);
    $countries = json_decode($body, true);

    if (empty($countries)) {
        return [];
    }

    // Extract relevant information (you can customize this based on your needs)
    $formatted_countries = [];
    foreach ($countries as $country) {
        $formatted_countries[$country['cca2']] = $country['name']['common'];
    }

    asort($formatted_countries);
    
    return $formatted_countries;
}