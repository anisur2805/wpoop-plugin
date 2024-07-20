<?php
$args = array(
	'post_type'      => 'testimonial',
	'posts_per_page' => 5,
	'post_status'    => 'publish',
	'meta_query'     => array(
		array(
			'key'     => '_wpoop_testimonial_key',
			'value'   => 's:8:"approved";s:1:"1";s:8:"featured";s:1:"1"',
			'compare' => 'LIKE',
		),
	),
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) {
	$i = 1;
	echo '<div class="wpoop-slider--wrapper"><div class="wpoop-slider--container"><div class="wpoop-slider--view"><ul>';
	while ( $query->have_posts() ) :
		$query->the_post();

		$name = get_post_meta( get_the_ID(), '_wpoop_testimonial_key', true )['name'] ?? '';

		echo '<li class="wpoop-slider--view__slides ' . ( 1 === $i ? 'is-active' : '' ) . '"><p class="testimonial-quote">"' . get_the_content() . '"</p><p class="testimonial-author">~ ' . $name . ' ~</p></li>';
		++$i;
	endwhile;
	echo '</ul><div class="testimonial-arrows"><span class="testimonial-arrow__left arrow">&#x3c;</span><span class="testimonial-arrow__right arrow">&#x3e;</span></div></div></div></div>';
}
