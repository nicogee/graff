<?php
show_admin_bar( false );
add_theme_support('post-thumbnails');

add_action('wp_enqueue_scripts', 'graff_scripts');

function graff_scripts() {
  wp_enqueue_style('graff', get_template_directory_uri() . '/assets/css/style.min.css');
  
  // if(is_single()) {
  //   wp_enqueue_script('graff', get_template_directory_uri() . '/assets/js/single.js', array('jquery'));
  // }
}

//add_action( 'init', 'create_post_type' );

function create_post_type() {
  register_post_type( 'work',
    array(
      'labels' => array(
        'name' => __( 'Work' ),
        'singular_name' => __( 'Work' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_icon' => 'dashicons-welcome-widgets-menus',
      'supports' => ['title', 'editor', 'excerpt', 'thumbnail']
    )
  );
}


function register_my_menu() {
  register_nav_menu('primary', __( 'Main Menu' ));
}
add_action( 'init', 'register_my_menu' );

function get_latest_articles() {
  global $post;
  
  $articles = get_posts([
    'exclude' => $post->ID,
    'posts_per_page' => 3
  ]);

  return $articles;
}

function new_excerpt_more($more) {
  global $post;
  return '&hellip; <a class="more-link" href="'. get_permalink($post->ID) . '">read more.</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

function the_category_name() {
  $category = get_the_category(); 
  echo $category[0]->cat_name;
}

function the_category_list() {
  $cats = get_categories();
  $cats_list;

  foreach($cats as $cat) {
    $cats_list .= '<a href="' . get_category_link( $cat->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $cat->name ) . '" ' . '>' . $cat->name.'</a>, ';
  }

  echo rtrim($cats_list, ', ');
}

//taken from https://code.tutsplus.com/articles/creating-a-simple-contact-form-for-simple-needs--wp-27893
function graff_contact_form( $atts ) {
 
    extract( shortcode_atts( array(
        "email" => 'hello@graff.cc',
        "subject" => "Kontaktanfrage",
        "label_name" => "Name",
        "label_email" => "E-Mail",
        "label_subject" => "Kontaktanfrage",
        "label_message" => "Message",
        "label_submit" => "Send",
        "error_empty" => "Your message could not be send. Please fill out all required fields.",
        "error_noemail" => "Please give a valid e-mail address.",
        "success" => "Thank you for your message. I will read your message and answer you.",
        "error_nonce" => "An error occurred, please try again.",
        "info" => ""
    ), $atts ) );

    $form_data = array( "your_name", "your_email", "your_message");

    if ( !empty($_POST['send']) ) {

        $error = false;
        $honeypot = false;

        $required_fields = array( "your_name", "your_email", "your_message");

        if ( isset( $_POST['send_me_a_message'] ) && wp_verify_nonce( $_POST['send_me_a_message'], 'do_send_me_a_message' ) ) {
        

         foreach ( $_POST as $field => $value ) {
           
            if($field == 'your_email') {
              $value = sanitize_email($value);
            }

            else if($field == 'your_firstname' && !empty($value) ) {
              $value = sanitize_email($value);
              $error = true;
              $honeypot = true;
              $result = $success;
            }

            else {
              $value = sanitize_text_field($value);
            }

            $form_data[$field] = $value;
        }
        
        
        
        foreach ( $required_fields as $required_field ) {

            $value = trim( $form_data[$required_field] );

            if ( empty( $value ) ) {
                $error = true;
                $result = $error_empty;
            }
        }

        if ( !is_email( $form_data['your_email'] ) ) {

            $error = true;
            $result = $error_noemail;
        }

        
     
        if ( $error == false ) {

            $email_subject = "[" . get_bloginfo( 'name' ) . "] " . $subject;
            $email_message = $form_data['your_message'] . "\n";
            $headers  = "From: " . $form_data['your_name'] . " <" . $form_data['your_email'] . ">\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\n";
            $headers .= "Content-Transfer-Encoding: 8bit\n";
            wp_mail( $email, $email_subject, $email_message, $headers );
            $result = $success;
            $sent = true;
        }


          
      } else {

        $result = $error_nonce;

      } //end nonce
       
    } // end post


    // anyways, let's build the form! (remember that we're using shortcode attributes as variables with their names)
    $email_form = '<form class="contact-form" method="post" action="' . get_permalink() . '#top-anchor">
        ' . wp_nonce_field( 'do_send_me_a_message', 'send_me_a_message', true, false) . '
        <div class="cf_firstname">
            <label for="cf_firstname">Vorname <sup>*</sup></label>
            <input type="text" name="your_firstname" id="cf_firstname" maxlength="50" value=""/>
        </div>
        <div>
            <label for="cf_name">' . $label_name . ' <sup>*</sup></label>
            <input type="text" name="your_name" id="cf_name" maxlength="50" value="' . $form_data['your_name'] . '"  required />
        </div>
        <div>
          <label for="cf_email">' . $label_email . ' <sup>*</sup></label>
          <input type="email" name="your_email" id="cf_email" maxlength="50" value="' . $form_data['your_email'] . '"  required />
        </div>
        <div>
            <label for="cf_message">' . $label_message . ' <sup>*</sup></label>
            <textarea name="your_message" id="cf_message" required >' . $form_data['your_message'] . '</textarea>
        </div>
        <div>
          <sup>*</sup> required
        </div>
        <div>
            <button type="submit" value="send" name="send" id="cf_send">' . $label_submit . '</button>
        </div>
    </form>';

    if ( $result != "" ) {
        $info = '<div id="cf_info">' . $result . '</div>';
    }

    if ( $sent == true ) {
        $info = '<div id="cf_info" class="send_success">' . $result . '</div>';
        return $info;

    } else if($honeypot == true) { 

      return $info;

    } else {
        return $info . $email_form;
    }

}

add_shortcode( 'graffcontact', 'graff_contact_form' );


?>