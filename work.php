<?php
/*
Template Name: Work
*/
?>

<?php get_header(); ?>
  
  <div id="work" class="post">

    <?php if(have_posts()): while(have_posts()): the_post(); ?>

      <div class="work-description wrap">
        <h1><?php the_title() ?></h1>
        <?php if(function_exists('the_field')){ the_field('work_description');} ?>
      </div>

      <?php if(function_exists('get_field') && have_rows('works')): ?>
        <?php while(have_rows('works')): the_row(); ?>

          <div class="work-wrap">
            <article class="wrap work-entry">
             
                <?php if (get_sub_field('work_image')): ?>
                  <div class="work-image">
                    <div class="browser-top">
                      <span class="browser-buttons"></span>
                      <span class="browser-address">
                        <?php the_sub_field('work_link_url') ?>
                      </span>
                      <span class="browser-menu">|||</span>
                    </div>
                    <img src="<?php the_sub_field('work_image'); ?>">
                  </div>
                <?php endif ?>
                <div class="work-body">
                  <h2 class="work-title"><?php the_sub_field('work_title') ?></h2>
                  <?php the_sub_field('work_description') ?>
                  <p><a href="<?php the_sub_field('work_link_url') ?>">visit website &raquo;</a></p>
                </div>

            </article>
          </div> <!-- work-wrap -->

        <?php endwhile; ?>
      <?php endif; ?>

    <?php endwhile; endif; ?>

  </div> <!-- wrap -->
<?php get_footer(); ?>