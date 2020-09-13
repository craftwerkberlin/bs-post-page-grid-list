<?php
/*Plugin Name: bS Post / Page Grid / List
Plugin URI: https://bootscore.me/plugins/post-page-grid-list/
Description: Displays posts from category or child pages from parent id in your post or page via shortcode. Post Grid [post-grid type="post" category="documentation, category-default" order="ASC" orderby="title" posts="6"], Post List [post-list type="post" category="documentation, category-default" order="DESC" orderby="date" posts="6"], Child Page Grid [post-grid type="page" post_parent="413" order="ASC" orderby="title" posts="6"], Child Page List [post-list type="page" post_parent="413" order="DESC" orderby="date"]
Version: 1.0.0
Author: Bastian Kreiter
Author URI: https://crftwrk.de
License: GPLv2
*/


// Post Grid Shortcode
add_shortcode( 'post-grid', 'bootscore_post_grid' );
function bootscore_post_grid( $atts ) {
	ob_start();
	extract( shortcode_atts( array (
		'type' => 'post',
		'order' => 'date',
		'orderby' => 'date',
		'posts' => -1,
		'category' => '',
        'post_parent'    => '',
        
	), $atts ) );
	$options = array(
		'post_type' => $type,
		'order' => $order,
		'orderby' => $orderby,
		'posts_per_page' => $posts,
		'category_name' => $category,
        'post_parent' => $post_parent,
        
	);
	$query = new WP_Query( $options );
	if ( $query->have_posts() ) { ?>


<div class="row">
    <?php while ( $query->have_posts() ) : $query->the_post(); ?>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100">
            <!-- Featured Image-->
            <?php the_post_thumbnail('medium', array('class' => 'card-img-top')); ?>

            <div class="card-body d-flex flex-column">
                <div class="mb-2">
                    <!-- Category Badge -->
                    <?php   
				        $thelist = '';
				        $i = 0;
				        foreach( get_the_category() as $category ) {
				            if ( 0 < $i ) $thelist .= ' ';
				                $thelist .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="badge badge-secondary">' . $category->name.'</a>';
								$i++;
				        }
				        echo $thelist;
				    ?>
                </div>
                <!-- Title -->
                <h2 class="blog-post-title">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
                <!-- Meta -->
                <?php if ( 'post' === get_post_type() ) : ?>
                <small class="text-muted mb-2">
                    <?php
				        bootscore_date();
				        bootscore_author();
				        bootscore_comments();
				        bootscore_edit();
				    ?>
                </small>
                <?php endif; ?>
                <!-- Excerpt & Read more -->
                <div class="card-text mt-auto">
                    <?php the_excerpt(); ?> <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read more', 'bootscore'); ?></a>
                </div>
                <!-- Tags -->
                <?php bootscore_tags(); ?>
            </div>
        </div>
    </div>
    <?php endwhile; wp_reset_postdata(); ?>
</div>

<?php $myvariable = ob_get_clean();
	return $myvariable;
	}	
}

// Post Grid Shortcode End





// Post List Shortcode
add_shortcode( 'post-list', 'bootscore_post_list' );
function bootscore_post_list( $atts ) {
	ob_start();
	extract( shortcode_atts( array (
		'type' => 'post',
		'order' => 'date',
		'orderby' => 'date',
		'posts' => -1,
		'category' => '',
        'post_parent'    => '',
	), $atts ) );
	$options = array(
		'post_type' => $type,
		'order' => $order,
		'orderby' => $orderby,
		'posts_per_page' => $posts,
		'category_name' => $category,
        'post_parent' => $post_parent,
	);
	$query = new WP_Query( $options );
	if ( $query->have_posts() ) { ?>


<?php while ( $query->have_posts() ) : $query->the_post(); ?>


<div class="card horizontal mb-4">
    <div class="row">
        <!-- Featured Image-->
        <?php if (has_post_thumbnail() )
            echo '<div class="card-img-left-md col-lg-5">' . get_the_post_thumbnail(null, 'medium') . '</div>';
        ?>
        <div class="col">
            <div class="card-body">
                <div class="mb-2">
                    <!-- Category Badge -->
                    <?php
				        $thelist = '';
				        $i = 0;
				        foreach( get_the_category() as $category ) {
				            if ( 0 < $i ) $thelist .= ' ';
				            $thelist .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="badge badge-secondary">' . $category->name.'</a>';
				            $i++;
				        }
				        echo $thelist;
				    ?>
                </div>
                <!-- Title -->
                <h2 class="blog-post-title">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
                <!-- Meta -->
                <?php if ( 'post' === get_post_type() ) : ?>
                <small class="text-muted mb-2">
                    <?php
				        bootscore_date();
				        bootscore_author();
				        bootscore_comments();
				        bootscore_edit();
				    ?>
                </small>
                <?php endif; ?>
                <!-- Excerpt & Read more -->
                <div class="card-text mt-auto">
                    <?php the_excerpt(); ?> <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read more', 'bootscore'); ?></a>
                </div>
                <!-- Tags -->
                <?php bootscore_tags(); ?>
            </div><!-- .card-body -->
        </div> <!-- .col -->
    </div> <!-- .row -->
</div> <!-- .card -->


<?php endwhile; wp_reset_postdata(); ?>


<?php $myvariable = ob_get_clean();
	return $myvariable;
	}	
}

// Post List Shortcode End