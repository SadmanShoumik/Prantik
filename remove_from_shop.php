<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Deleted</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap');
    body{font-family: 'Oswald', 'sans-serif';}
</style>

<body>
    <div align="center">
        <img src="logo.png" alternate="Prantik" height="200px" widht="200px">
    </div>
    <div class="container" align="center">
        <?php
            $pid=$_GET['pid'];
            $sid=$_GET['slogid'];
            $con=mysqli_connect('localhost','root','','prac_pro');
            if($con){
                $q="DELETE FROM product_detail WHERE product_detail.p_id='$pid';";
                $orinfo=mysqli_query($con, $q);
                echo '<h2 style="font-weight: bolder; font-size:50px;" class="text-success" align=center>Delete Successful</h2>';
                echo '<a class="btn btn-success" style="font-size:35px" href="seller.php?slogid='.$sid.'">Seller Homepage</a>';
            }     
        ?>
    </div>
</body>
</html>