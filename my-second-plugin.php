<?php 
// commentaires d’en-tête » avec diverses informations qui seront lues/affichées par WordPress

/*
Plugin Name: Mon deuxième plugin
Description: C'est mon deuxième plugin 
Author: Ibtissem
Version: 0.1
*/

//Inclu mfp-functions.php avec le chemin du répertoire,  require_once pour arrêter le script si mfp-functions.php n'est pas trouvé
//require_once plugin_dir_path(__FILE__) . 'includes/mfp-functions.php';
//require_once plugin_dir_path(__FILE__) . 'includes/mfp-sec-acp-page.php';

/**
 * Create the date options fields for exporting a given post type.
 *
 * @global wpdb      $wpdb      WordPress database abstraction object.
 * @global WP_Locale $wp_locale WordPress date and time locale object.
 *
 * @since 3.1.0
 *
 * @param string $post_type The post type. Default 'post'.
 */

// $dupe = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_post_ID = %d AND comment_author_url = %s", $comment_post_ID, $comment_author_url ) );

function afficher() {
    global $wpdb;
    $categorie=get_the_category();
    //$resultat = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpdb->mfp_input  ") );
    the_category();
    the_ID();

    echo "<pre>",print_r( $categorie) ,"</pre><br>";
    $category_id=$categorie[0]->term_id;

    print_r($categorie[0]->cat_name) ;

     $formulaire = $wpdb->get_results( $wpdb->prepare( "SELECT nom_champ,type_input FROM wp_mfp_champ INNER JOIN wp_mfp_liaison ON wp_mfp_champ.Id_champ=wp_mfp_liaison.champ_id INNER JOIN wp_mfp_input ON wp_mfp_liaison.input_id=wp_mfp_input.id WHERE wp_mfp_liaison.category_id=$category_id" ) );
    
     echo "<pre>",print_r( $formulaire) ,"</pre><br>"; ?>

<form action="" method="post">
<?php
     foreach ($formulaire as $elements) { 
    // print_r($elements);
         
         ?>

 <label for="<?=$elements->nom_champ?>"><?=$elements->nom_champ?> :</label>
 <input type="<?=$elements->type_input?>" name="<?=$elements->nom_champ?>" id="">


     <?php }

     ?>


<button type="submit">Envoyer</button>
   
</form>

<?php }

add_action('get_footer','afficher' );




?>