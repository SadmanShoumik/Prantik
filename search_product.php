<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap');
    body{font-family: 'Oswald', 'sans-serif';}
</style>

<body>
    <div align="center">
        <a href="buyer.php?slogid=<?php $ssid=$_GET['bid']; echo $ssid; ?>&pid=0"> <img src="logo.png" alternate="KineFelun" height="200px" widht="200px"> </a>
    </div>
    <div class="container">
        <div class="container">
            <form action="search_product.php?pid=<?php $pid=0; echo $pid; ?>&bid=<?php $bid=$_GET['bid']; echo $bid; ?>" method="POST" class='form-control '>
                <input type="text" class='form-control'placeholder='Search Using Product Name or Type' style="font-size: 30px" name='nm'>
                <input type="submit" class='form-control btn-primary' value='Search' style="font-size: 30px" name='sub'>
            </form>
        </div>
        <?php
            $nm=$_POST['nm'];
            $bid=$_GET['bid'];
            $con=mysqli_connect('localhost','root','','prac_pro');
            $q="SELECT * FROM product_detail WHERE p_name LIKE '%".$nm."%' or p_type LIKE '%".$nm."%' ";

            echo '<div class="card-group">';
            if($con){
                $res=mysqli_query($con,$q);
                while($row=mysqli_fetch_row($res)){

                    echo '<div class="card m-4" style="max-width: 18rem; min-width: 16rem" >';
                        echo "<img src='Products/$row[6]' height='400' width='auto' >";
                        echo '<div class="card-body">';
                            echo '<h5 class="card-title text-danger" style="font-size: 28px; font-weight: bolder;" align="center">'.$row[1].'</h5>';
                            echo '<p class="card-text" style="font-size: 22px; font-weight: bolder;">Type : '.$row[2].'</p>';
                            echo '<p class="card-text" style="font-size: 22px; font-weight: bolder;">Available : '.$row[4].'</p>';
                            echo '<p class="card-text" style="font-size: 22px; font-weight: bolder;">Price : '.$row[5].'</p>';
                        echo "</div>";
                        echo '<div class="card-footer bg-transparent"><a class="btn btn-success m-2" style="font-size:23px" href="buyer.php?slogid='.$bid.'&pid='.$row[0].'">ADD TO CART</a></div>';
                    echo "</div>";
                } 
            }
            echo '</div>';
        ?>
    </div>
</body>
</html>