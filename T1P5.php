<?php 
if(isset($_POST['submit']))
    {
       if(isset($_POST['degree']))
                        {
                            $degree=$_POST['degree'];
                            echo "Your degree is :".htmlspecialchars($degree);
                        }
                     else
                        {
                             echo "Select Your Degree";
                        }
                   
    }

?>