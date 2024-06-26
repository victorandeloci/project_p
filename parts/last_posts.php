<section class="last-posts content">
    <?php
        wp_reset_query();

        $paged = !empty(get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;

        $queryArgs = [
          'post_type' => 'post',
          'posts_per_page' => 10,
          'paged' => $paged,
          'category_name' => !empty($args['category_slug']) ? $args['category_slug'] : null,
          's' => !empty($args['search']) ? $args['search'] : null,
          'tag' => !empty($args['tag']) ? $args['tag'] : null
        ];

        $query = new WP_Query( $queryArgs );

        if ($query->have_posts()) {
            // save temp non podcast post
            if (!in_category('podcast', $query->posts[0]->ID)) {
                $tempPost = $query->posts[0];
                $query->posts[0] = $query->posts[1];
                $query->posts[1] = $tempPost;
            }

            foreach ($query->posts as $i => $post) {
                get_template_part('elements/post_item', null, [
                    'post' => $post,
                    'is_first' => ($i == 0),
                    'show_rating' => true
                ]);
            }
        }
    ?>

    <div id="pagination">
        <?php
            echo paginate_links( array(
            'base'         => str_replace( 9999, '%#%', esc_url( get_pagenum_link( 9999 ) ) ),
            'total'        => $query->max_num_pages,
            'current'      => max( 1, get_query_var( 'paged' ) ),
            'format'       => '?paged=%#%',
            'show_all'     => false,
            'type'         => 'plain',
            'end_size'     => 2,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => sprintf('<span class="pagination-before"></span>'),
            'next_text'    => sprintf('<span class="pagination-next"></span>'),
            'add_args'     => false,
            'add_fragment' => '',
            ) );
        ?>
    </div>
</section>