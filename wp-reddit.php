<?php
/*
Plugin Name: WP-reddit
Plugin URI: http://wordpress.org/extend/plugins/wp-reddit/
Description: Automatically adds a reddit button using the seen it URL
Author: Avinash Arora
Version: 0.2a
Author URI: http://avinasharora.com/
*/
wp_register_style( 'wpredditStylesheet', WP_PLUGIN_URL .'/'.basename( dirname( __FILE__ ) ).'/wp-reddit.css' ); //location of CSS file
wp_enqueue_style('wpredditStylesheet');
//going to add the reddit image based on post content
function add_post_footer_wpreddit( $content ){
	global $post;
	//Write the submission URL:						get the permalink for post					get the post title
	$submiturl = 'http://en.reddit.com/submit?url='.trim(get_permalink( $post->ID )).'&title='.get_the_title($post->ID);
	//form the button using submission URL, and HTML markup to include the image, div wrapper, etc.
	$redditbutton = '<div id="wp_reddit_wrapper"><a href="'.$submiturl.'" id="wp_reddit_link" target="_blank"><img id="wp_reddit_hover" src="'.WP_PLUGIN_URL .'/'.basename( dirname( __FILE__ ) ).'/wp-reddit.png"></a></div><br />';
	$content=$content.$redditbutton;
	return $content;
}
//finally, add it to the_content using a filter (which simply slaps our button at the end)
add_filter( 'the_content', 'add_post_footer_wpreddit' );
//if you're a little handy with php, feel free to use the function add_post_footer_wpreddit to whatever you like. I encourage it!
?>