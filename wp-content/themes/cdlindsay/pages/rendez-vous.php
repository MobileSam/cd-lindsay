<?php /* Template Name: Rendez-vous */

get_header();

$success = false;

if (isset($_POST['courriel'])) {
  $to = $_POST['dentist'];
  $service = $_POST['service'];
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

  $subject = 'Demande de rendez-vous pour ' . $name;
  $message .= '<br />Service: ' . $service;
  $message .= '<br />Email: ' . $email;
  $message .= '<br />Téléphone (domicile): ' . $homePhone;
  $message .= '<br />Téléphone (travail): ' . $workPhone;

  $success = wp_mail($to, $subject, $message);
}
?>

  <div class="section white with-side">
    <div class="container">
      <?php if (have_posts()): ?>
        <?php while (have_posts()): ?>
          <?php the_post(); ?>

          <div class="row">
            <div class="col-lg-6">
              <?php the_content(); ?>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>

      <br/><br/>

      <h3 class="separator">Par téléphone</h3>
      <h2><i class="fas fa-mobile-alt"></i> <a href="tel:(819) 477 2020">(819) 477 2020</a></h2>

      <?php if ($success): ?>
        <h4>Message bien reçu. <strong>Merci</strong></h4>
      <?php else: ?>
        <h3 class="separator">Par courriel</h3>

        <form action="<?php the_permalink() ?>" method="post">
          <div class="row">
            <div class="col-md-6 col-lg-3">
              <div class="form-group">
                <label for="dentist">Dentiste</label>
                <select id="dentist" name="dentist" class="form-control form-control-sm">
                  <option value="">Je n'ai pas de dentiste</option>

                  <?php
                  $args = array('post_type' => 'dentist', 'orderby' => 'menu_order', 'order' => 'ASC');
                  $query = new WP_Query($args);
                  ?>

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

            <div class="col-md-6 col-lg-3">
              <div class="form-group">
                <label for="service">Service</label>
                <select id="service" name="service" class="form-control form-control-sm">
                  <option value="">- Faites votre choix -</option>
                  <option value="Nettoyage/examen annuel">Nettoyage/examen annuel</option>
                  <option value="Nettoyage/examen nouveau patient">Nettoyage/examen nouveau patient*</option>
                  <option value="Examen seulement">Examen seulement</option>
                  <option value="Urgence">Urgence</option>
                  <option value="Obturation tombée/dent cassée">Obturation tombée/dent cassée</option>
                  <option value="Consultation">Consultation</option>
                  <option value="Autre">Autre</option>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 col-lg-3">
              <div class="form-group">
                <label for="nom">Nom</label>
                <input id="nom" name="nom" class="form-control form-control-sm" required/>
              </div>
            </div>
            <div class="col-md-6 col-lg-3">
              <div class="form-group">
                <label for="courriel">Courriel</label>
                <input id="courriel" name="courriel" class="form-control form-control-sm"/>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 col-lg-3">
              <div class="form-group">
                <label for="home-phone">Tél<span class="d-none d-sm-inline">éphone</span> (domicile)</label>
                <input id="home-phone" name="home-phone" class="form-control form-control-sm"/>
              </div>
            </div>

            <div class="col-md-6 col-lg-3">
              <div class="form-group">
                <label for="work-phone">Tél<span class="d-none d-sm-inline">éphone</span> (travail)</label>
                <input id="work-phone" name="work-phone" class="form-control form-control-sm"/>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-6">
              <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" class="form-control form-control-sm"></textarea>
              </div>

              <div class="text-right">
                <button class="btn btn-outline-primary">Envoyer</button>
              </div>
            </div>
          </div>
        </form>


        <div class="row new-patient d-none">
          <div class="col-lg-6">
            <br/>
            <p>*Si c'est votre première visite au Centre dentaire Lindsay, vous devrez répondre au formulaire santé.
              Vous pouvez remplir une version en-ligne et apporter une version imprimée lors de votre rendez-vous.</p>
            <a href="<?php bloginfo('template_url'); ?>/forms/sante.pdf" target="_blank"
               class="btn btn-outline-primary">Formulaire santé</a>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <div class="side d-none d-lg-block">
      <img src="<?php bloginfo('template_url'); ?>/img/rendez-vous.jpg" alt="<?php echo get_bloginfo('name'); ?>"/>
    </div>
  </div>

<?php get_footer(); ?>