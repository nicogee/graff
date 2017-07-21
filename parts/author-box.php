  <div class="wrap author-info clearfix">
    <hr>
    <div class="author-box">
      <?php  echo get_avatar(get_the_author_meta( 'ID')) ?>
      <div>
        <p>
          <strong>About the author</strong>: <a href="/about-me/"><?php the_author_meta( 'display_name') ?></a>
          <?php the_author_meta( 'user_description') ?>
        </p>
      </div>
    </div>
  </div>