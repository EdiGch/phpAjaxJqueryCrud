<?php
require __DIR__.'/../vendor/autoload.php';
use App\Connect;
use App\Tsql;
$tsql = new Tsql();



if(!empty($_POST)){
    
    $searchValue = isset($_POST['carName']) && !empty($_POST['carName']) ?  $_POST['carName'] : die('No value sent');
    $query = $tsql->setData('cars',  $_POST['carName']);

    echo 'The data has been saved correctly';

  
}
