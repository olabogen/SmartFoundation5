<?php
// setup function
function smart_foundation_setup(){
	
	//load_theme_textdomain( 'smart_foundation', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// post formats.
	//add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );
	
	// add custom menus
	add_theme_support('menus');
	register_nav_menus( array(
		'main-menu' => __( 'Meny', 'smart_foundation' ) // registers the menu in the WordPress admin menu editor
	));

	// custom background and default background color.
	$defaults = array(
        'default-color'          => 'cccccc',
        'wp-head-callback'       => '_custom_background_cb',
    );
    add_theme_support( 'custom-background', $defaults );
    
    // custom header image.
    $args = array(
        'flex-width'    => true,
        'width'         => 1000,
        'flex-height'    => true,
        'height'        => 350,
        'default-image' => get_template_directory_uri() . '/images/standard-banner.jpg',
        );
    add_theme_support( 'custom-header', $args );
    
	// custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 596, 9999 ); // Unlimited height, soft crop
	//add_image_size( 'home-thumb', 290, 163 );
	
	 // Enable threaded comments
     if ( (!is_admin()) && is_singular() && comments_open() && get_option('thread_comments') ) wp_enqueue_script('comment-reply');
	 
	 	// Add language supports. Please note that Reverie Framework does not include language files.
	load_theme_textdomain('smart_foundation', get_template_directory() . '/language');

}

add_action( 'after_setup_theme', 'smart_foundation_setup' );

// includes foundation top bar walker and custom post types and fields
require_once get_template_directory() . '/includes/foundation-walker.php';
require_once get_template_directory() . '/includes/custom_fields_and_post_types.php';

// clear function
function smart_clear(){
    echo '<div class="smart-clear" style="clear:both;"></div>';
}

// pagination function
function smart_pagination($pages = '', $range = 2)
{  
	$showitems = ($range * 2)+1;  
	
	global $paged;
	if(empty($paged)) $paged = 1;
	
	if($pages == ''){
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages){
			$pages = 1;
		}
	}   
	
	if(1 != $pages){
	echo '<ul class="pagination">';
	if($paged > 2 && $paged > $range+1){
		echo '<li class="arrow"><a href="'.get_pagenum_link(1).'">&laquo;</a></li>';	
	}elseif($showitems < $pages){
		echo '<li class="arrow unavailable"><a href="">&laquo;</a></li>';
	}
	if($paged > 1){
		echo '<li class="arrow"><a href="'.get_pagenum_link($paged - 1).'">&lsaquo;</a></li>';
	}elseif($showitems < $pages){
		echo '<li class="arrow unavailable"><a href="">&lsaquo;</a></li>';	
	}
	
	for ($i=1; $i <= $pages; $i++){
		if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
			echo ($paged == $i)? '<li class="current"><a href="">'.$i.'</a></li>':'<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		}
	}
	
	if ($paged < $pages){
		echo '<li class="arrow"><a href="'.get_pagenum_link($paged + 1).'">&rsaquo;</a>';
	}elseif($showitems < $pages){
		echo '<li class="arrow unavailable"><a href="">&rsaquo;</a>';
	}
	if ($paged < $pages-1 &&  $paged+$range-1 < $pages){
		echo '<li class="arrow"><a href="'.get_pagenum_link($pages).'">&raquo;</a></li>';
	}elseif($showitems < $pages){
		echo '<li class="arrow unavailable"><a href="">&raquo;</a></li>';
	}
	 echo "</ul>\n";
	}
}

// image function 
function smart_img($imgName, $imgParam=''){
    
    if($imgParam == 'url'){
        $imgReturn = get_bloginfo('stylesheet_directory').'/images/'.$imgName;
    }elseif($imgParam){
        $imgReturn = '<img id="'.$imgParam.'" src="'.get_bloginfo('stylesheet_directory').'/images/'.$imgName.'" alt="'.$imgName.'" title="'.$imgName.'" />';
    }else{
        $imgReturn = '<img src="'.get_bloginfo('stylesheet_directory').'/images/'.$imgName.'" alt="'.$imgName.'" title="'.$imgName.'" />';
    }
    echo $imgReturn;

}

// register sidebars function
function smart_widgets_init(){
    	
    register_sidebar( array(
        'name' => __( 'Sidebar', 'smart_foundation' ),
        'id' => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '<hr /></aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );
    
    register_sidebar( array(
        'name' => __( 'Footer 1', 'smart_foundation' ),
        'id' => 'footer-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Footer 2', 'smart_foundation' ),
        'id' => 'footer-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );
	
	register_sidebar( array(
        'name' => __( 'Footer 3', 'smart_foundation' ),
        'id' => 'footer-3',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );

}
add_filter('widgets_init', 'smart_widgets_init');


// enqueue scripts and styles
function smart_enqueue_method() {
	// styles
	wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css' );
	wp_enqueue_style( 'foundationstyle', get_template_directory_uri() . '/css/foundation.css' );
	//wp_enqueue_style( 'foundicons', get_template_directory_uri() . '/fonts/foundation-icons.css' );
	//wp_enqueue_style( 'foundiconsie', get_template_directory_uri() . '/css/general_foundicons_ie7.css' );
	wp_enqueue_style( 'wpcorestyles', get_template_directory_uri() . '/css/wp-core-styles.css' );
	wp_enqueue_style( 'stylesheet', get_bloginfo( 'stylesheet_url' ), array( 'normalize', 'foundationstyle') );
	
	// scripts
	wp_enqueue_script('jquery');
	wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/custom.modernizr.js');
	wp_enqueue_script('foundation', get_template_directory_uri() . '/js/foundation.js', array('jquery'), false, true);
	wp_enqueue_script('f-placeholder', get_template_directory_uri() . '/js/foundation.placeholder.js', array('jquery', 'foundation'), false, true);
	wp_enqueue_script('f-topbar', get_template_directory_uri() . '/js/foundation.topbar.js', array('jquery', 'foundation'), false, true);
}
add_action('wp_enqueue_scripts', 'smart_enqueue_method');


// this script will replace the uploaded image (if bigger than the larger size defined in your settings) by the large image generated by WordPress to save space in your server, and save bandwidth if you link a thumbnail to the original image, like when a lightbox plugin is used.
function replace_uploaded_image($image_data) {
    // if there is no large image : return
    if (!isset($image_data['sizes']['large'])) return $image_data;
   
    // paths to the uploaded image and the large image
    $upload_dir = wp_upload_dir();
    $uploaded_image_location = $upload_dir['basedir'] . '/' . $image_data['file'];
    $large_image_location = $upload_dir['basedir'] . '/' . substr($image_data['file'], 0, 8) . $image_data['sizes']['large']['file'];

    // delete the uploaded image
    unlink($uploaded_image_location);
   
    // rename the large image
    rename($large_image_location,$uploaded_image_location);
   
    // update image metadata and return them
    $image_data['width'] = $image_data['sizes']['large']['width'];
    $image_data['height'] = $image_data['sizes']['large']['height'];
    unset($image_data['sizes']['large']);
   
    return $image_data;
}
add_filter('wp_generate_attachment_metadata','replace_uploaded_image');

// Rename ACF Default Options Page
if( function_exists('acf_set_options_page_menu') ) {
    acf_set_options_page_menu( __('General Information') );
}

// Advanced Custom Fields Options pages
// if(function_exists("register_options_page")){
//    register_options_page('Header');
//    register_options_page('Footer');
// }

?>