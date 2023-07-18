<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Registration</title>
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
    <div align="center">
        <form action="s_reg.php" style="height: 720px; width: 700px;" method="POST" class='form-control bg-transparent'>
            <h3 align="center" style="font-weight: bolder; font-size: 40px">Seller Registration Form</h3>
            <h4 align="left" style="font-weight: bolder; font-size: 35px">Name:</h4>
            <input type="text" class='form-control'placeholder='Name' style="font-size: 30px" name='nm'>
            <h4 align="left" style="font-weight: bolder; font-size: 35px">Email:</h4>
            <input type='email' class='form-control' placeholder='Example@gmail.com' style="font-size: 30px" name='em'>
            <h4 align="left" style="font-weight: bolder; font-size: 35px">Password:</h4>
            <input type='password' class='form-control' placeholder='Password (minimum 8 characters)' style="font-size: 30px" pattern="[A-Za-z0-9]{8,20}" name='ps'>
            <h4 align="left" style="font-weight: bolder; font-size: 35px">Address:</h4>
            <input type='text' class='form-control'placeholder='Address' style="font-size: 30px" name='add'>
            <h4 align="left" style="font-weight: bolder; font-size: 35px">Phone Number:</h4>
            <input type='text' class='form-control mb-3' placeholder='01xxx-xxxxxx' pattern="[0-9]{11}" style="font-size: 30px" name='phn'>
            <input type="submit" class='form-control btn-primary' value='Register' style="font-weight: bolder; font-size: 40px" name='sub'>
        </form>
        <?php


            //Import PHPMailer classes into the global namespace
            //These must be at the top of your script, not inside a function
            use PHPMailer\PHPMailer\PHPMailer;
            use PHPMailer\PHPMailer\SMTP;
            use PHPMailer\PHPMailer\Exception;


            if(isset($_POST['sub']))
            {
                $nm=$_POST['nm'];
                $em=$_POST['em'];
                $ps=$_POST['ps'];
                $add=$_POST['add'];
                $phn=$_POST['phn'];
                $con=mysqli_connect('localhost','root','','prac_pro');
                $ver=rand(100000, 999999);

                $lenps=strlen($ps);
                for($i=0; $i<$lenps; $i++)
                {
                    $ps[$i]=chr(ord($ps[$i])+5);
                }

                if($con){
                    $q="INSERT INTO seller (s_id, s_name, s_mail, s_pass, s_add, s_phn, verification) VALUES (NULL, '$nm', '$em', '$ps', '$add', '$phn', '$ver');";
                    $result = mysqli_query($con,$q);
                    echo '<h2 class="text-success fs-1 " style="font-weight:bolder;">Registration Successful</h2>';
                    echo '<a class="btn btn-success" style="font-size:35px" href="s_login.php">Seller Login Page</a></font>';
                }   




                        //Load Composer's autoloader
                        require('PHPMailer/Exception.php');
                        require('PHPMailer/SMTP.php');
                        require('PHPMailer/PHPMailer.php');



                        //Create an instance; passing `true` enables exceptions
                        $mail = new PHPMailer(true);

                            //Server settings
                            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                            $mail->isSMTP();                                            //Send using SMTP
                            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                            $mail->Username   = 'irfan.daraz101@gmail.com';                     //SMTP username
                            $mail->Password   = 'prantik123';                               //SMTP password
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                            //Recipients
                            $mail->setFrom('irfan.daraz101@gmail.com', 'Prantik.com');
                            $mail->addAddress($em, $nm);     //Add a recipient


                            //Attachments
                            //$mail->addAttachment();         //Add attachments
                            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                            //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = 'Verification Code for Prantik.com';
                            $mail->Body    = 'To complete your registration as a seller on Prantik.com, please use this verification code on the website.</b>CODE: '.$ver.'';


                            $mail->send();



            }
        ?>
    </div>
</body>
</html>