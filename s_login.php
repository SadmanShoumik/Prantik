<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Login</title>
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
        <form action="s_login.php" style="height: 400px; width: 700px;" method="POST" class='form-control bg-transparent'>
            <h3 align="center" style="font-weight: bolder; font-size: 40px">Seller Login</h3>
            <h4 align="left" style="font-weight: bolder; font-size: 35px">Email:</h4>
            <input type='email' class='form-control' placeholder='example@gmail.com' style="font-size: 30px" name='email'>
            <h4 align="left" style="font-weight: bolder; font-size: 35px">Password:</h4>
            <input type='password' class='form-control mb-3' placeholder='Password' style="font-size: 30px" name='pass'>
            <input type="submit" class='form-control btn-primary' name='sb' style="font-weight: bolder; font-size: 40px" value='Login'>
        </form>

        <?php
            if(isset($_POST['sb'])){
                $em=$_POST['email'];
                $ps=$_POST['pass'];
                $q='SELECT * FROM seller';
                $slogid=0;

                $lenps=strlen($ps);
                for($i=0; $i<$lenps; $i++)
                {
                    $ps[$i]=chr(ord($ps[$i])+5);
                }
                
                $con=mysqli_connect('localhost','root','','prac_pro');
                if($con)
                {
                    $f=0;
                    $res=mysqli_query($con,$q);
                    while($row=mysqli_fetch_row($res))
                    {
                        if($row[2]==$em && $row[3]==$ps && $row[6]==0)
                        {
                            $slogid=$row[0];
                            echo '<h2 style="font-weight: bolder;" class="text-success">Login Successful.</h2>';
                            echo '<a style="font-weight: bolder; font-size:40px;" href="seller.php?slogid='.$slogid.'" class="btn btn-success">Seller Homepage</a>';
                            $f=1;
                            break;
                        }
                        else if($row[2]==$em && $row[3]==$ps && $row[6]>0)
                        {
                            $slogid=$row[0];
                            echo '<h2 style="font-weight: bolder;" class="text-success">Please Enter Verification Code</h2>';
                            echo '<a style="font-weight: bolder; font-size:40px;" href="sver.php?slogid='.$slogid.'" class="btn btn-success">Verify</a>';
                            $f=1;
                        }
                    }
                    if(!$f){
                        echo '<h2 style="font-weight: bolder;" class="text-danger fs-3  border-bottom">Login Unsuccessful</h2>';
                    }
                }
            }
        ?>
    </div>
</body>
</html>