<?php
/**
 * Single Post.
 */
$loveme_large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
$loveme_large_image = $loveme_large_image ? $loveme_large_image[0] : '';
$image_alt = get_post_meta( $loveme_large_image, '_wp_attachment_image_alt', true);
$loveme_post_type = get_post_meta( get_the_ID(), 'post_type_metabox', true );
// Single Theme Option
$loveme_post_pagination_option = cs_get_option('single_post_pagination');
$loveme_single_featured_image = cs_get_option('single_featured_image');
$loveme_single_author_info = cs_get_option('single_author_info');
$loveme_single_share_option = cs_get_option('single_share_option');
$loveme_metas_hide = (array) cs_get_option( 'theme_metas_hide' );
?>
  <div <?php post_class('post clearfix'); ?>>
  	<?php if ( $loveme_large_image && $loveme_single_featured_image) { ?>
  	  <div class="entry-media">
        <img src="<?php echo esc_url( $loveme_large_image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
   		</div>
  	<?php	} ?>
    <div class="entry-meta">
      <ul>
        <li>
           <?php if ( !in_array( 'author', $loveme_metas_hide ) ) { // Author Hide
              printf(
              '<span><i class="fi flaticon-user author"></i>'.esc_html__(' By: ','loveme').'<a href="%1$s" rel="author">%2$s</a></span>',
              esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author()
              );
          } ?>
        </li>
        <li>
        <i class="fi flaticon-comment-white-oval-bubble"></i>
           <a class="loveme-comment" href="<?php echo esc_url( get_comments_link() ); ?>">
            <?php printf( esc_html( _nx( 'Comments (%1$s)', 'Comments (%1$s)', get_comments_number(), 'comments title', 'loveme' ) ), '<span class="comment">'.number_format_i18n( get_comments_number() ).'</span>','<span>' . get_the_title() . '</span>' ); ?>
          </a>
        </li>
        <li><i class="fi flaticon-calendar"></i>
          <a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_date() );  ?></a>
        </li>
      </ul>
    </div>
    <div class="entry-details">
	     <?php
				the_content();
				echo loveme_wp_link_pages();
			 ?>
    </div>
</div>
  <?php if( has_tag() || ( $loveme_single_share_option && function_exists('loveme_wp_share_option') ) ) { ?>
  <div class="tag-share-wrap">
    <div class="tag-share clearfix">
    <?php if( has_tag() ) { ?>
       <div class="tag">
            <?php
              echo '<span>'.esc_html__('Tags:','loveme').'</span>';
              $tag_list = get_the_tags();
              if($tag_list) {
                echo the_tags( ' <ul><li>', '</li><li>', '</li></ul>' );
             } ?>
        </div>
  </div>
  <div class="tag-share-s2 clearfix">
      <?php } 
      if ( $loveme_single_share_option && function_exists('loveme_wp_share_option') ) {
            echo loveme_wp_share_option();
        }
     ?>
  </div>
</div>
<?php
}
if( !$loveme_single_author_info ) {
	loveme_author_info();
	}
?>

