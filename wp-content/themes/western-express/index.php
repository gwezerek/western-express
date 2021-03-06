<?php
/**
 * The main template file
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package 	WordPress
 * @subpackage 	Timber
 * @since 		Timber 0.1
 */


	if (!class_exists('Timber')){
		echo 'Timber not activated';
	}
	$data = Timber::get_context();
	$data['menu'] = new TimberMenu();
	$posts = Timber::get_posts('TimberPost');
	$data['posts'] = $posts;

	$post_cats = Timber::get_terms('week');
	$data['weeks'] = $post_cats;

	$templates = array('index.twig');
	if (is_home()){
		array_unshift($templates, 'home.twig');
	}
	Timber::render($templates, $data);


