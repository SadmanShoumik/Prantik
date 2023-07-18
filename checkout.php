<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Complete</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap');
    body{font-family: 'Oswald', 'sans-serif';}
</style>

<body>
    <div align="center">
        <img src="logo.png" alternate="KineFelun" height="200px" widht="200px">
    </div>
    <div class="container" align="center">
        <?php
            $bid=$_GET['slogid'];
            $con=mysqli_connect('localhost','root','','prac_pro');
            $s=0;
            $qorinfo='SELECT * FROM order_info';
            $qordet='SELECT * FROM order_detail';
            if($con){
                $res2=mysqli_query($con,$qordet);
                while($row2=mysqli_fetch_row($res2))
                {
                    $qdelete2="UPDATE order_detail SET flag=1 WHERE order_detail.b_id='$bid';" ;
                    if($row2[1]==$bid && $row2[4]==0)
                    {
                        $res22=mysqli_query($con,$qdelete2);
                        $q2="INSERT INTO order_detail (o_id, b_id, total_cost, ship_loc, flag) VALUES (NULL, '$bid', '0', '$row2[3]', '0');";
                        $res3=mysqli_query($con,$q2);
                        break;
                    }
                }
                echo '<h2 style="font-weight: bolder;">Checkout Successful<br>You will receive your product within 7 workdays.</h2>';
                echo '<a class="btn btn-success" style="font-size:35px" href="buyer.php?slogid='.$bid.'&pid=0">Buyer Homepage</a>';
            }     
        ?>
    </div>
</body>
</html>