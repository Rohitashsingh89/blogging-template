<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact form</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Contact Us</h1>
        </div>
        <div class="navbar">
            <nav>
                <ul>
                    <a href="/"><li>Home</li></a>
                    <a href="/"><li>About</li></a>
                    <a href="contact.html"><li class="float-right">Contact Us</li></a>
                </ul>
            </nav>
        </div>
    </div>

            <div class="contactrow">
                <div class="row">

                    <?php
                        require('db.php');
                        // When form submitted, insert values into the database.
                        if (isset($_REQUEST['uname'])) {
                            // removes backslashes
                            $uname = stripslashes($_REQUEST['uname']);
                            //escapes special characters in a string
                            $uname = mysqli_real_escape_string($con, $uname);
                            $email = stripslashes($_REQUEST['email']);
                            $email = mysqli_real_escape_string($con, $email);
                            $msg = stripslashes($_REQUEST['msg']);
                            $msg = mysqli_real_escape_string($con, $msg);
                            $create_datetime = date("Y-m-d H:i:s");
                            $query = "INSERT into `contact` (uname, msg, email, create_datetime) VALUES ('$uname', '" . md5($msg) . "', '$email', '$create_datetime')";
                            $result   = mysqli_query($con, $query);

                            if ($result) {
                                echo "<div class='form'>
                                    <h3>Your message was sent successfully.</h3><br/>
                                    <p class='link'>Click here to <a href='contact.php'> go back on CONTACT page</a></p>
                                    </div>";

                                    if(isset($_POST['submit'])) {
                                        $name = $_POST['uname'];
                                        $email = $_POST['email'];
                                        $Message = $_POST['msg'];
                                        $to = "rohitashsinghcs20@bsacet.org";
                                        $subject="Related to Contact form of E Commerce website";
                                        $headers = "From : ". $email;
                                        $txt = "You have received and email from \n\n Name = ". $name . "\r\n Email = ". $email. "\r\n Message = ". $msg;
                                        mail($to, $subject, $txt, $headers);
                                        // if($email != NULL) {
                                        //     mail($to, $subject, $txt, $headers);
                                        // }
                                        //redirect
                                        header("Location: contact.php");

                                    }

                            } else {
                                echo "<div class='form'>
                                    <h3>Required fields are missing.</h3><br/>
                                    <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                                    </div>";
                            }
                        } else {
                    ?>


                    <div class="formcontainer">
                        <div class="form">
                            <form action="" method="POST">
                                <!-- <label for="name">Name</label> -->
                                <input type="text" name="uname" id="uname" class="inputbox" placeholder="Name">
                                <!-- <label for="email">Email</label> -->
                                <input type="email" name="email" id="email" class="inputbox" placeholder="Email">
                                <textarea name="msg" id="" cols="30" rows="8" placeholder="Message" class="inputbox"></textarea>
                                <input type="submit" name="submit" id="submit" value="Submit" class="inputbox">
                            </form>
                        </div>
                    </div>

                    <?php
                        }
                    ?>

                </div>
            </div>
        </div>
    </div>
    
    
    

    <div class="footer">
        <p class="fcontainer">Copyright &copy; not reserved.</p>
    </div>
</body>
</html>
