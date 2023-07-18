<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>বিক্রেতা হোম পেজ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap');
    body{font-family: 'Oswald', 'sans-serif';}
</style>

<body>
    <div align="center">
        <a href="seller-bn.php?slogid=<?php $ssid=$_GET['slogid']; echo $ssid; ?>"> <img src="logo.png" alternate="KineFelun" height="200px" widht="200px"> </a>
    </div>

    <div class="container">
        <?php
            $ssid=$_GET['slogid'];
            $con=mysqli_connect('localhost','root','','prac_pro');
            $q='SELECT * FROM seller';
            if($con){
                $f=0;
                $res=mysqli_query($con,$q);
                while($row=mysqli_fetch_row($res)){
                    if($row[0]==$ssid){
                        echo '<div class="text-warning fs-1 text-center border border-bottom shadow p-3 m-3" style="font-weight:bolder;">বিক্রেতার তথ্য</div>';
                        echo '<div class="text-info fs-3 text-center border-bottom shadow p-6 m-3" style="font-weight:bolder;">বিক্রেতার আইডি : ' .$row[0]. '</div>';
                        echo '<div class="text-danger fs-3  border-bottom" style="font-weight:bolder;">নাম: ' .$row[1]. '</div>';
                        echo '<div class="text-danger fs-3  border-bottom" style="font-weight:bolder;">ইমেইল: ' .$row[2]. '</div>';
                        echo '<div class="text-danger fs-3  border-bottom" style="font-weight:bolder;">ঠিকানা: ' .$row[4]. '</div>';
                        echo '<div class="text-danger fs-3  border-bottom mb-4" style="font-weight:bolder;">মোবাইল নং: ' .$row[5]. '</div>';


                        echo '<a style="font-weight:bolder;" class="btn btn-primary d-inline m-2 my-2" href="edit_seller.php?slogid='.$row[0].'">পরিবর্তন</a>';
                        echo '<a style="font-weight:bolder;" class="btn btn-secondary d-inline m-2 " href="solditems-bn.php?slogid='.$row[0].'">বিক্রিত পণ্য</a>';
                        echo '<a style="font-weight:bolder;" class="btn btn-info d-inline m-2 " href="1stpage-bn.php">লগ আউট</a>';
                        
                        $f=1;
                    }
                }
            }
        ?>
        <h1 class="text-success fs-2 text-center border border-bottom shadow p-3 m-3" style="font-weight:bolder;">নতুন পণ্য যোগ করুন :</h1>
        <div style="height: auto; width: 600px;">
            <form action="seller-bn.php?slogid=<?php $ssid=$_GET['slogid']; echo $ssid; ?>" method="POST" class='form-control bg-transparent'>
                <h4 align="left" style="font-weight: bolder; font-size: 24px">পণ্যের নাম:</h2>
                <input type="text" class='form-control'placeholder='পণ্যের নাম' style="font-size: 22px" name='nm'>
                <h4 align="left" style="font-weight: bolder; font-size: 24px">ধরণ:</h2>
                <input type='text' class='form-control' placeholder='ধরণ' style="font-size: 22px" name='tp'>
                <h4 align="left" style="font-weight: bolder; font-size: 24px">বিক্রেতা আইডি:</h2>
                <input type='text' class='form-control' placeholder='বিক্রেতা আইডি' style="font-size: 22px" name='sid'>
                <h4 align="left" style="font-weight: bolder; font-size: 24px">পরিমাণ:</h2>
                <input type='text' class='form-control'placeholder='পরিমাণ' style="font-size: 22px" name='avl'>
                <h4 align="left" style="font-weight: bolder; font-size: 24px">দাম:</h2>
                <input type='text' class='form-control mb-3' placeholder='দাম' style="font-size: 22px" name='ppu'>
                <h4 align="left" style="font-weight: bolder; font-size: 24px">ছবি:</h2>
                <input type="file" class='form-control mb-3' placeholder='ছবি' style="font-size: 22px" name="file">
                <input type="submit" class='form-control btn-primary' value='যুক্ত করুণ' style="font-size: 26px" name='sub'>
            </form>
        </div>
        <h1 class="text-success fs-2 text-center border border-bottom shadow p-3 m-3" style="font-weight:bolder;">আপলোডকৃত পণ্য সকল:</h1>
        <?php
            if($_GET['slogid']){
                $ssid=$_GET['slogid'];
            }
            if(isset($_POST['sub'])){
                $ssid=$_POST['sid'];
                $nm=$_POST['nm'];
                $tp=$_POST['tp'];
                $sid=$_POST['sid'];
                $avl=$_POST['avl'];
                $ppu=$_POST['ppu'];
                $con=mysqli_connect('localhost','root','','prac_pro');
                if($con){
                    $filename=$_POST['file'];
                    $filepath=$filename;
                    $q="INSERT INTO product_detail (p_id, p_name, p_type, s_id, avl, ppu, img) VALUES (NULL, '$nm', '$tp', '$sid', '$avl', '$ppu', '$filepath');";
                    $result = mysqli_query($con,$q);
                    echo '<div class="text-success fs-2 text-center border border-bottom shadow p-3 m-3" style="font-weight:bolder;">আপলোড সফল হয়েছে।</div>';
                }   
            }
            $con=mysqli_connect('localhost','root','','prac_pro');
            $q='SELECT * FROM product_detail';

            if($con){
                $f=0;
                $res=mysqli_query($con,$q);

                echo '<div class="card-group">';
                while($row=mysqli_fetch_row($res)){
                    if($row[3]==$ssid){

                        $f=1;

                        echo '<div class="card m-4" style="max-width: 18rem; min-width: 16rem" >';
                          echo "<img src='Products/$row[6]' height='400' width='auto' >";
                          echo '<div class="card-body">';
                            echo '<h5 class="card-title text-danger" style="font-size: 28px; font-weight: bolder;" align="center">'.$row[1].'</h5>';
                            echo '<p class="card-text" style="font-size: 22px; font-weight: bolder;">পণ্যের আইডি: '.$row[0].'</p>';
                            echo '<p class="card-text" style="font-size: 22px; font-weight: bolder;">ধরণ: '.$row[2].'</p>';
                            echo '<p class="card-text" style="font-size: 22px; font-weight: bolder;">পরিমাণ: '.$row[4].'</p>';
                            echo '<p class="card-text text-success my-2" style="font-size: 25px; font-weight: bolder;" align="center">দাম: '.$row[5].'</p>';

                          echo "</div>";

                          echo '<div class="card-footer bg-transparent d-inline"><a class="btn btn-primary" style="font-size:26px" href="edit_product.php?p_id='.$row[0].'&slogid='.$row[3].'">পরিবর্তন</a><a class="btn btn-danger" style="font-size:26px" href="remove_from_shop.php?slogid='.$row[3].'&pid='.$row[0].'">বাতিল</a></div>';

                        echo "</div>";
                          

                    }
                }
                echo '</div>';
            }
        ?>
    </div>
</body>
</html>
