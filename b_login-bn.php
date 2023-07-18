<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ক্রেতা লগ ইন</title>
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
        <a href="1stpage-bn.php"> <img src="logo.png" alternate="KineFelun" height="200px" widht="200px"> </a>
    </div>
    <div class="container" align="center">
        <form action="b_login-bn.php" style="height: 400px; width: 700px;" method="POST" class='form-control bg-transparent'>
            <h3 align="center" style="font-weight: bolder; font-size: 40px">ক্রেতা লগ ইন</h3>
            <h4 align="left" style="font-weight: bolder; font-size: 35px">ইমেইল:</h4>
            <input type='email' class='form-control' placeholder='example@gmail.com' style="font-size: 30px" name='email'>
            <h4 align="left" style="font-weight: bolder; font-size: 35px">পাসওয়ার্ড:</h4>
            <input type='password' class='form-control mb-3' placeholder='Password' style="font-size: 30px" name='pass'>
            <input type="submit" class='form-control btn-primary' name='sb' style="font-weight: bolder; font-size: 40px" value='লগ ইন'>
        </form>

        <?php
            if(isset($_POST['sb'])){
                $em=$_POST['email'];
                $ps=$_POST['pass'];
                $q='SELECT * FROM buyer';
                $slogid=0;
                $con=mysqli_connect('localhost','root','','prac_pro');

                $lenps=strlen($ps);
                for($i=0; $i<$lenps; $i++)
                {
                    $ps[$i]=chr(ord($ps[$i])+5);
                }

                if($con){
                    $f=0;
                    $res=mysqli_query($con,$q);
                    while($row=mysqli_fetch_row($res)){
                        if($row[2]==$em && $row[3]==$ps && $row[6]==0)
                        {
                            $slogid=$row[0];
                            echo '<h2 style="font-weight: bolder;" class="text-success">লগ ইন সফল হয়েছে।</h2>';
                            echo '<a style="font-weight: bolder; font-size:40px;" href="buyer-bn.php?slogid='.$slogid.'&pid=0" class="btn btn-success">ক্রেতার হোম পেজ</a>';
                            $f=1;
                            break;
                        }
                        else if($row[2]==$em && $row[3]==$ps && $row[6]>0)
                        {
                            $slogid=$row[0];
                            echo '<h2 style="font-weight: bolder;" class="text-success">আপনার ভেরিফিকেশন কোড টি প্রদান করুন।</h2>';
                            echo '<a style="font-weight: bolder; font-size:40px;" href="bver-bn.php?slogid='.$slogid.'&pid=0" class="btn btn-success">ভেরিফাই করুন।</a>';
                            $f=1;
                        }
                    }
                    if(!$f){
                        echo '<h2 style="font-weight: bolder;" class="text-danger fs-3  border-bottom">লগ ইন সফল হয়নি।</h2>';
                    }
                }
            }
        ?>
    </div>
</body>
</html>


