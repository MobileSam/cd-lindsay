<?php /* Template Name: Clinique */

get_header();

$args = array('child_of' => get_the_ID(), 'sort_column' => 'menu_order', 'sort_order' => 'ASC');
$children = get_pages($args);
$index = 0;
?>

<?php foreach ($children as $child): ?>
  <div class="section <?php echo($index % 2 == 0 ? 'white' : ''); ?>">
    <div class="container">
      <h3 class="separator"><?php echo $child->post_title; ?></h3>

      <p><?php echo apply_filters('the_content', $child->post_content); ?></p>

      <?php $index += 1; ?>
    </div>
  </div>
<?php endforeach; ?>

<?php get_footer(); ?>