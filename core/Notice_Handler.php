<?php 


namespace Startups\Market;
/**
 * Notice Handler Class
 */

 class Notice_Handler{

    public static function show_logged_in_message( $message = '' ){
        $t = ! empty( $message ) ? $message : '';
        $t = apply_filters( 'stm_message_for_loggedin_users', $t );

        if( ! empty($message) ){
        ?>
            <div class="notice_wrapper">
                <div class="stm-alert stm-alert-warning">
                    <?php echo wp_kses_post( esc_html( $t ) ); ?>
                </div>
            </div>
        <?php
    }   }
 }