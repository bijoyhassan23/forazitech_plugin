<?php
/**
 * Plugin Name: ForaziTech Plugin
 * Description: A custom plugin for ForaziTech website.
 * Version: 1.0.0
 * Author: Bijoy
 * License: GPL2
 */

defined('ABSPATH') || exit; // Prevent direct access

define('FRZ_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('FRZ_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('FRZ_PLUGIN_VERSION', '1.0.0');

// Include necessary files
include_once FRZ_PLUGIN_DIR . 'includes/active-deactive.php';
include_once FRZ_PLUGIN_DIR . 'includes/register-post-types.php';
include_once FRZ_PLUGIN_DIR . 'includes/elementor-extends.php';

// Main Plugin Class
class Forazitech_plugin{
    // Singleton instance
    private static $instance = null;
    public static function get_instance(){
        if(self::$instance == null) self::$instance = new self();
        return self::$instance;
    }

    use Activation_Deactivation, Register_Post_type, Elementor_Extends;
    public function __construct(){
        register_activation_hook( __FILE__, [$this, 'activate'] );
        register_deactivation_hook( __FILE__, [$this, 'deactivate'] );
        register_uninstall_hook( __FILE__, [$this,'uninstall'] );

        add_action('init', [$this, 'register_custom_post_types']);

        add_action( 'add_meta_boxes', [$this, 'add_post_custom_filds']);

        // Elementor Extends
        $this->elementor_extends_init();
    }

    public function register_custom_post_types(){
        $this->register_team_post_type();
    }

    public function add_post_custom_filds(){
        $this->team_meta_box();
    }

    // Other plugin methods can be added here
    private function elementor_extends_init(){
        // elementor custom dynamic tag
        add_action('elementor/dynamic_tags/register', [$this, 'frz_custom_daynamic_tag']);
    }
}

// Initialize the plugin
Forazitech_plugin::get_instance();