<?php
session_start();
if(isset($_POST['submit']))
    {
        $name =$_POST['name'];
        $email =$_POST['email'];
        $username =$_POST['username'];
        $password =$_POST['password'];
        if($name ==""|| $email =="" || $username =="" || $password =="")
            {
                echo "All Filds Shouldbe filled";
            }
            else
                {
                  $_SESSION['users'][$username.'_name']     = htmlspecialchars($name);
                  $_SESSION['users'][$username.'_email']    = htmlspecialchars($email);
                  $_SESSION['users'][$username.'_password'] = $password;
                   echo "Registration Is Successfull";
                   echo"your Email is".htmlspecialchars($email);
                   
                }
    }
    ?>
    <form method="post">
        Name : <input type="text" name="name"><br>
        Email : <input type="email" name ="email"><br>
        Username : <input type="text" name="username"><br>
        Password : <input type ="password" name = "password"><br>
        Gender : <select name="gender">
            <option>Male</option>
            <option>Female</option>
            <option>Other</option>
        </select><br>
        DOB : <input type="date" name="dob"><br>
        <input type ="submit" name ="submit" value="Register">
    </form>