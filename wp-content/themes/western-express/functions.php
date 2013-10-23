<?php

	add_theme_support('post-formats');
	add_theme_support('post-thumbnails');
	add_theme_support('menus');

	add_filter('get_twig', 'add_to_twig');
	add_filter('timber_context', 'add_to_context');

	add_action('wp_enqueue_scripts', 'load_scripts');

	define('THEME_URL', get_template_directory_uri());

	function add_to_context($data){
		/* this is where you can add your own data to Timber's context object */
		$data['foo'] = 'bar';
		return $data;
	}

	function add_to_twig($twig){
		/* this is where you can add your own fuctions to twig */
		$twig->addExtension(new Twig_Extension_StringLoader());
		$twig->addFilter('myfoo', new Twig_Filter_Function('myfoo'));
		return $twig;
	}

	function myfoo($text){
    	$text .= ' bar!';
    	return $text;
	}

	function load_scripts(){
		wp_enqueue_script('jquery');
        // wp_enqueue_script('upbase', THEME_URL.'/js/upstatement-base.js', array('jquery', 'easytabs', 'safelog'), false, true);

	}

	Timber::add_route('maps/:weekName', function($params){
		$query = 'post_type=post&field=slug='.$params['weekName'];
		$query = array('post_type' => 'post', 'tax_query' => array(
			array(
			'taxonomy' => 'week',
			'field' => 'slug',
			'terms' => $params['weekName']
			)
		));
		
		Timber::load_template('page-maps.php', $query);
	});

	Timber::add_route('gear/:catName', function($params){
		$query = 'post_type=gear&field=slug='.$params['catName'];
		$query = array('post_type' => 'gear', 'tax_query' => array(
			array(
			'taxonomy' => 'gear-category',
			'field' => 'slug',
			'terms' => $params['catName']
			)
		));
		
		Timber::load_template('archive-gear.php', $query);
	});	

	
