<?php
	// Main Text
	$loveme_need_copyright = cs_get_option('hide_copyright');
	$loveme_copyright_text = cs_get_option( 'copyright_text' );
	if ( $loveme_copyright_text ) {
		$footer_class = '';
	} else {
		$footer_class = ' has-not-copyright text-center';
	}
?>
<div class="wpo-lower-footer <?php echo esc_attr( $footer_class ); ?>">
  <div class="container-fluid">
    <div class="row">
      <div class="separator"></div>
      <div class="col col-xs-12">
         <?php
			  if ( $loveme_copyright_text ) {
				  echo '<p class="copyright" >'. wp_kses( do_shortcode( $loveme_copyright_text ) , array( 'div' => array( 'class' => array(), ), 'a' => array('href' => array(),'title' => array()),'p' => array(),'ul' => array(),'li' => array(),) ) .'</p>';
			  } else {
				//   echo '<p>&copy; Copyright '.current_time( 'Y' ).' | <a href="'.esc_url( get_home_url( '/' ) ).'">'.get_bloginfo( 'name' ).'</a> | All right reserved.</p>';
				echo '<p>&copy; Copyright '.current_time('Y').' | <a href="https://amatee24.com">'.esc_html('amatee24').'</a> | All rights reserved. | Proudly developed by <a href="https://inclusionsoft.com/" target="_blank"><img src="https://amatee24.com/wp-content/uploads/2024/04/logo-white.png" alt="" width="80px" height="80px"></a></p>';
			  }
			  $loveme_secondary_text = cs_get_option( 'secondary_text' );
			  echo wp_kses( do_shortcode( $loveme_secondary_text ) , array( 'div' => array( 'class' => array(), ), 'a' => array('href' => array(),'title' => array()),'p' => array(),'ul' => array(),'li' => array(),) );
		  ?>
      </div>
    </div>
  </div>
</div>