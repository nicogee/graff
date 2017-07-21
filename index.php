<?php get_header(); ?>

  	<?php if(have_posts()): while(have_posts()): the_post(); ?>
      <article class="post wrap">
        <h1 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h1>
        <?php the_excerpt('read more…'); ?>
      </article>
    <?php endwhile; endif; ?>

    <div class="pagination">
      <?php posts_nav_link(' &mdash; ', '&laquo; previous page', 'next page &raquo;' ); ?>
    </div>

<?php get_footer(); ?>