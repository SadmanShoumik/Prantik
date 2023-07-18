<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sold Items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap');
    body{font-family: 'Oswald', 'sans-serif';}
</style>


<body>
    <div align="center">
        <a href="seller.php?slogid=<?php $ssid=$_GET['slogid']; echo $ssid; ?>&pid=0"> <img src="logo.png" alternate="Prantik" height="200px" widht="200px" > </a>
    </div>

    <div class="container">
        
        <?php
            if($_GET['slogid']){
                $ssid=$_GET['slogid'];
            }
            $con=mysqli_connect('localhost','root','','prac_pro');

            echo '<div class="text-warning fs-1 text-center border border-bottom shadow p-3 m-3" style="font-weight:bolder;">Your Sold Items :</div>';

            $qpdetail="SELECT * FROM product_detail WHERE s_id='$ssid';";
            $rpdetail=mysqli_query($con,$qpdetail);

            $bigcount=0;
            $totalcost=0;



            echo '<div class="card-group">';
            while($rowpdetail=mysqli_fetch_row($rpdetail))
            {

                $count=0;

                $qoinfo="SELECT * FROM order_info WHERE p_id='$rowpdetail[0]';";
                $roinfo=mysqli_query($con,$qoinfo);

                while($rowoinfo=mysqli_fetch_row($roinfo))
                {
                    if($rowpdetail[0]==$rowoinfo[3])
                    {
                        if($count==0)
                        {

                            //echo '<div class="card m-4" style="max-width: 18rem; min-width: 16rem" >';
                            //   echo "<img src='$rowpdetail[6]' height='400' width='auto'>";
                            //   echo '<div class="card-body">';
                            //        echo '<h5 class="card-title text-danger" style="font-size: 28px; font-weight: bolder;" align="center">'.$rowpdetail[1].'</h5>';
                            //        echo '<p class="card-text" style="font-size: 22px; font-weight: bolder;">Product ID : '.$rowpdetail[0].'</p>';
                            //        echo '<p class="card-text" style="font-size: 22px; font-weight: bolder;">Type : '.$rowpdetail[2].'</p>';
                            //        echo '<p class="card-text text-success my-2" style="font-size: 25px; font-weight: bolder;" align="center">Price: '.$rowpdetail[5].'</p>';
                            //    echo "</div>";
                            //echo "</div>";

                        }
                        $count=$count+1;
                        $bigcount=$bigcount+1;
                        $totalcost=$totalcost+$rowpdetail[5];
                    }
                }
                if($count>0)
                {
                    echo '<div class="card m-4" style="max-width: 18rem; min-width: 16rem" >';
                        echo "<img src='Products/$rowpdetail[6]' height='400' width='auto'>";
                        echo '<div class="card-body">';
                            echo '<h5 class="card-title text-danger" style="font-size: 28px; font-weight: bolder;" align="center">'.$rowpdetail[1].'</h5>';
                            echo '<p class="card-text" style="font-size: 22px; font-weight: bolder;">Product ID : '.$rowpdetail[0].'</p>';
                            echo '<p class="card-text" style="font-size: 22px; font-weight: bolder;">Type : '.$rowpdetail[2].'</p>';
                            echo '<p class="card-text text-success my-2" style="font-size: 25px; font-weight: bolder;" align="center">Price: '.$rowpdetail[5].'</p>';
                        echo "</div>";
                        echo '<div class="card-footer text-dark" style="font-size: 30px; font-weight: bolder;">Quantity Sold : ' .$count. '</div>';
                    echo "</div>";
                }
            }
            echo '</div>';

            echo '<div class="text-success fs-1 text-center border border-bottom shadow p-3 m-3" style="font-weight:bolder;">Total Items Sold: ' .$bigcount. '</div>';
            echo '<div class="text-success fs-1 text-center border border-bottom shadow p-3 m-3" style="font-weight:bolder;">Total Sale: ' .$totalcost. '</div>';
        ?>
    </div>
</body>
</html>