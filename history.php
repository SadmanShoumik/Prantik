<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap');
    body{font-family: 'Oswald', 'sans-serif';}
</style>

<body>
    <div align="center">
        <a href="buyer.php?slogid=<?php $ssid=$_GET['slogid']; echo $ssid; ?>&pid=0"> <img src="logo.png" alternate="KineFelun" height="200px" widht="200px" > </a>
    </div>

    <div class="container">
        
        <?php
            if($_GET['slogid']){
                $ssid=$_GET['slogid'];
            }
            $con=mysqli_connect('localhost','root','','prac_pro');

            $newq1="SELECT * FROM order_detail WHERE b_id='$ssid' AND flag=1;";
            $newres1=mysqli_query($con,$newq1);
            echo '<div class="text-warning fs-1 text-center border border-bottom shadow p-3 m-3" style="font-weight:bolder;">Your Orders :</div>';
            
            while($newrow1=mysqli_fetch_row($newres1))
            {
                $orderid=$newrow1[0];
                echo '<div class="text-dark fs-1 text-center border-bottom shadow p-4 m-4">Order ID       : ' .$orderid. '</div>';
                $q="SELECT * FROM order_info WHERE o_id='$orderid'";
                $res=mysqli_query($con,$q);

                echo '<div class="card-group">';
                while($row=mysqli_fetch_row($res)){
                    if($row[2]==$ssid && $row[1]==$orderid){
                        $q2='SELECT * FROM product_detail';
                        $res2=mysqli_query($con,$q2);
                        while($row2=mysqli_fetch_row($res2)){
                            if($row2[0]==$row[3]){

                                echo '<div class="card m-4" style="max-width: 18rem; min-width: 16rem" >';
                                    echo "<img src='Products/$row2[6]' height='400' width='auto'>";
                                    echo '<div class="card-body">';
                                        echo '<h5 class="card-title text-danger" style="font-size: 28px; font-weight: bolder;" align="center">'.$row2[1].'</h5>';
                                        echo '<p class="card-text" style="font-size: 22px; font-weight: bolder;">Type : '.$row2[2].'</p>';
                                        echo '<p class="card-text" style="font-size: 22px; font-weight: bolder;">Price : '.$row2[5].'</p>';
                                    echo "</div>";
                                echo "</div>";

                            }
                        }
                    }
                }
                echo '</div>';
                echo '<div class="text-success fs-1 text-center border border-bottom shadow p-3 m-3" style="font-weight:bolder;">Total Cost : ' .$newrow1[2]. '</div>';
            }

            if($con){
            }
        ?>
    </div>
</body>
</html>