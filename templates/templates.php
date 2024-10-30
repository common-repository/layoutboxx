<?php
class PageTemplates {

	private static $instance;
	protected $templates; //array of templates provided by this plugin

	public static function get_instance() { //if no instance yet, create new
		return self::$instance == null ? new PageTemplates() : self::$instance;
	}

	//Initializes the plugin by setting filters and administration functions.
	private function __construct() {

		$this->templates = array(); // empty array to work with later

		// register to templates list of theme
		if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {
			// 4.6 and older
			add_filter( 'page_attributes_dropdown_pages_args', array( $this, 'register_project_templates' ) );
		} else {
			// 4.7 and newer
			add_filter( 'theme_page_templates', array( $this, 'add_new_template' ) );
		}

		// register template and make savable
		add_filter( 'wp_insert_post_data', array( $this, 'register_project_templates' ) );


		// add a filter to the template include to determine if the page has our template assigned and return it's path
		add_filter(
			'template_include',
			array( $this, 'view_project_template')
		);


		// list of provided templates
		$this->templates = array(
			'fullscreen.php' => 'LayoutBoxx Fullscreen',
		);

	}

	// add template to the page dropdown for v4.7+
	public function add_new_template( $posts_templates ) {
		$posts_templates = array_merge( $posts_templates, $this->templates );
		return $posts_templates;
	}

	// add template to the pages cache in order to trick WordPress into thinking the template file exists where it doens't really exist.
	public function register_project_templates( $atts ) {

		// create the key used for the themes cache
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		// retrieve the cache list.
		// if it doesn't exist, or it's empty prepare an array
		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = array();
		}

		// new cache, therefore remove the old one
		wp_cache_delete( $cache_key , 'themes');

		// now add template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge( $templates, $this->templates );

		// add the modified cache to allow WordPress to pick it up for listing
		// available templates
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;

	}

	// checks if the template is assigned to the page
	public function view_project_template( $template ) {

		// get global post
		global $post;

		// return template if post is empty
		if ( ! $post ) {
			return $template;
		}

		// return default template if we don't have a custom one defined
		if ( ! isset( $this->templates[get_post_meta(
			$post->ID, '_wp_page_template', true
		)] ) ) {
			return $template;
		}

		$file = plugin_dir_path( __FILE__ ). get_post_meta(
			$post->ID, '_wp_page_template', true
		);

		// just to be safe, we check if the file exist first
		if ( file_exists( $file ) ) {
			return $file;
		} else {
			echo $file;
		}

		// return template
		return $template;

	}

}
add_action( 'plugins_loaded', array( 'PageTemplates', 'get_instance' ) );
