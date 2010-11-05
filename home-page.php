<?php
/*
Template Name: Home Page
*/
?>

<?php get_header(); ?>

<div class="content">

<div id="primary-wrapper">
	<div id="primary">
		<div id="notices"></div>
		<a name="startcontent" id="startcontent"></a>

		<div id="current-content">

			<div class="entry-content">
				<?php the_content(); ?>
				<div id="homeboxes">
					<div class="home_box home_box1">
						<?php if( $home_box_header1 = get_post_meta($post->ID, 'home_box_header1', true) ) { ?>
							<h3><?php echo $home_box_header1; ?></h3><?php } ?>
						<?php if( $home_box1 = get_post_meta($post->ID, 'home_box1', true) ) { ?>
							<p><?php echo $home_box1; ?></p><?php } ?>
					</div>
					<div class="home_box home_box2">
						<?php if( $home_box_header2 = get_post_meta($post->ID, 'home_box_header2', true) ) { ?>
							<h3><?php echo $home_box_header2; ?></h3><?php } ?>
						<?php if( $home_box2 = get_post_meta($post->ID, 'home_box2', true) ) { ?>
							<p><?php echo $home_box2; ?></p><?php } ?>
					</div>
					<div class="home_box home_box3">
						<?php if( $home_box_header3 = get_post_meta($post->ID, 'home_box_header3', true) ) { ?>
							<h3><?php echo $home_box_header3; ?></h3><?php } ?>
						<?php if( $home_box3 = get_post_meta($post->ID, 'home_box3', true) ) { ?>
							<p><?php echo $home_box3; ?></p><?php } ?>
					</div>
					<div class="clearfix"></div>
				</div>
			</div><!-- .entry-content -->
			<h2>Recent Posts</h2>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php 
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$post_per_page = 4; // -1 shows all posts
					$do_not_show_stickies = 1; // 0 to show stickies
					$args=array(
					  'orderby' => 'date',
					  'order' => 'DESC',
					  'paged' => $paged,
					  'posts_per_page' => $post_per_page,
					  'caller_get_posts' => $do_not_show_stickies
					);
					$temp = $wp_query;  // assign orginal query to temp variable for later use   
					$wp_query = null;
					$wp_query = new WP_Query($args);
					if (have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
				
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="entry-head">
								<h3 class="entry-title">
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php k2_permalink_title(); ?>"><?php the_title(); ?></a>
								</h3>

								<?php /* Edit Link */ edit_post_link( __('Edit','k2_domain'), '<span class="entry-edit">', '</span>' ); ?>

								<?php if ( 'post' == $post->post_type ): ?>
								<div class="entry-meta">
									<?php k2_entry_meta(1); ?>
								</div> <!-- .entry-meta -->
								<?php endif; ?>

								<?php /* K2 Hook */ do_action('template_entry_head'); ?>
							</div><!-- .entry-head -->

							<div class="entry-content">
								<?php if ( function_exists('has_post_thumbnail') and has_post_thumbnail() ): ?>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( array( 75, 75 ), array( 'class' => 'alignleft' ) ); ?></a>
								<?php endif; ?>
								<?php the_content( sprintf( __('Continue reading \'%s\'', 'k2_domain'), the_title('', '', false) ) ); ?>
							</div><!-- .entry-content -->

							<div class="entry-foot">
								<?php wp_link_pages( array('before' => '<div class="entry-pages"><span>' . __('Pages:','k2_domain') . '</span>', 'after' => '</div>' ) ); ?>

								<?php if ( 'post' == $post->post_type ): ?>
								<div class="entry-meta">
									<?php k2_entry_meta(2); ?>
								</div><!-- .entry-meta -->
								<?php endif; ?>

								<?php /* K2 Hook */ do_action('template_entry_foot'); ?>
							</div><!-- .entry-foot -->
						</div><!-- #post-ID -->

					<?php endwhile; /* End The Loop */ ?>
				
				<?php endif; $wp_query = $temp; ?>


				<div class="entry-foot">
					<?php wp_link_pages( array('before' => '<div class="entry-pages"><span>' . __('Pages:','k2_domain') . '</span>', 'after' => '</div>' ) ); ?>

					<?php /* K2 Hook */ do_action('template_entry_foot'); ?>
				</div><!-- .entry-foot -->
			</div><!-- #post-ID -->

		</div><!-- #current-content -->

		<div id="dynamic-content"></div>
	</div><!-- #primary -->
</div><!-- #primary-wrapper -->

<div class="clearfix"></div>
</div><!-- .content -->
	
<?php get_footer(); ?>