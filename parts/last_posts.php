<section class="last-posts content">
    <?php
        wp_reset_query();

        $paged = !empty(get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;

        $queryArgs = [
          'post_type' => 'post',
          'posts_per_page' => 10,
          'paged' => $paged
        ];

        $query = new WP_Query( $queryArgs );

        if ($query->have_posts()) :
            $i = 0;
            while ($query->have_posts()) :

                $query->the_post();
                get_template_part('elements/post_item', null, [
                    'is_first' => ($i == 0)
                ]);

                $i++;
            endwhile;
        endif;
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