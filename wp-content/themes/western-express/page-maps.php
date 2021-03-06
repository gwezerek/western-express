<?php
/**
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::get_context();
$post = new TimberPost();
$context['post'] = $post;
$context['posts'] = Timber::get_posts('post_type=post');

$post_cats = Timber::get_terms('week');
$context['weeks'] = $post_cats;

Timber::render(array('page-' . $post->post_name . '.twig', 'page.twig'), $context);