<!DOCTYPE html>
<html>
    <head>
        <title>Logiciel de gestion</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/framework/Projet/layout/style.css" type="text/css" media="screen">
        <?php echo ($this->getAjax()) ? '<script type="text/javascript" src="../utils/inlineMod.js"></script>' : '';?>
         <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>-->
         <script type="text/javascript" src="/framework/utils/jquery-1.9.1.js"></script>
         <script type="text/javascript">
         $(document).ready(function(){
             $('body').prepend('<div class="top_link"><a href="#top"  title="Revenir en haut de page"><img src="../images/flecheretour.png"></a></div>');
                 $('.top_link').css({  
                        'position'              :   'fixed',  
                        'right'                 :   '0px',  
                        'bottom'                :   '10px',  
                        'display'               :   'none',  
                        'padding'               :   '5px',
                        '-moz-border-radius'    :   '40px',  
                        '-webkit-border-radius' :   '40px',  
                        'border-radius'         :   '40px',  
                        'opacity'               :   '0.7',  
                        'z-index'               :   '2000'
                    });  
        $(window).scroll(function(){  
            posScroll = $(document).scrollTop();  
            if(posScroll >=350)  
                $('.top_link').fadeIn(600);  
            else  
                $('.top_link').fadeOut(400);  
        });  
    });
    function test(){
        
    }
     
 </script>
    </head>
    <body>
        
        <?php   
            if (isset($_SESSION['access']) && $_SESSION['access'] == true){
                echo '<div id="fond_menu"><div id="menu"><ul>';
                  echo '<li><a href="'._LIENDIR_.'accueil">Accueil</a></li>';
                  echo '<li><a href="'._LIENDIR_.'gestionClient">Gestion des clients</a></li>';
                  echo '<li><a href="'._LIENDIR_.'facturation">Facturation</a></li>';
                  echo '<li><a href="'._LIENDIR_.'gestionStock">Gestion du stock</a></li>';
                  echo '<li><a id="boutonDeconnex" href="'._LIENDIR_.'deconnex">Déconnexion</a></li>';
                  echo '</ul></div></div>';
                  if (!(isset($this->erreur) and $this->getMenu() != false)){
                      echo $this->getMenu();
                  }
              }
          
                    ?>
   
