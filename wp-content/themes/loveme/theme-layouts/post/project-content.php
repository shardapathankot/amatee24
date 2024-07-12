<?php
/**
 * Single Event.
 */
$loveme_large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
$loveme_large_image = $loveme_large_image[0];
$image_alt = get_post_meta( $loveme_large_image, '_wp_attachment_image_alt', true);
$project_options = get_post_meta( get_the_ID(), 'project_options', true );
$project_page_options = get_post_meta( get_the_ID(), 'project_page_options', true );

$loveme_prev_pro = cs_get_option('prev_service');
$loveme_next_pro = cs_get_option('next_servic');
$loveme_prev_pro = ($loveme_prev_pro) ? $loveme_prev_pro : esc_html__('Previous', 'loveme');
$loveme_next_pro = ($loveme_next_pro) ? $loveme_next_pro : esc_html__('Next', 'loveme');
$loveme_prev_post = get_previous_post( '', false);
$loveme_next_post = get_next_post( '', false);

?>        
<div class="content-area">
		<?php the_content(); ?>
</div> 
<div class="pagi">
  <ul>
    <?php if ($loveme_prev_post) { ?>
      <li>
        <a href="<?php echo esc_url(get_permalink($loveme_prev_post->ID)); ?>">
          <i class="fi flaticon-left-arrow"></i>
          <?php echo esc_attr($loveme_prev_pro); ?>
        </a>
      </li>
    <?php } ?>
    <?php if ($loveme_next_post) { ?>
    <li>
      <a href="<?php echo esc_url(get_permalink($loveme_next_post->ID)); ?>">
        <?php echo esc_attr($loveme_next_pro); ?>
         <i class="fi flaticon-right-arrow-1"></i>
      </a>
    </li>
    <?php } ?>
  </ul>
</div>

