<?php
/**
 * Generate child theme functions and definitions
 *
 * @package Generate
 */

/**
 * Prevent WordPress from adding <p> tags automatically.
 */
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

/**
 * TN - Remove Query String from Static Resources. See http://bit.ly/2rYGwBo
 */
function remove_css_js_ver( $src ) {
if( strpos( $src, '?ver=' ) )
$src = remove_query_arg( 'ver', $src );
return $src;
}
add_filter( 'style_loader_src', 'remove_css_js_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_css_js_ver', 10, 2 );