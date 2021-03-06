<?php
/**
 * Inspiro functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Inspiro
 * @since Inspiro 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Inspiro_After_Setup_Theme initial setup
 * 
 * @since 1.0.0
 */
if ( ! class_exists( 'Inspiro_After_Setup_Theme' ) ) {
    
    class Inspiro_After_Setup_Theme {
        /**
         * Instance
         *
         * @var $instance
         */
        private static $instance;

        /**
         * Initiator
         *
         * @since 1.0.0
         * @return object
         */
        public static function get_instance() {
            if ( ! isset( self::$instance ) ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Constructor
         */
        public function __construct() {
            add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
            add_action( 'template_redirect', array( $this, 'theme_content_width' ), 0 );
        }

        /**
         * Sets up theme defaults and registers support for various WordPress features.
         *
         * Note that this function is hooked into the after_setup_theme hook, which
         * runs before the init hook. The init hook is too late for some features, such
         * as indicating support for post thumbnails.
         * 
         * @since 1.0.0
         */
        public function theme_setup() {

            do_action( 'inspiro_lite_theme_setup' );

            /*
             * Make theme available for translation.
             * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/inspiro-lite
             */
            load_theme_textdomain( 'inspiro', INSPIRO_THEME_DIR . '/languages' );

            // Add default posts and comments RSS feed links to head.
            add_theme_support( 'automatic-feed-links' );

            /*
             * Let WordPress manage the document title.
             * By adding theme support, we declare that this theme does not use a
             * hard-coded <title> tag in the document head, and expect WordPress to
             * provide it for us.
             */
            add_theme_support( 'title-tag' );

            /*
             * Enable support for Post Thumbnails on posts and pages.
             *
             * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
             */
            add_theme_support( 'post-thumbnails' );

            /**
             * Register image sizes.
             */
            add_image_size( 'inspiro-featured-image', 2000 );
            add_image_size( 'inspiro-recent-thumbnail', 345, 192, true );
            add_image_size( 'inspiro-recent-thumbnail-retina', 690, 384, true );
            add_image_size( 'inspiro-entry-cover', 1800 );
            add_image_size( 'inspiro-loop', 950, 320, true );

            // Set the default content width.
            $GLOBALS['content_width'] = 950;

            // Register nav menus.
            register_nav_menus(
                array(
                    'primary' => __( 'Main Menu', 'inspiro' )
                )
            );

            /*
             * Switch default core markup for search form, comment form, and comments
             * to output valid HTML5.
             */
            add_theme_support(
                'html5',
                array(
                    'comment-form',
                    'comment-list',
                    'gallery',
                    'caption',
                    'script',
                    'style',
                )
            );

            /*
             * Enable support for Post Formats.
             *
             * See: https://wordpress.org/support/article/post-formats/
             */
            add_theme_support(
                'post-formats',
                array(
                    'aside',
                    'image',
                    'video',
                    'quote',
                    'link',
                    'gallery',
                    'audio',
                )
            );

            // Add theme support for Custom Logo.
            add_theme_support(
                'custom-logo',
                array(
                    'height'      => 100,
                    'width'       => 400,
                    'flex-height' => true,
                    'flex-width'  => true
                )
            );

            // Add theme support for selective refresh for widgets.
            add_theme_support( 'customize-selective-refresh-widgets' );

            /*
             * This theme styles the visual editor to resemble the theme style,
             * specifically font, colors, and column width.
             */
            $dir_name    = ( SCRIPT_DEBUG ) ? 'unminified' : 'minified';
            $file_prefix = ( SCRIPT_DEBUG ) ? '' : '.min';

            add_editor_style(
                array(
                    'assets/css/'. $dir_name .'/editor-style'. $file_prefix .'.css',
                    inspiro_fonts_url()
                )
            );

            // Load regular editor styles into the new block-based editor.
            add_theme_support( 'editor-styles' );

            // Load default block styles.
            add_theme_support( 'wp-block-styles' );

            // Add support for responsive embeds.
            add_theme_support( 'responsive-embeds' );

            /*
             * Adds starter content to highlight the theme on fresh sites.
             * This is done conditionally to avoid loading the starter content on every
             * page load, as it is a one-off operation only needed once in the customizer.
             */
            if ( is_customize_preview() ) {
                require get_template_directory() . '/inc/starter-content.php';
                add_theme_support( 'starter-content', inspiro_get_starter_content() );
            }
        }

        /**
         * Set the content width in pixels, based on the theme's design and stylesheet.
         *
         * Priority 0 to make it available to lower priority callbacks.
         *
         * @since 1.0.0
         * 
         * @global int $content_width
         */
        public function theme_content_width() {

            $content_width = $GLOBALS['content_width'];

            // Get layout.
            $blog_layout = get_theme_mod( 'layout_blog_page', 'full' );

            // Check if layout is full width.
            if ( 'full' === $blog_layout ) {
                if ( inspiro_is_frontpage() && ! is_active_sidebar( 'blog-sidebar' ) ) {
                    $content_width = 1200;
                } elseif ( is_page() ) {
                    $content_width = 950;
                }
            }

            // Check if is single post and there is no sidebar.
            if ( is_single() && ! is_active_sidebar( 'blog-sidebar' ) ) {
                $content_width = 950;
            }

            /**
             * Filters Inspiro content width of the theme.
             *
             * @since 1.0.0
             *
             * @param int $content_width Content width in pixels.
             */
            $GLOBALS['content_width'] = apply_filters( 'inspiro_content_width', $content_width );
        }
    }

}

Inspiro_After_Setup_Theme::get_instance();