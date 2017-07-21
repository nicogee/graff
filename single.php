<?php get_header(); ?>

    <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <header class="post-header">
          <?php if (has_post_thumbnail()): ?>
            <?php the_post_thumbnail(); ?>
          <?php endif ?>
          <hgroup>
            <h1 class="post-title"><?php the_title() ?></h1>
            <div class="post-meta">
              <p class="info"><?php the_time('F j, Y') ?></p>
              <p class="category">Thoughts on <?php the_category_name() ?></p>
            </div>
          </hgroup>
        </header>
        <hr>
        <article class="post wrap">
          <?php the_content(); ?>
        </article>
        <?php get_template_part('parts/author-box') ?>
        <footer class="post-footer">
          <?php get_template_part('parts/latest-articles') ?>
        </footer>
    <?php endwhile; endif; ?>

<?php get_footer(); ?>