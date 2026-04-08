<?php 
if(isset($_POST['submit']))
    {
       if(isset ($_POST['gender'])) 
                    {
                        $gender=$_POST['gender'];
                        echo "Your Gender is :".htmlspecialchars($gender);
                    }
                     else
                        {
                             echo "Select Your Gender";
                        }
                   
    }

?>