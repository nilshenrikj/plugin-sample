<?php
if ( !defined( 'ABSPATH' ) )
    exit;

class JMC87_PluginConfig
{
    public function __construct()
    {
        add_action( 'plugins_loaded', array( $this, 'jmc87_load_textdomain' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'jmc87_load_includes' ) );
    }

    public function jmc87_load_textdomain()
    {
        load_plugin_textdomain( 'jmc87_plugin_textdomain', false, LANG_DIR );
    }

    public function jmc87_load_includes()
    {
        if ( !is_admin() )
        {
            wp_enqueue_script( 'custom-scripts', PLUGIN_URL . 'inc/js/custom-scripts.js', array(), PLUGIN_VERSION, true );
            wp_enqueue_style( 'custom-styles', PLUGIN_URL . 'inc/css/custom-styles.css', array(), PLUGIN_VERSION );
        }
    }

    public static function jmc87_plugin_install()
    {
        if ( !current_user_can( 'activate_plugins' ) ) {
            wp_die( sprintf( __( 'Don\'t have enough permissions to install this plugin. <a href="%s">Back to plugins page.</a>', 'jmc87_plugin_textdomain' ), esc_url( admin_url( 'plugins.php' ) ) ) );
        }
    }

    public static function jmc87_plugin_deactivate()
    {
        if ( !current_user_can( 'activate_plugins' ) ) {
            wp_die( sprintf( __( 'Don\'t have enough permissions to deactivate this plugin. <a href="%s">Back to plugins page.</a>', 'jmc87_plugin_textdomain' ), esc_url( admin_url( 'plugins.php' ) ) ) );
        }
    }

    public static function jmc87_plugin_uninstall()
    {
        if ( !current_user_can( 'activate_plugins' ) ) {
            wp_die( sprintf( __( 'Don\'t have enough permissions to uninstall this plugin. <a href="%s">Back to plugins page.</a>', 'jmc87_plugin_textdomain' ), esc_url( admin_url( 'plugins.php' ) ) ) );
        }
    }
}
