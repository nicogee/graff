<?php 
  /*
  Template Name: Start
  */
?>

<?php get_header(); ?>

    <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <article class="post wrap">
          <header class="header-start clearfix">
            <h1 class="post-title"><span class="and">}</span>nicolas graff <br><span class="highlight">webdeveloper</span> bootstrapper traveler</h1>
          </header><!-- /header -->
          <?php the_content(); ?>
        </article>
    <?php endwhile; endif; ?>
    
<?php get_footer(); ?>