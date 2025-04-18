<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package huasdogs
 */

get_header();
?>

<main id="primary" class="site-main">
  <section id="hero">
    <div class="container-fluid hero">
      <div class="left">
        <h1>Front Page</h1>
      </div>
      <div class="right">
        <h1>Front Page</h1>
      </div>
    </div>
  </section>
  <section id="benefits">
    <div class="container benefits">
      <div class="left">
        <h1>Benefits Page</h1>
      </div>
      <div class="right">
        <h1>Benefits Page</h1>
      </div>
    </div>
    <div class="container benefits">
      <div class="left">
        <h1>Benefits Page</h1>
      </div>
      <div class="right">
        <h1>Benefits Page</h1>
      </div>
    </div>
    <div class="container benefits">
      <div class="left">
        <h1>Benefits Page</h1>
      </div>
      <div class="right">
        <h1>Benefits Page</h1>
      </div>
    </div>
  </section>
  <section>
    <div class="container">
      <?php
      while (have_posts()) :
        the_post();

        get_template_part('template-parts/content', 'page');

        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || get_comments_number()) :
          comments_template();
        endif;

      endwhile; // End of the loop.
      ?>
    </div>
  </section>

</main><!-- #main -->

<?php
get_sidebar();
get_footer();
