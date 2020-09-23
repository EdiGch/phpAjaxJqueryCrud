<?php
require __DIR__.'/../vendor/autoload.php';


use App\Connect;
use App\Tsql;

$tsql = new Tsql();




if(!empty($_POST)){
    
        $data = $tsql->selectAll('cars');

         if(empty($data) ){
            die("Brak danych");
        }
        $html = '';
        foreach ($data as $key ) {
                $html .= "
                <tr>
                    <th scope='row'>" . $key['id'] ."</th>
                    <td><a rel='".$key['id']."' class='titleLink' href='javascript:void(0)'>". $key['name'] ."</a></td>
                </tr>
                ";

        }

        echo $html;
  
}

;?>

<script>

    $("#actionEditDelete").hide();
    $(".titleLink").on('click', function(){
        $("#actionEditDelete").show();
        var id = $(this).attr("rel");
        $.post("bdProcess.php", {id: id},
                function(data){
                        $("#actionEditDelete").html(data);
                }
        );
        
    });

</script>