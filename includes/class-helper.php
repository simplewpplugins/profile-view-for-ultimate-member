<?php 
namespace pvum;

if ( ! defined( 'ABSPATH' ) ) exit;

if( ! class_exists('pvum\Helper')){

	class Helper {


        /** Only trust the address provided by the web server, not spoofable forwarding headers. */
        function get_ip_address() {
            $ip = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
            return filter_var( $ip, FILTER_VALIDATE_IP ) ? $ip : '';
        }

        /** Role option is stored by Ultimate Member as user metadata. */
        function profile_views_enabled( $profile_id ) {
            $profile_id = absint( $profile_id );
            if ( ! $profile_id ) {
                return false;
            }
            // Fetch the owner's role setting without changing Ultimate Member's active user.
            $user = get_userdata( $profile_id );
            if ( ! $user ) {
                return false;
            }
            $role = function_exists( 'um_user' ) ? get_user_meta( $profile_id, 'role', true ) : '';
            $role = $role ? $role : ( ! empty( $user->roles ) ? reset( $user->roles ) : '' );
            $role_data = function_exists( 'UM' ) && method_exists( UM(), 'roles' ) ? UM()->roles()->get_role( $role ) : array();
            $setting = null;
            if ( is_array( $role_data ) ) {
                if ( array_key_exists( '_um_enable_profile_views', $role_data ) ) {
                    $setting = $role_data['_um_enable_profile_views'];
                } elseif ( array_key_exists( 'enable_profile_views', $role_data ) ) {
                    $setting = $role_data['enable_profile_views'];
                }
            }
            // Respect explicit off (0) and on (1) choices. Only an absent
            // setting inherits the new-install default.
            if ( null === $setting || '' === $setting ) {
                return 'enabled' === get_option( 'pvum_default_profile_views', 'legacy' );
            }
            return (bool) $setting;
        }

        /**
         * Geolocation is disabled by default to avoid transmitting visitor IPs to
         * a third-party service without an explicit site-owner opt-in.
         * Developers may supply an HTTPS-backed resolver through this filter.
         */
        function ip_to_location( $ip_address ) {
            return sanitize_text_field( (string) apply_filters( 'pvum_viewer_location', __( 'Unknown place', 'profile-views-um' ), $ip_address ) );
        }


		function count_new_views( $profile_id, $viewers = null ){

            if( ! $viewers ){
                $viewers = get_user_meta( absint($profile_id),'_profile_views',true );
            }
        
            if( $viewers && is_array($viewers) && ! empty($viewers)){
        
                $status = array_column($viewers,'status');

                $counts = array_count_values( $status );

                if( isset($counts['new'])){
                    return absint($counts['new']);
                }
        
            }
        
            return 0;

        }


        function has_already_viewed( $ip_address ,$profile_id, $viewer_id =  0 ){

            $viewers = get_user_meta( absint( $profile_id ),'_profile_views',true );
            if( ! $viewers || empty( $viewers ) ){
                return false;
            }

            if( $viewer_id == 0 ){
                    // search by ip
                    $hashed_ip = $ip_address ? hash_hmac( 'sha256', $ip_address, wp_salt( 'auth' ) ) : '';
                    $key = $hashed_ip ? array_search( $hashed_ip, array_column( $viewers, 'ip' ), true ) : false;
                    if ( false === $key && $ip_address ) {
                        // Legacy records created before hashed guest identifiers.
                        $key = array_search( $ip_address, array_column( $viewers, 'ip' ), true );
                    }
                    if( $key !== false ){
                        return $key;
                    }
                }else{
                    // search with user id
                    $key = array_search( $viewer_id, array_column($viewers, 'viewer'));
                    if( $key !== false ){
                        return $key;
                    }   
                }

            return false;

        }



        function mark_read( $profile_id,$viewers = null ){

            if ( ! is_array( $viewers ) ) {
                $viewers = get_user_meta( $profile_id, '_profile_views', true );
            }
            if ( ! is_array( $viewers ) ) {
                return;
            }

            array_walk ( $viewers, function (&$key) { 
                $key["status"] = 'read'; 
            });

            update_user_meta( $profile_id, '_profile_views',$viewers );

        }



        function clear_all( $profile_id ){

            delete_user_meta( $profile_id, '_profile_views' );

        }



        function is_profile_owner( $profile_id ){

            if( is_user_logged_in() ){
                $user_id = get_current_user_id();
                
                if( $user_id == absint( $profile_id  )){
                    return true;
                }

            }

            return false;

        }



	}

}