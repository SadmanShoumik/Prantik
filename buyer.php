<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap');
        body
        {
            font-family: 'Oswald', 'sans-serif';
            background-image: url("background.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div align="center">
        <a href="buyer.php?slogid=<?php $ssid=$_GET['slogid']; echo $ssid; ?>&pid=0"> <img src="logo.png" alternate="KineFelun" height="200px" widht="200px"> </a>
    </div>

    <div class="container">
        <?php
            $ssid=$_GET['slogid'];
            $con=mysqli_connect('localhost','root','','prac_pro');
            $q='SELECT * FROM buyer';
            if($con){
                $f=0;
                $res=mysqli_query($con,$q);
                while($row=mysqli_fetch_row($res)){
                    if($row[0]==$ssid){
                        echo '<div class="text-warning fs-1 text-center border border-bottom shadow p-3 m-3" style="font-weight:bolder;">Buyer Information</div>';
                        echo '<div class="text-info fs-3 text-center border-bottom shadow p-6 m-3" style="font-weight:bolder;" >Buyer ID : ' .$row[0]. '</div>';
                        echo '<div class="text-danger fs-3  border-bottom" style="font-weight:bolder;">Name     : ' .$row[1]. '</div>';
                        echo '<div class="text-danger fs-3  border-bottom" style="font-weight:bolder;">Email    : ' .$row[2]. '</div>';
                        echo '<div class="text-danger fs-3  border-bottom" style="font-weight:bolder;">Address  : ' .$row[4]. '</div>';
                        echo '<div class="text-danger fs-3  border-bottom mb-4" style="font-weight:bolder;">Phone    : ' .$row[5]. '</div>';


                        echo '<a  style="font-weight:bolder;" class="btn btn-primary d-inline m-2 my-2" href="edit_buyer.php?slogid='.$row[0].'">EDIT</a>';
                        echo '<a  style="font-weight:bolder;" class="btn btn-secondary d-inline m-2 " href="history.php?slogid='.$row[0].'">ORDER HISTORY</a>';
                        echo '<a  style="font-weight:bolder;" class="btn btn-info d-inline m-2" href="1stpage.php">LOGOUT</a>';

                        $f=1;
                    }
                }
            }
        ?>
        <div class="container">
            <?php
                $bid=$_GET['slogid'];
                $check_pid=$_GET['pid'];
                if($check_pid){
                    $quantity=1;
                    $q_prod="SELECT * FROM product_detail where p_id='$check_pid';";
                    $resorder=mysqli_query($con,$q_prod);

                    $newq1="SELECT * FROM order_detail WHERE b_id='$ssid' AND flag=0;";
                    $newres1=mysqli_query($con,$newq1);
                    while($newrow1=mysqli_fetch_row($newres1))
                    {
                        $orderid=$newrow1[0];
                        break;
                    }   
                    while($oinfo=mysqli_fetch_row($resorder))
                    {
                        $q_orderinfo="INSERT INTO order_info (o_info, o_id, b_id, p_id, s_id, quantity, price) VALUES (NULL, '$orderid', '$bid', '$oinfo[0]', '$oinfo[3]', '$quantity', '$oinfo[5]');";
                        $q_orderdetail="UPDATE order_detail SET total_cost=total_cost+'$oinfo[5]' WHERE b_id='$bid' AND flag='0';";
                        $q_minuspro="UPDATE product_detail SET avl=avl-1 WHERE p_id='$check_pid';";
                        $res_orderinfo=mysqli_query($con, $q_orderinfo);
                        $res_orderdetail=mysqli_query($con, $q_orderdetail);
                        $res_minuspro=mysqli_query($con, $q_minuspro);
                    }
                    echo '<div class="text-success fs-2 text-center border border-bottom shadow p-3 m-3" style="font-weight:bolder;">Product Added to Cart</div>';
                }    
            ?>
            <form action="search_product.php?pid=<?php $pid=0; echo $pid; ?>&bid=<?php $bid=$_GET['slogid']; echo $bid; ?>" style="height: 130px; width: 1100px; margin-left:100px ;margin-top:50px; margin-bottom:50px;" method="POST" class='form-control bg-transparent'>
                <input type="text" class='form-control'placeholder='Search Using Product Name or Type' style="font-size: 30px" name='nm'>
                <input type="submit" class='form-control btn-primary' value='Search' style="font-size: 30px" name='sub'>
            </form>
        </div>
        <?php
            if($_GET['slogid']){
                $ssid=$_GET['slogid'];
            }
            $con=mysqli_connect('localhost','root','','prac_pro');
            $q='SELECT * FROM order_info';

            $newq1="SELECT * FROM order_detail WHERE b_id='$ssid' AND flag=0;";
            $newres1=mysqli_query($con,$newq1);
            while($newrow1=mysqli_fetch_row($newres1))
            {
                $orderid=$newrow1[0];
                break;
            }
            if($con){
                $f=0;
                $res=mysqli_query($con,$q);
                echo '<div class="text-dark fs-1 text-center border-bottom shadow p-4 m-4">Your Cart :</div>';

                echo '<div class="card-group">';
                while($row=mysqli_fetch_row($res)){
                    if($row[2]==$ssid && $row[1]==$orderid){
                        $q2='SELECT * FROM product_detail';
                        $res2=mysqli_query($con,$q2);
                        while($row2=mysqli_fetch_row($res2)){
                            if($row2[0]==$row[3]){


                                echo '<div class="card m-4" style="max-width: 18rem; min-width: 16rem" >';
                                    echo "<img src='Products/$row2[6]' height='400' width='auto' >";
                                    echo '<div class="card-body">';
                                        echo '<h5 class="card-title text-danger" style="font-size: 28px; font-weight: bolder;" align="center">'.$row2[1].'</h5>';
                                        echo '<p class="card-text" style="font-size: 22px; font-weight: bolder;">Type : '.$row2[2].'</p>';
                                        echo '<p class="card-text" style="font-size: 22px; font-weight: bolder;">Price : '.$row2[5].'</p>';
                                    echo "</div>";
                                    echo '<div class="card-footer bg-transparent"><a class="btn btn-danger" style="font-size:26px" href="delete_product.php?slogid='.$row[2].'&pid='.$row2[0].'&oid='.$orderid.'&oin='.$row[0].'">Delete</a></div>';
                                echo "</div>";


                            }
                        }
                        $f=1;
                    }
                }
                echo '</div>';


                $q2='SELECT * FROM order_detail';
                $ordet=mysqli_query($con,$q2);
                while($orde=mysqli_fetch_row($ordet)){
                    if($orde[1]==$ssid && $orde[4]==0){
                        echo '<div class="text-success fs-1 text-center border border-bottom shadow p-3 m-3" style="font-weight:bolder;">Total Cost : ' .$orde[2]. '</div>';
                        echo '<div align=center> <a class="btn btn-success" style="font-size:35px;" href="checkout.php?slogid='.$ssid.'">CHECKOUT</a> </div>';
                        break;
                    }
                }
                echo '<div style="font-size: 30px;" align=center>_</div>';
            }
        ?>
    </div>
</body>
</html>