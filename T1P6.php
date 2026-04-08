<?php 
if(isset($_POST['submit']))
    {
        if(isset($_POST['blood']))
                            {
                                $blood=$_POST['blood'];
                                echo " Your Blood Group is :".htmlspecialchars($blood);
                            }

                     else
                        {
                             echo "Select Your Blood Group";
                        }
                   
    }

?>