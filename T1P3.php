<?php 
if(isset($_POST['submit']))
    {
        if(isset($_POST['day']) && isset($_POST['month']) && isset($_POST['year']))
                {
                    $day=$_POST['day'];
                    $month=$_POST['month'];
                    $year=$_POST['year'];
                    if($day=="" || $month=="" || $year=="")
                        {
                            echo "Date Of Birth Cannot be Empty";
                        }
                        else
                            {
                                echo "Your Date of Birth is :";
                            }
                       

                }
    }

?>