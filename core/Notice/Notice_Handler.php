<?php 


namespace Startups\Market\Notice;

/**
 * Notice Handler Class
 */

 class Notice_Handler{

    public static function show_logged_in_message( $message = '' ){
        $t = ! empty( $message ) ? $message : '';
        $t = apply_filters( 'stm_message_for_loggedin_users', $t );

        if( ! empty( $message ) ){
        ?>
            <div class="notice_wrapper">
                <div class="stm-alert stm-alert-warning">
                    <?php echo wp_kses_post( esc_html( $t ) ); ?>
                </div>
            </div>
        <?php
        } 
    }



    public static function show_register_confirmation( $message = '' ){
        $t = !empty( $message ) ? $message : '';
        $t = apply_filters( 'stm_message_for_registration_confirmation', $t );

        if( ! empty( $message ) ){
        ?>
            <div class="notice_wrapper">
                <div class="stm-registration-confirmation">
                    <?php echo wp_kses_post( esc_html( $t ) ); ?>
                </div>
            </div>
        <?php  
        }
    }

    public static function show_login_error( $message = '' ){
        $t = ! empty( $message ) ? $message : '';
        $t = apply_filters( 'stm_login_error_message', $t );

        if( ! empty( $message ) ){
        ?>
            <div class="notice_wrapper">
                <div class="stm_login_error">
                    <?php echo wp_kses_post( esc_html( $t ) ); ?>
                </div>
            </div>
        <?php
        } 
    }

    public static function show_for_nonloggedin_user( $message = '' ){
        $t = ! empty( $message ) ? $message : '';
        $t = apply_filters( 'stm_message_for_nonloggedin_users', $t );

        if( ! empty( $message ) ){
        ?>
            <div class="notice_wrapper">
                <div class="stm-alert stm-alert-warning">
                    <?php echo wp_kses_post( esc_html( $t ) ); ?>
                </div>
            </div>
        <?php
        } 
    }

 }