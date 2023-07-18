<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Buyer Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap');
    body{font-family: 'Oswald', 'sans-serif';}
</style>

<body>
    <div align="center">
        <a href="buyer.php?slogid=<?php $ssid=$_GET['slogid']; echo $ssid; ?>&pid=0"> <img src="logo.png" alternate="KineFelun" height="200px" widht="200px"> </a>
    </div>
    <div class="container">
        <h1 class="text-warning fs-1 text-center border border-bottom shadow p-3 m-3" style="font-weight:bolder;">Update Profile Information :</h1>
        <form action="edit_buyer.php?slogid=<?php $ssid=$_GET['slogid']; echo $ssid; ?>" method="POST" class='form-control '>
            <b style="font-weight: bolder; font-size: 26px">Name:</b>
            <input type="text" class='form-control'placeholder='Name' style="font-size: 22px" name='nm'>
            <b style="font-weight: bolder; font-size: 26px">Email:</b>
            <input type='email' class='form-control' placeholder='Example@gmail.com' style="font-size: 22px" name='em'>
            <b style="font-weight: bolder; font-size: 26px">Password:</b>
            <input type='password' class='form-control' placeholder='Password (minimum 8 characters)' pattern="[A-Za-z0-9]{8,20}" style="font-size: 22px" name='ps'>
            <b style="font-weight: bolder; font-size: 26px">Address:</b>
            <input type='text' class='form-control'placeholder='Address' style="font-size: 22px" name='add'>
            <b style="font-weight: bolder; font-size: 26px">Phone Number:</b>
            <input type='text' class='form-control mb-3' placeholder='01xxx-xxxxxx' pattern="[0-9]{11}" style="font-size: 22px" name='phn'>
            <input type="submit" class='form-control btn-primary' value='Update' style="font-size: 26px" name='sub'>
        </form>
        <?php
            if(isset($_POST['sub'])){
                $ssid=$_GET['slogid'];
                $nm=$_POST['nm'];
                $em=$_POST['em'];
                $ps=$_POST['ps'];
                $add=$_POST['add'];
                $phn=$_POST['phn'];
                $con=mysqli_connect('localhost','root','','prac_pro');
                $q='SELECT * FROM buyer';
                if($con){
                    $f=0;
                    $res=mysqli_query($con,$q);
                    while($row=mysqli_fetch_row($res)){
                        if($row[0]==$ssid){
                            $q="UPDATE buyer SET b_name='$nm', b_mail='$em', b_pass='$ps', b_add='$add', b_phn='$phn' WHERE buyer.b_id='$ssid';";
                            $result = mysqli_query($con,$q);
                            echo '<h2 style="font-weight: bolder; font-size:50px;" class="text-success" align=center>Update Successful.</h2>';
                            $f=1;
                            break;
                        }
                    }
                    $updateshiploc="UPDATE order_detail SET ship_loc='$add' WHERE order_detail.b_id='$ssid' AND flag='0';";
                    $resupdateshiploc=mysqli_query($con,$updateshiploc); 
                }     
            }
        ?>
    </div>
</body>
</html>