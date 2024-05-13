

            <h3><?php esc_html_e('All Blog Posts','citygov');?>:</h3>

            <ul><?php $archive_query = new WP_Query('showposts=1000');
while ($archive_query->have_posts()) : $archive_query->the_post(); ?>
                <li>
                    <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?>

                    </a>
                </li>

                <?php endwhile; ?>
            </ul>

            <div class="hrlineB"></div>