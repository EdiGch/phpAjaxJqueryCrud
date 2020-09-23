<?php
require __DIR__.'/../vendor/autoload.php';


use App\Connect;
use App\Tsql;
$tsql = new Tsql();




if(!empty($_POST)){
   
    if(isset($_POST['search']) && !empty($_POST['search'])) {
        $getUserWhere = $tsql->getRowsLike('cars', 'name', $_POST['search'] );

        if(empty($getUserWhere) ){
            die("Brak danych");
        }
        foreach ($getUserWhere as $key ) {
            echo $key['name'] . '<br>';

        }

    }else{
        die('No value sent');
    }
    
    
  
}
