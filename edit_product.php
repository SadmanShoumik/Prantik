<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap');
    body{font-family: 'Oswald', 'sans-serif';}
</style>

<body>
    <div align="center">
        <a href="seller.php?slogid=<?php $ssid=$_GET['slogid']; echo $ssid; ?>"> <img src="logo.png" alternate="KineFelun" height="200px" widht="200px"> </a>
    </div>
    <div class="container" align="center">
        <h1 class="text-warning fs-1 text-center border border-bottom shadow p-3 m-3" style="font-weight:bolder;">Update Product Information :</h1>
        <form action="edit_product.php?p_id=<?php $pid=$_GET['p_id']; echo $pid; ?>" style="height: auto; width: 700px;" method="POST" class='form-control bg-transparent'>
            <h4 align="left" style="font-weight: bolder; font-size: 24px; ">Product Name:</h4>
            <input type="text" class='form-control'placeholder='Product Name' style="font-size: 22px;" name='nm'>
            <h4 align="left" style="font-weight: bolder; font-size: 24px; ">Product Type:</h4>
            <input type='text' class='form-control' placeholder='Product Type' style="font-size: 22px;" name='tp'>
            <h4 align="left" style="font-weight: bolder; font-size: 24px; ">Seller ID:</h4>
            <input type='text' class='form-control' placeholder='Seller ID' style="font-size: 22px;" name='sid'>
            <h4 align="left" style="font-weight: bolder; font-size: 24px; ">Pieces Available:</h4>
            <input type='text' class='form-control'placeholder='Pieces Available' style="font-size: 22px;" name='avl'>
            <h4 align="left" style="font-weight: bolder; font-size: 24px; ">Price per Unit:</h4>
            <input type='text' class='form-control mb-3' placeholder='Price' style="font-size: 22px;" name='ppu'>
            <input type="submit" class='form-control btn-primary' value='Submit' style="font-size: 24px;" name='sub'>
        </form>
        <?php
            if(isset($_POST['sub'])){
                $pid=$_GET['p_id'];
                $nm=$_POST['nm'];
                $tp=$_POST['tp'];
                $sid=$_POST['sid'];
                $avl=$_POST['avl'];
                $ppu=$_POST['ppu'];
                $con=mysqli_connect('localhost','root','','prac_pro');
                $q='SELECT * FROM product_detail';
                if($con){
                    $res=mysqli_query($con,$q);
                    while($row=mysqli_fetch_row($res)){
                        if($row[0]==$pid){
                            $q="UPDATE product_detail SET p_name='$nm', p_type='$tp', s_id='$sid', avl='$avl', ppu='$ppu' WHERE product_detail.p_id='$pid';";
                            $result = mysqli_query($con,$q);
                            echo '<h2 style="font-weight: bolder; font-size:50px;" class="text-success" align=center>Update successful</h2>';
                            echo '<a class="btn btn-success" style="font-size:35px" href="seller.php?slogid='.$sid.'">Seller Homepage</a>';
                            break;
                        }
                    } 
                }     
            }
        ?>
    </div>
</body>
</html>