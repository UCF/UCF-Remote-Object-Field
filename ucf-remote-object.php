<?php
/*
Plugin Name: Advanced Custom Fields: Remote Object Field
Plugin URI: https://github.com/UCF/UCF-ACF-Plugin-Remote-Object-Field
Description: Provides a way to quickly add remote objects (JSON objects from a feed) as choice values.
Version: 1.0.0
Author: UCF Web Communications
Author URI: https://github.com/UCF/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

// exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// check if class already exists
if ( ! class_exists( 'UCF_ACF_Plugin_Remote_Object' ) ) {
    class UCF_ACF_Plugin_Remote_Object {

        // vars
        var $settings;

        /**
         * This function will setup the class
         * @author Jim Barnes
         * @since 1.0.0
         */
        function __construct() {
            $this->settings = array(
                'version' => '1.0.0',
                'url'     => plugin_dir_url( __FILE__ ),
                'path'    => plugin_dir_path( __FILE__ )
            );

            // include field
            add_action( 'acf/include_field_types', array( $this, 'include_field' ) );
            add_action( 'acf/register_fields', array( $this, 'include_field' ) );
        }

        /**
         * This function will include the field type class
         */
        function include_field( $version = false ) {

            // support empty version
            if ( ! $version ) $version = 4;

            load_plugin_textdomain( 'ucf_remote_object', false, plugin_basename( dirname( __FILE__ ) ) . '/lang' );

            // include
            include_once( 'fields/class-ucf-acf-field-remote-object-v' . $version . '.php' );
        }
    }

    new UCF_ACF_Plugin_Remote_Object();
}