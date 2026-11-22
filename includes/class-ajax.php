<?php 
namespace pvum;

if ( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists('pvum\Ajax')){

	class Ajax {


		function __construct(){

            add_action('wp_ajax_get_views_count',array( $this, 'get_view_count' ) );
            

            add_action( 'wp_ajax_get_views',array( $this,'get_viewer_list') );
            

            add_action( 'wp_ajax_get_panel_template',array( $this,'get_panel_template') );
            

            add_action( 'wp_ajax_pvum_clear_views', array( $this, 'clear_views' ) );

		}



        function clear_views(){

            check_ajax_referer( 'pvum_profile_views', 'nonce' );
            $is_authorised = null;
            $profile_id = isset( $_POST['profile'] ) ? absint( $_POST['profile'] ) : 0;
            if( ! is_user_logged_in() ){
                $is_authorised = false;
            }else{
                $user_id = get_current_user_id();
                if( ! $profile_id || $user_id !== $profile_id ){
                    $is_authorised = false;
                }

                if ( $is_authorised === null && pvum()->helper()->profile_views_enabled( $profile_id ) ) {
                    $is_authorised = true;
                }
            }
            ob_start();
            if( $is_authorised == true ){
                delete_user_meta( $profile_id,'_profile_views' );
                pvum()->get_template_part( 'ajax/no-viewer' );
            }else{
                pvum()->get_template_part( 'ajax/not-authorised' );
            }
            $contents = ob_get_contents();
            ob_end_clean();
            echo wp_kses( $contents, array( 'p' => array(
                'class' => array()
            ) ) );
            die;
        }



        function get_panel_template(){

            check_ajax_referer( 'pvum_profile_views', 'nonce' );
            if ( ! is_user_logged_in() || ! pvum()->helper()->profile_views_enabled( get_current_user_id() ) ) {
                wp_die( esc_html__( 'Not authorised.', 'profile-views-um' ), '', array( 'response' => 403 ) );
            }
            ob_start();
            pvum()->get_template_part('ajax/panel');
            $contents = ob_get_contents();
            ob_end_clean();
            echo wp_kses_post( $contents );
            die;
        }

        /*
        Output in
        count number of new viewers
        */
        function get_view_count(){
            check_ajax_referer( 'pvum_profile_views', 'nonce' );
            $profile_id = isset( $_GET['profile'] ) ? absint( wp_unslash( $_GET['profile'] ) ) : 0;
            if ( ! is_user_logged_in() || ! $profile_id || get_current_user_id() !== $profile_id || ! pvum()->helper()->profile_views_enabled( $profile_id ) ) {
                wp_die( '0', '', array( 'response' => 403 ) );
            }
            wp_die( (string) pvum()->helper()->count_new_views( $profile_id ) );
        }


        /*
        Output html
        list of viewers
        */

        function get_viewer_list(){
            check_ajax_referer( 'pvum_profile_views', 'nonce' );
            $profile_id = isset( $_GET['profile'] ) ? absint( wp_unslash( $_GET['profile'] ) ) : 0;
            if ( ! is_user_logged_in() || ! $profile_id || get_current_user_id() !== $profile_id || ! pvum()->helper()->profile_views_enabled( $profile_id ) ) {
                wp_die( esc_html__( 'Not authorised.', 'profile-views-um' ), '', array( 'response' => 403 ) );
            }
            $viewers = get_user_meta( $profile_id, '_profile_views', true );
            ob_start();
            if ( is_array( $viewers ) && $viewers ) {
                pvum()->helper()->mark_read( $profile_id, $viewers );
                krsort( $viewers );
                pvum()->get_template_part( 'ajax/viewers', array( 'viewers' => $viewers ) );
            } else {
                pvum()->get_template_part( 'ajax/no-viewer' );
            }
            $html = ob_get_clean();
            echo wp_kses( $html, array(
                'ul' => array(), 'li' => array( 'class' => true ),
                'div' => array( 'class' => true ),
                'a' => array( 'href' => true, 'class' => true ),
                'img' => array( 'class' => true, 'src' => true, 'alt' => true ),
                'strong' => array( 'class' => true ),
                'small' => array( 'class' => true, 'style' => true ),
                'span' => array( 'class' => true ),
                'sup' => array(), 'sub' => array( 'style' => true ),
                'p' => array( 'class' => true ),
            ) );
            wp_die();
        }



	}

}