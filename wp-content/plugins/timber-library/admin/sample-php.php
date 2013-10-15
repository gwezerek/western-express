<article class="tease-post tz-post-m feed-mod" id="tz-<?php echo get_the_ID(); ?>">
	<h2 class="tz-post-head"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
	<?php
		if (get_post_thumbnail_id(get_the_ID())) {
		$src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()));
	} else {
		$src = '/wp-content/mytheme/default-missing-image.jpg';
	}
	?>
	<a href="<?php echo get_permalink(); ?>"><img src="<?php echo $src; ?>" /></a>
</article>