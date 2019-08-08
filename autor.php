<?php 
function protect_page(){
        if (logged_in() === false ) {
            echo "Вы не залогинены, Вам сюда нельзя";
        }

    }
    function logged_in(){
        return(isset($_SESSION['user_id'])) ? true : false;
    }
 ?>