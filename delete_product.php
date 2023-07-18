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
        <img src="logo.png" alternate="KineFelun" height="200px" widht="200px">
    </div>
    <div class="container" align="center">
        <?php
            $pid=$_GET['pid'];
            $bid=$_GET['slogid'];
            $oid=$_GET['oid'];
            $oin=$_GET['oin'];
            $con=mysqli_connect('localhost','root','','prac_pro');
            $q='SELECT * FROM order_info';
            if($con){
                $orinfo=mysqli_query($con, $q);
                while($orin=mysqli_fetch_row($orinfo)){
                    if($orin[3]==$pid && $orin[1]==$oid){
                        $qdel="SELECT * FROM order_info;";
                        $resdel=mysqli_query($con, $qdel);
                        while($rowdel=mysqli_fetch_row($resdel)){
                            if($rowdel[3]==$pid && $rowdel[2]==$bid)
                            {
                                $orderinfo=$rowdel[0];
                                $q="DELETE FROM order_info WHERE o_info=$oin;";
                                $result=mysqli_query($con, $q);
                                break;
                            }
                        }

                        $q2='SELECT * FROM order_detail';
                        $ordet=mysqli_query($con,$q2);
                        while($orde=mysqli_fetch_row($ordet)){
                            if($orde[0]==$orin[1] && $orde[4]==0)
                            {
                                $minus = $orde[2]-$orin[6];
                                $q3="UPDATE order_detail SET total_cost = '$minus' WHERE order_detail.o_id='$oid';";
                                $res=mysqli_query($con,$q3);

                                $q4='SELECT * FROM product_detail';
                                $prodet=mysqli_query($con,$q4);
                                while($pro=mysqli_fetch_row($prodet)){
                                    if($pro[0]==$pid){
                                        $quan=$pro[4]+1;
                                        $q5="UPDATE product_detail SET avl='$quan' WHERE product_detail.p_id='$pid';";
                                        $result = mysqli_query($con,$q5);
                                        break;
                                    }
                                } 
                                break;
                            }
                        }
                        echo '<h2 class="text-danger fs-3  border-bottom" style="font-weight:bolder;">Delete Successful</h2>';
                        echo '<a class="btn btn-success" style="font-size:35px" href="buyer.php?slogid='.$bid.'&pid=0">Buyer Homepage</a>';
                        break;
                    }
                } 
            }     
        ?>
    </div>
</body>
</html>