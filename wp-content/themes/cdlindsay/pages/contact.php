<?php /* Template Name: Contact */

get_header();

$success = false;

if (isset($_POST['courriel'])) {
  $to = $_POST['dentist'];
  $name = $_POST['nom'];
  $email = $_POST['courriel'];
  $homePhone = $_POST['home-phone'];
  $workPhone = $_POST['work-phone'];
  $message = $_POST['message'];

  if (!$to) {
    $to = 'info@cdlindsay.com';
  }

  if (ENVIRONMENT != 'production') {
    $to = 'samuel.dionne@dinoz.mobi';
  }

  $subject = 'Message de ' . $name;
  $message .= '<br />Email: ' . $email;
  $message .= '<br />Téléphone (domicile): ' . $homePhone;
  $message .= '<br />Téléphone (travail): ' . $workPhone;

  $success = wp_mail($to, $subject, $message);
}

$args = array('post_type' => 'dentist', 'orderby' => 'menu_order', 'order' => 'ASC');
$query = new WP_Query($args);

?>

  <div class="section with-side">
    <div class="container">
      <h3 class="separator">Par téléphone</h3>
      <h2><i class="fas fa-mobile-alt"></i> <a href="tel:(819) 477 2020">(819) 477 2020</a></h2>

      <?php if ($success): ?>
        <h4>Message bien reçu. <strong>Merci</strong></h4>
      <?php else: ?>
        <h3 class="separator">Par courriel</h3>

        <form action="<?php the_permalink() ?>" method="post">
          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <select id="dentist" name="dentist" class="form-control">
                  <option value="">- Choisir un dentiste -</option>

                  <?php if ($query->have_posts()): ?>
                    <?php while ($query->have_posts()): ?>
                      <?php $query->the_post(); ?>
                      <option value="<?php the_field('email_contact'); ?>"><?php the_title(); ?></option>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                  <?php endif; ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 col-lg-3">
              <div class="form-group">
                <label for="nom">Nom</label>
                <input id="nom" name="nom" class="form-control" required/>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="form-group">
                <label for="courriel">Courriel</label>
                <input id="courriel" name="courriel" class="form-control"/>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 col-lg-3">
              <div class="form-group">
                <label for="home-phone">Téléphone (domicile)</label>
                <input id="home-phone" name="home-phone" class="form-control"/>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="form-group">
                <label for="work-phone">Téléphone (travail)</label>
                <input id="work-phone" name="work-phone" class="form-control"/>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" class="form-control"></textarea>
              </div>

              <div class="text-right">
                <button class="btn btn-outline-primary">Envoyer</button>
              </div>
            </div>
          </div>

        </form>
      <?php endif; ?>
    </div>

    <div class="side d-none d-lg-block">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2777.3383421730755!2d-72.49120352702043!3d45.884545822438184!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cc81164e19b9045%3A0xf6d44982b1811b29!2sCentre+Dentaire+Lindsay+Inc!5e0!3m2!1sen!2sca!4v1522616114185"
              width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
  </div>

  <div class="contacts section white">
    <div class="container">
      <h3 class="separator">Dentistes</h3>

      <?php if ($query->have_posts()): ?>
        <div class="row">
          <?php while ($query->have_posts()): ?>
            <?php $query->the_post(); ?>
            <?php get_template_part('content/contact-dentist'); ?>
          <?php endwhile; ?>
        </div>

        <?php wp_reset_postdata(); ?>
      <?php endif; ?>
    </div>
  </div>

<?php get_footer(); ?>