<?php
/**
 * A snippet to create a new custom category taxonomy for a post type in WordPress. For more info, view:
 *
 * @link https://codex.wordpress.org/Function_Reference/register_taxonomy
 *
 * @package plugin-sample
 */

namespace Source\Taxonomies\CustomCategory;

if ( !defined( 'ABSPATH' ) )
    exit;

class CustomCategory
{
    public $taxonomy   = 'custom_cat';
    public $post_type  = 'sample';

    public $rest_base  = 'custom_cat';
    public $query_var  = 'custom_cat';
    public $rewrite    = array( 
        'slug'          => 'custom-cat',
        'with_front'    => false,
        'hierarchical'  => true,
        'ep_mask'       => EP_NONE,
    );

    public function __construct()
    {
        add_action( 'init', array( $this, 'add_custom_category' ) );
        add_filter( 'taxonomy_template', array( $this, 'get_custom_category_template' ) );
    }

    public function add_custom_category()
    {
        $args = array(
            'label'  => __( 'Custom Categories', 'plugin-sample' ),
            'labels' => array(
                'name'                       => __( 'Custom Categories', 'plugin-sample' ),
                'singular_name'              => __( 'Custom Category', 'plugin-sample' ),
                'menu_name'                  => __( 'Custom Categories', 'plugin-sample' ),
                'all_items'                  => __( 'All Custom Categories', 'plugin-sample' ),
                'edit_item'                  => __( 'Edit Custom Category', 'plugin-sample' ),
                'view_item'                  => __( 'View Custom Category', 'plugin-sample' ),
                'update_item'                => __( 'Update Custom Category', 'plugin-sample' ),
                'add_new_item'               => __( 'Add new Custom Category', 'plugin-sample' ),
                'new_item_name'              => __( 'New Custom Category Name', 'plugin-sample' ),
                'parent_item'                => __( 'Parent Custom Category', 'plugin-sample' ),
                'parent_item_colon'          => __( 'Parent Custom Category:', 'plugin-sample' ),
                'search_items'               => __( 'Search Custom Categories', 'plugin-sample' ),
                'not_found'                  => __( 'Custom Categories not Found', 'plugin-sample' ),
                'back_to_items'              => __( 'Back to Custom Categories', 'plugin-sample' ),
            ),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_rest' => true,
            'rest_base' => $this->rest_base,
            'show_in_quick_edit' => true,
            'show_admin_column' => false,
            'description' => __( 'Custom Category Description', 'plugin-sample' ),
            'hierarchical' => true,
            'query_var' => $this->query_var,
            'rewrite' => $this->rewrite
        );

        register_taxonomy( $this->taxonomy, $this->post_type, $args );
    }

    public function get_custom_category_template( $template )
    {
        if ( get_query_var( 'taxonomy' ) === $this->taxonomy )
            $template = PREFIX_PLUGIN_DIR . 'src/Taxonomies/CustomCategory/views/taxonomy-category.php';

        return $template;
    }
}
