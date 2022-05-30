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


// $dupe = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_post_ID = %d AND comment_author_url = %s", $comment_post_ID, $comment_author_url ) );

function afficher() {
    global $wpdb;
    $categorie=get_the_category();//Récupérer toutes les infos de la catégorie
    //$resultat = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM $wpdb->mfp_input  ") );
//     the_category();
//     the_ID();

 echo "<pre>",print_r( $categorie) ,"</pre><br>";

    $category_id=$categorie[0]->term_id;

    print_r($categorie[0]->cat_name) ;

     $formulaire = $wpdb->get_results( $wpdb->prepare( "SELECT nom_champ,type_input FROM wp_mfp_champ INNER JOIN wp_mfp_liaison ON wp_mfp_champ.Id_champ=wp_mfp_liaison.champ_id INNER JOIN wp_mfp_input ON wp_mfp_liaison.input_id=wp_mfp_input.id WHERE wp_mfp_liaison.category_id=$category_id" ) );

      $options = $wpdb->get_results($wpdb->prepare( "SELECT option_select FROM wp_mfp_options" ));
    
     echo "<pre> Options : ",print_r( $options) ,"</pre><br>"; ?>

<form action="" method="post">
<?php
     foreach ($formulaire as $elements) { 
    // print_r($elements);
         
         ?>

 <label for="<?=$elements->nom_champ?>"><?=$elements->nom_champ?> :</label>

     <?php
     if ($elements->type_input=='select') { ?>
          
                <select name="<?=$elements->nom_champ?>" >
                   <?php  foreach ($options as $option) {  ?>

                    <option value="<?=$option->option_select?>"><?=$option->option_select?></option>

                  <?php }?>

                </select>

   <?php } else { ?>

     <input type="<?=$elements->type_input?>" name="<?=$elements->nom_champ?>" id="">


  <?php }
     
}

     ?>


<button type="submit">Envoyer</button>
   
</form>

<?php 

print_r($_POST);

// $keys=[];
//       $champs=[];
//       $values=[];
      
//     foreach ($_POST as $key => $value) {
     
//       $keys[] = $key;
//       $champs[] = '?';
//       $values[] = $value;
 
      
//   }
//   $keys[]= 'category_id';
//   $champs[] = '?';
//   $values[] = $category_id;

//   echo "<pre> Options : ",print_r($keys) ,"</pre><br>"; 
//   echo "<pre> Options : ",print_r( $champs) ,"</pre><br>"; 


//     $keys = implode(",", $keys);
//     $champs = implode(",", $champs);
//     $sth = $wpdb->prepare("INSERT INTO wp_donnees_form ($keys) VALUES ($champs)");
//    // echo "<pre> Options : ",print_r( $sth) ,"</pre><br>"; 
//    echo "<pre> Options : ",print_r( $values) ,"</pre><br>"; 
//     $sth->execute($values);
//     //echo "<pre> Options : ",print_r( $sth) ,"</pre><br>"; 


$wpdb->insert('wp_donnees_form', 
array(
          'Age'   => $_POST['Age'],
          'Nom'        => $_POST['Nom'],
          'Ville' => $_POST['Ville'],
          'Mail'=> $_POST['Mail'],
          'Telephone'=> $_POST['Telephone'],
          'category_id' => $category_id,
     ),array('%d', '%s', '%s','%s','%s','%d')
);

}

add_action('get_footer','afficher' );
//echo 'salut';



?>