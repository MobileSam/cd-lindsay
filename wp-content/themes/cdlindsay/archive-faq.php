<?php get_header(); ?>

<?php if (have_posts()): ?>
  <div class="section">
    <div class="container">
      <div id="accordion">
        <?php while (have_posts()): ?>
          <?php the_post(); ?>
          <div class="row">
            <div class="col-md-12">
              <a class="btn btn-link faq" data-toggle="collapse" data-target="#faq-<?php the_ID(); ?>"
                 aria-expanded="false"
                 aria-controls="faq-<?php the_ID(); ?>">
                <h4><?php the_title(); ?>   </h4>
              </a>
            </div>

            <div class="offset-md-1 col-md-10">
              <div id="faq-<?php the_ID(); ?>" class="collapse" aria-labelledby="headingOne"
                   data-parent="#accordion">
                <?php the_content(); ?>
              </div>
            </div>
          </div>
        <?php endwhile; ?>

        <?php wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php get_footer(); ?>
