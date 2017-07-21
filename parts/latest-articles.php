<div class="latest-articles wrap">
  <ul>
  <?php $next_post = get_next_post();
  if (!empty( $next_post )): ?>
    <li>
      <h3 class="post-title"><a href="<?php echo get_permalink( $next_post->ID ); ?>"><?php echo $next_post->post_title; ?></a></h3>
      <?=mb_substr($next_post->post_content, 0, strpos($next_post->post_content, ' ', 200) ) ?>&hellip; <a href="<?php echo get_permalink( $next_post->ID ); ?>">read more.</a>
    </li>
  <?php endif; ?>

  <?php $prev_post = get_previous_post();
  if (!empty( $prev_post )): ?>
    <li>
      <h3 class="post-title"><a href="<?php echo get_permalink( $prev_post->ID ); ?>"><?php echo $prev_post->post_title; ?></a></h3>
      <?=mb_substr($prev_post->post_content, 0, strpos($prev_post->post_content, ' ', 200) ) ?>&hellip; <a href="<?php echo get_permalink( $prev_post->ID ); ?>">read more.</a>
    </li>
  <?php endif; ?>
  </ul>

</div>