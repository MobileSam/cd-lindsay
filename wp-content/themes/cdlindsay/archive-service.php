<?php

get_header();

$index = 0;
?>

<?php if (have_posts()): ?>
    <?php while (have_posts()): ?>
        <?php the_post(); ?>

        <?php if ($index % 2 == 0): ?>
            <div class="section  <?php echo ($index % 4 == 0 ? 'white' : ''); ?>">
                <div class="container">
                    <div class="row">
        <?php endif; ?>

        <div class="col-md-6 service-item">
            <h3 class="separator"><?php the_title(); ?></h3>

            <?php the_excerpt(); ?>

            <a class="btn btn-outline-primary" href="<?php the_permalink(); ?>">Plus de détails</a>
        </div>

        <?php $index += 1; ?>

        <?php if ($index % 2 == 0): ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endwhile; ?>

    <?php if ($index % 2 != 0): ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>
<?php endif; ?>

<?php get_footer(); ?>