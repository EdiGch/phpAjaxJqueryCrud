<?php
require __DIR__.'/../vendor/autoload.php';


use App\Connect;
use App\Tsql;
$tsql = new Tsql();




if(isset($_POST['id'])){

        $data = $tsql->queryBuiltParameters([
            'TableName' => 'cars',
            'WhereColumn' => 'id',
            'WhereValue' => $_POST['id'],
        ]);

        $html = '';
        foreach ($data as $key ) {

                $html .= "
                    <input rel='".$key['id']."' type='text' class='form-control nameInput' value='".$key['name']."'>
                    <input type='button' class='btn btn-success updateInput' value='update'>
                    <input type='button' class='btn btn-danger car_id' value='delete'>
                ";

        }

        echo $html;

}
elseif(isset($_POST['updateThis']) ) {


    
    
    $id = $_POST['idThis'];
    $name = $_POST['name'];

    $data = $tsql->update([
        'tableName' => 'cars',
        'columName' => 'name',
        'updateValue' => $name,
        'updateIdValue' => $id,
    ]);

       





}
else{
     die("No data");
}





;?>

<script>
 $(document).ready(function () {
    var id;
    var name ;
    var updateThis = "update";
    var deleteThis = "delete";


    function setParams() {
        id = $('.nameInput').attr('rel');
        name = $('.nameInput').val();
    }



    $(".updateInput").on('click', function(){
        setParams();
        $.post("bdProcess.php", {idThis: id, name: name, updateThis: updateThis}, function(data){})
        updateCars();
    })

        function updateCars(){
        $.ajax({
            type: "POST",
            url: "bdGetTableCars.php",
            data: "data",
            success: function (data) {
                $('#showCars').html(data);
            }
        }); 
    } // END Data Add to Table  

 }); //END $(document).ready
</script>
