<?php 
require __DIR__.'/../vendor/autoload.php';
;?>
 
 <!DOCTYPE html>
 <html lang="en">
 <head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <!-- <link rel="stylesheet" href="style.css"> -->
 <title>Title</title>
 </head>
 <body>

<section>
<div class="container">
    <div class="row">
        <div id="container" class="col-md-12 text-center">
            <H1>What are you looking for</H1>
            <input class="form-control" type="text" name="search" id="search" placeholder="Enter what you are looking for">
            <br>
            <br>
            <h2 class="bg-success" id="result"></h2>
        </div>
    </div> <!-- END ROW -->

    <div class="row">
        <div id="Form" class="col-md-6 text-center">
            <H1>Add the car to the database</H1>

            <form id="addCarForm" method="POST" action="bdAddCars.php">
                <div class="form-group">
                    <input class="form-control" type="text" name="carName" id="carName" placeholder="Enter the Car Brand">
                    <br>
                    <input type="submit" id="addMark" class="btn btn-primary" value="Add Brand">
                </div>
            </form>
            <br>
            <div class="bg-success" id="carResult"></div>

        </div>
    </div> <!-- END ROW -->


    <div class="row">
        <div  class="col-md-6 col-xs-offset-3 text-center">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#id</th>
                    <th scope="col">Name</th>
                    </tr>
                </thead>
                <tbody id="showCars">
                    <tr>
                    
                    </tr>
                </tbody>
            </table>
        </div> <!-- END col-md-6 col-xs-offset-3 text-center -->

        <div class="col-md-6" id="actionEditDelete">

            
        
        </div> <!-- END col-md-6 -->

    </div> <!-- END ROW -->


</div>
</section>



 <script>
 $(document).ready(function () {

    updateCars();
    
    $('#search').keyup(function(){
        var search = $('#search').val();
        var test;

        $.ajax({
            type: "POST",
            url: "bdGetSearchCars.php",
            data: {
                search:search
            },
            success: function (data) {
                $('#result').html(data);
            }

        });
    }) //END $('#search').keyup(function()


    $('#addCarForm').submit(function(evt) {
        evt.preventDefault();

        var postData = $(this).serialize();
        var url = $(this).attr('action');

        $.post(url , postData,
            function (php_table_data) {
                $('#carResult').html(php_table_data);
                $("#addCarForm")[0].reset();
            },
        );

    }); // END $('#addCarForm').submit(function(evt)

    // Refres data in table
    $("#addMark").on('click', function(){
        setInterval(function(){
               updateCars();
        }, 1000);
    }); // END Refres data in table 

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

    $("#actionEditDelete").hide();







 }); //END $(document).ready
 </script>
 
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
 </body>
 </html>