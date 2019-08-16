<?php

namespace App\Controllers;

class IndexController{

    public function IndexAction(){

        //echo('Bien conectado');
        
        include('../views/header.php');
        include('../views/index.php');
        include('../views/footer.php');

    }

}