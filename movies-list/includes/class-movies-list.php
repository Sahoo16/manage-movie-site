<?php
class Manage_Movies {
    public function __construct() {
        add_action( 'init', array( $this, 'create_movie_type') );
        add_action( 'init', array( $this, 'create_movie_taxonomies' ) );
        add_action( 'add_meta_boxes', array( $this, 'add_movie_details_metabox' ) );
        add_action( 'save_post', array( $this, 'save_movie_details_data' ) );

    }

    //function for creating custome movie type post    
    public function create_movie_type() {

        $labels = array(
            'name'                  => _x( 'movies', 'Post Type General Name', 'text_domain' ),
            'singular_name'         => _x( 'movie', 'Post Type Singular Name', 'text_domain' ),
            'menu_name'             => __( 'movies', 'text_domain' ),
            'name_admin_bar'        => __( 'movies', 'text_domain' ),
            'archives'              => __( 'Movie', 'text_domain' ),
            'attributes'            => __( 'movie Attributes', 'text_domain' ),
            'parent_item_colon'     => __( 'Parent movie:', 'text_domain' ),
            'all_items'             => __( 'All Movies', 'text_domain' ),
            'add_new_item'          => __( 'Add New movie', 'text_domain' ),
            'add_new'               => __( 'Add New movie', 'text_domain' ),
            'new_item'              => __( 'New movie', 'text_domain' ),
            'edit_item'             => __( 'Edit movie', 'text_domain' ),
            'update_item'           => __( 'Update movie', 'text_domain' ),
            'view_item'             => __( 'View movie', 'text_domain' ),
            'view_items'            => __( 'View Movies', 'text_domain' ),
            'search_items'          => __( 'Search movies', 'text_domain' ),
            'not_found'             => __( 'Movie Not found', 'text_domain' ),
            'not_found_in_trash'    => __( 'Movie Not found in Trash', 'text_domain' ),
            'featured_image'        => __( 'Poster Image', 'text_domain' ),
            'set_featured_image'    => __( 'Set poster image', 'text_domain' ),
            'remove_featured_image' => __( 'Remove poster image', 'text_domain' ),
            'use_featured_image'    => __( 'Use as poster image', 'text_domain' ),
            'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
            'uploaded_to_this_item' => __( 'Uploaded to this movies', 'text_domain' ),
            'items_list'            => __( 'Movies list', 'text_domain' ),
            'items_list_navigation' => __( 'Movies list navigation', 'text_domain' ),
            'filter_items_list'     => __( 'Filter Movies list', 'text_domain' ),
        );
        $args = array(
            'label'                 => __( 'Movies', 'text_domain' ),
            'description'           => __( 'Post Type Description', 'text_domain' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );
        register_post_type( 'movie', $args );

    }
    public function create_movie_taxonomies() {
        // Category Taxonomy
        $labels = array(
            'name'                       => _x( 'Categories', 'taxonomy general name', 'text_domain' ),
            'singular_name'              => _x( 'Category', 'taxonomy singular name', 'text_domain' ),
            'search_items'               => __( 'Search Categories', 'text_domain' ),
            'popular_items'              => __( 'Popular Categories', 'text_domain' ),
            'all_items'                  => __( 'All Categories', 'text_domain' ),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => __( 'Edit Category', 'text_domain' ),
            'update_item'                => __( 'Update Category', 'text_domain' ),
            'add_new_item'               => __( 'Add New Category', 'text_domain' ),
            'new_item_name'              => __( 'New Category Name', 'text_domain' ),
            'separate_items_with_commas' => __( 'Separate categories with commas', 'text_domain' ),
            'add_or_remove_items'        => __( 'Add or remove categories', 'text_domain' ),
            'choose_from_most_used'      => __( 'Choose from the most used categories', 'text_domain' ),
            'not_found'                  => __( 'No categories found.', 'text_domain' ),
            'menu_name'                  => __( 'Categories', 'text_domain' ),
        );

        $args = array(
            'hierarchical'          => true,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'query_var'             => true,
            'rewrite'               => array( 'slug' => 'movie-category' ),
        );

        register_taxonomy( 'movie_category', array( 'movie' ), $args );

        // Genre Taxonomy
        $labels = array(
            'name'                       => _x( 'Genres', 'taxonomy general name', 'text_domain' ),
            'singular_name'              => _x( 'Genre', 'taxonomy singular name', 'text_domain' ),
            'search_items'               => __( 'Search Genres', 'text_domain' ),
            'popular_items'              => __( 'Popular Genres', 'text_domain' ),
            'all_items'                  => __( 'All Genres', 'text_domain' ),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => __( 'Edit Genre', 'text_domain' ),
            'update_item'                => __( 'Update Genre', 'text_domain' ),
            'add_new_item'               => __( 'Add New Genre', 'text_domain' ),
            'new_item_name'              => __( 'New Genre Name', 'text_domain' ),
            'separate_items_with_commas' => __( 'Separate genres with commas', 'text_domain' ),
            'add_or_remove_items'        => __( 'Add or remove genres', 'text_domain' ),
            'choose_from_most_used'      => __( 'Choose from the most used genres', 'text_domain' ),
            'not_found'                  => __( 'No genres found.', 'text_domain' ),
            'menu_name'                  => __( 'Genres', 'text_domain' ),
        );

        $args = array(
            'hierarchical'          => false,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'query_var'             => true,
            'rewrite'               => array( 'slug' => 'movie-genre' ),
        );

        register_taxonomy( 'movie_genre', array( 'movie' ), $args );
    }
    // Add metabox for Movie Details
    public function add_movie_details_metabox() {
        add_meta_box(
            'movie_details_metabox',
            'Movie Details',
            array($this, 'render_movie_details_metabox'),
            'movie',
            'normal',
            'default'
        );
    }

    // Render the Movie Details Metabox
    public function render_movie_details_metabox($post) {
        // Retrieve saved values (if they exist)
        $release_year = get_post_meta($post->ID, '_movie_release_year', true);
        $movie_length = get_post_meta($post->ID, '_movie_length', true);
        $trailer_link = get_post_meta($post->ID, '_movie_trailer_link', true);


        ?>
        <label for="movie_release_year">Release Year:</label>
        <input type="text" id="movie_release_year" name="movie_release_year" value="<?php echo esc_attr($release_year); ?>"><br>

        <label for="movie_length">Movie Length:</label>
        <input type="text" id="movie_length" name="movie_length" value="<?php echo esc_attr($movie_length); ?>"><br>

        <label for="movie_trailer_link">Trailer Link:</label>
        <input type="text" id="movie_trailer_link" name="movie_trailer_link" value="<?php echo esc_url($trailer_link); ?>"><br>
        <?php
    }

    // Save Movie Details Metabox Data
    public function save_movie_details_data($post_id) {
        
        if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
            return $post_id;
        }

        if  ( !empty( $_POST['post_type'] ) && 'movie' != $_POST['post_type'] ) {
            return $post_id;
        }
        $release_year = !empty( $_POST['movie_release_year'] ) ? $_POST['movie_release_year'] : '';
        $movie_length = !empty( $_POST['movie_length'] ) ? $_POST['movie_length'] : '';
        $movie_trailer_link = !empty( $_POST['movie_trailer_link'] ) ? $_POST['movie_trailer_link'] : '';
        // Save data
        update_post_meta( $post_id, '_movie_release_year', sanitize_text_field( $release_year ) );
        update_post_meta($post_id, '_movie_length', sanitize_text_field($movie_length));
        update_post_meta($post_id, '_movie_trailer_link', esc_url_raw($movie_trailer_link));
    }
}
$Manage_Movies_obj = new Manage_Movies ();
?>