<?php
/**
Template Name: Portfolio

 */

 
 // No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>

	<div id="primary" <?php generate_content_class();?>>
		<main id="main" <?php generate_main_class(); ?>>
			<?php do_action('generate_before_main_content'); ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
				// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) : ?>
					<div class="comments-area">
						<?php comments_template(); ?>
					</div>
				<?php endif; ?>

			<?php endwhile; // end of the loop. ?>
			
			<?php
	
				$args = array(
					'post_type' => 'portfolio_item'//The post type is set in CPT UI
				);
				$query = new WP_Query( $args );
			
			?>
			
			<?php //The following code for setting counter and applying conditional classes is adapted from https://www.nosegraze.com/display-wordpress-posts-2-3-columns/
			$i = 1; //set post counter ?>
			<?php if( $query->have_posts() ) : while( $query->have_posts() ) : $query->the_post(); ?>
				
				
				
				<div class="grid-5 tablet-grid-20 mobile-grid-10<?php
					//Checks if post has an odd number that is not 1, and echoes class accordingly
					if ( ($i % 2 !== 0) &&  ($i !== 1))
					echo ' portfolio-clear-both';
					?><?php
					//Checks if post is not number 1, and echoes class accordingly
					if ($i !== 1)
					echo ' portfolio-tablet-clear-both';
					?>"></div>
				<section class="portfolio-item-container grid-40 tablet-grid-60 mobile-grid-80">
					<div class="portfolio-title-container<?php
					//Checks if post number is more than 1, and echoes class accordingly (this sets the dividing borders on smaller screens, and also adds top padding to the title on smaller screens.)
					if ($i > 1)
					echo ' portfolio-title-container-tablet-and-mobile-only';
					?><?php
					//Checks if post number is more than 2, and echoes class accordingly (this sets the dividing borders on larger screens, and also adds top padding to the title.)
					if ($i > 2)
					echo ' portfolio-title-container-large-screen-only';
					?>">
						<h3><?php the_title(); ?></h3>
					</div>
					<div><?php the_field('image'); ?></div>
					<div class="boxed-body-text"><?php the_field('portfolio_item_description'); ?></div>
					<a href="<?php the_field('website_link'); ?>" target="_blank" rel="noopener noreferrer" class="my-button portfolio-button" style="background-color: <?php the_field('button-colour'); ?>; color: <?php the_field('button-text-colour'); ?>;">View website</a>
				</section>
				
				<div class="grid-5 tablet-grid-20 mobile-grid-10"></div>
				
				
				
				<?php $i++; ?>
				
				
			
			<?php endwhile; endif; wp_reset_postdata() ?>
			
			<?php do_action('generate_after_main_content'); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php 
do_action('generate_sidebars');
get_footer();