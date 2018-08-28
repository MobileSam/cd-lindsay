<?php
get_header();

$video = get_field('video');
?>

<?php if (have_posts()): ?>
  <div class="section">
    <div class="container">
      <?php while (have_posts()): ?>
        <?php the_post(); ?>

        <?php if ($video != ''): ?>
          <script type="text/javascript">

            document.write(insertClipVzaar('<?php echo $video ?>', rootFr, '612', '344', 'false', 's', ''));

          </script>
        <?php endif; ?>

        <?php get_template_part('content-single', get_post_format()); ?>
      <?php endwhile; ?>
    </div>
  </div>
<?php endif; ?>

<?php get_footer(); ?>