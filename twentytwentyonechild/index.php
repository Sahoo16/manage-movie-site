
<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header(); ?>
<?php if ( is_home() && ! is_front_page() && ! empty( single_post_title( '', false ) ) ) : ?>
	<header class="page-header alignwide">
		<h1 class="page-title"><?php single_post_title(); ?></h1>
	</header><!-- .page-header -->
<?php endif; ?>
<div class="main-banner">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 align-self-center">
        <div class="caption header-text">
          <h6>Welcome to free movies</h6>
          <h2>WORST Movie SITE EVER!</h2>
          <div class="search-input">
            <form id="search" action="#">
              <input type="text" placeholder="search your movie" id='searchText' name="s" onkeypress="handle" />
              <button role="button">Search Now</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-4 offset-lg-2">
        <div class="right-image">
          <img src="https://images.unsplash.com/photo-1626814026160-2237a95fc5a0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bW92aWUlMjBwb3N0ZXJ8ZW58MHx8MHx8fDA%3D&w=1000&q=80" alt="">
          <!-- <span class="price"></span>
          <span class="offer"></span> -->
        </div>
      </div>
    </div>
  </div>
</div>

<div class="features">
<div class="container">
  <div class="row">
    <div class="col-lg-3 col-md-6">
      <a href="#">
        <div class="item">
          <div class="image">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/featured-01.png" alt="" style="max-width: 44px;">
          </div>
          <h4>Free Movies</h4>
        </div>
      </a>
    </div>
    <div class="col-lg-3 col-md-6">
      <a href="#">
        <div class="item">
          <div class="image">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/featured-02.png" alt="" style="max-width: 44px;">
          </div>
          <h4>User</h4>
        </div>
      </a>
    </div>
    <div class="col-lg-3 col-md-6">
      <a href="#">
        <div class="item">
          <div class="image">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/featured-03.png" alt="" style="max-width: 44px;">
          </div>
          <h4>Reply us</h4>
        </div>
      </a>
    </div>
    <div class="col-lg-3 col-md-6">
      <a href="#">
        <div class="item">
          <div class="image">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/featured-04.png" alt="" style="max-width: 44px;">
          </div>
          <h4>Explore</h4>
        </div>
      </a>
    </div>
  </div>
</div>
</div>


<div class="section trending">
<div class="container">
  <div class="row">
    <div class="col-lg-6">
      <div class="section-heading">
        <h2>Trending  Movies</h2>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="main-button">
        <a href="/wordpress/movie/">View All Movies</a>
      </div>
    </div>
<?php
    
    
    $custom_query = new WP_Query(array(
    'post_type' => 'movie',
    'posts_per_page' => 1,
    'meta_key' => 'post_views',  
    'orderby' => 'meta_value_num',   
    'order' => 'DESC',    
));?>    
<?php
if ( $custom_query->have_posts() ) {


	// Load posts loop.
	while ( $custom_query->have_posts() ) {
		$custom_query->the_post();
    ?>
    <div class="col-lg-3 col-md-6">
      <div class="item">
        <div class="thumb">
          <a href="<?php echo get_permalink(); ?>"><img src="<?php echo the_post_thumbnail_url(); ?>" alt=""></a>
          <span class="price"><em></em>click</span>
        </div>
        <div class="down-content">
          <span class="category">Drama</span>
          <h4><?php echo get_the_title(); ?></h4>
        </div>
      </div>
    </div>  
    <?php

		// get_template_part( 'template-parts/content/content', get_theme_mod( 'display_excerpt_or_full_post', 'excerpt' ) );
    
	}

	// Previous/next page navigation.
	twenty_twenty_one_the_posts_navigation();


} else {

	// If no content, include the "No posts found" template.
	// get_template_part( 'template-parts/content/content-none' );

}
?>
</div>
</div>
</div>


<!-- category area start -->
<div class="section categories">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="section-heading">
            <h6>Chose your category</h6>
            <h2>Top Categories</h2>
          </div>
        </div>
        <?php

            $terms = get_terms( array(
              'taxonomy'   => 'movie_genre',
              'hide_empty' => false,
            ) );

            if ($terms && !is_wp_error($terms)) {
                foreach ($terms as $term) {
                     ?>
                    <div class="col-lg col-sm-6 col-xs-12">
                      <div class="item">
                        <h4><?php echo $term->name; ?></h4>
                        <div class="thumb">

                          <?php 
                            $term_image = get_field('genre_image', 'movie_genre_' . $term->term_id);
                            $term_url = get_term_link($term->term_id);
                          //  if ($term_image) {
                          //     echo '<img src="' . esc_url($term_image['url']) . '" alt="' . esc_attr($term->name) . '" />';
                          // } ?>

                          <a href="<?php echo esc_url($term_url); ?> ">
                        
                        <?php if (!empty($term_image)) { ?>
                                  <img src="<?php echo esc_url($term_image); ?>" alt="<?php echo $term->name; ?>">
                              <?php } ?>
                              </a>
                        </div>
                      </div>
                    </div>
                  <?php
                }
            }
        ?>
        
      </div>
    </div>
  </div>

 <!-- category area end -->



    
   


<?php
 get_footer();