<?php 
if(isset($_POST['submit']))
    {
         if(isset($_POST['email']))
            {
                $email=$_POST['email'];
                if($email =="")
                    {
                        echo "Email cannot be empty";
                    }
                    else
                        {
                             echo "Your Email Is :".htmlspecialchars($email);
                        }
            }
    }

?>