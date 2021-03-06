<?php
namespace Config;

if ( !defined( 'ABSPATH' ) )
    exit;

class PluginConfig
{
    public function __construct()
    {
        add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
        add_action( 'plugins_loaded', array( $this, 'load_sources' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'load_includes' ) );

        add_action( 'admin_init', array( $this, 'activate_plugin_process' ) );
        add_action( 'admin_init', array( $this, 'deactivate_plugin_process' ) );
        // add_action( 'admin_init', array( $this, 'uninstall_plugin_process' ) );
    }

    public function load_sources()
    {
        /** Customizer sections */
        $customizer_section = new \Source\Customizer\CustomizerSection\CustomizerSection;

        /** Taxonomies */
        $custom_category = new \Source\Taxonomies\CustomCategory\CustomCategory;
        $custom_tag      = new \Source\Taxonomies\CustomTag\CustomTag;

        /** Post types */
        $custom_post_type = new \Source\PostsTypes\SamplePostType\SamplePostType;

        /** Blocks categories */
        $custom_blocks_category = new \Source\BlocksCategories\CustomBlocksCategory\CustomBlocksCategory;

        /** Blocks */
        $custom_acf_block = new \Source\Blocks\CustomACFBlock\CustomACFBlock;

        /** Metaboxes */
        $custom_metabox = new \Source\Metaboxes\SampleMetabox\SampleMetabox;
    }

    public function load_textdomain()
    {
        load_plugin_textdomain( 'plugin-sample', false, PREFIX_LANG_DIR );
    }

    public function load_includes()
    {
        if ( !is_admin() )
        {
            wp_enqueue_script( 'custom-scripts', PREFIX_PLUGIN_URL . 'inc/js/custom-scripts.js', array(), PREFIX_PLUGIN_VERSION, true );
            wp_enqueue_style( 'custom-styles', PREFIX_PLUGIN_URL . 'inc/css/custom-styles.css', array(), PREFIX_PLUGIN_VERSION );
        }
    }

    public function activate_plugin_process()
    {
        if ( is_admin() && get_option( '__prefix_activate_plugin' ) === 'plugin-sample' ) {
            delete_option( '__prefix_activate_plugin' );
            deactivate_plugins( 'plugin-sample/plugin-sample.php', true );
            add_action( 'admin_notices', array( $this, 'render_activate_plugin_notice' ) );
        }
    }

    public function render_activate_plugin_notice()
    {
        ?><div class="notice notice-error is-dismissible">
            <p><?php _e( 'Don\'t have enough permissions to install this plugin.', 'plugin-sample' ); ?></p>
        </div><?php
    }

    public function deactivate_plugin_process()
    {
        if ( is_admin() && get_option( '__prefix_not_deactivate_plugin' ) === 'plugin-sample' ) {
            delete_option( '__prefix_not_deactivate_plugin' );
            add_action( 'admin_notices', array( $this, 'render_deactivate_plugin_notice' ) );
        }
    }

    public function render_deactivate_plugin_notice()
    {
        ?><div class="notice notice-error is-dismissible">
            <p><?php _e( 'Don\'t have enough permissions to deactivate this plugin.', 'plugin-sample' ); ?></p>
        </div><?php
    }

    public function uninstall_plugin_process()
    {
        
    }

    public function render_uninstall_plugin_notice()
    {
        ?><div class="notice notice-error is-dismissible">
            <p><?php _e( 'Don\'t have enough permissions to uninstall this plugin.', 'plugin-sample' ); ?></p>
        </div><?php
    }
}
