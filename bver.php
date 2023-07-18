<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
</head>

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

<body>
    <div align="center">
        <a href="1stpage.php"> <img src="logo.png" alternate="KineFelun" height="200px" widht="200px"> </a>
    </div>
    <div class="container" align="center">
        <form action="bver.php?slogid=<?php $ssid=$_GET['slogid']; echo $ssid; ?>&pid=0" style="height: 400px; width: 700px;" method="POST" class='form-control bg-transparent'>
            <h3 align="center" style="font-weight: bolder; font-size: 40px">Buyer Verification</h3>
            <h4 align="left" style="font-weight: bolder; font-size: 35px">Verification Code:</h4>
            <input type='text' class='form-control' placeholder='XXXXXX' style="font-size: 30px" name='verchk'>
            <input type="submit" class='form-control btn-primary' name='sb' style="font-weight: bolder; font-size: 40px" value='Verify'>
        </form>

        <?php
            if(isset($_POST['sb'])){
                $ssid=$_GET['slogid'];
                $verchk=$_POST['verchk'];
                $con=mysqli_connect('localhost','root','','prac_pro');
                $q='SELECT * FROM buyer';
                if($con){
                    $f=0;
                    $res=mysqli_query($con,$q);
                    while($row=mysqli_fetch_row($res)){
                        if($row[0]==$ssid && $row[6]==$verchk){
                            $slogid=$row[0];
                            $q="UPDATE buyer SET verification='0' WHERE buyer.verification='$verchk';";
                            $result = mysqli_query($con,$q);
                            echo '<h2 style="font-weight: bolder;" class="text-success">Verification Successful.</h2>';
                            echo '<a style="font-weight: bolder; font-size:40px;" href="buyer.php?slogid='.$slogid.'&pid=0" class="btn btn-success">Buyer Homepage</a>';
                            $f=1;
                            break;
                        }
                        else if($row[0]==$ssid && $row[6]!=$verchk)
                        {
                            echo '<h2 style="font-weight: bolder;" class="text-success">Verification Unsuccesful</br>Please Register Again.</h2>';
                            $q="DELETE FROM buyer WHERE buyer.verification='$row[6]';";
                            $result = mysqli_query($con,$q);

                        }
                    }
                }
            }
        ?>
    </div>
</body>
</html>


