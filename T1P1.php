<?php 
if(isset($_POST['submit']))
    {
        if(isset($_POST['name']))
            {
                $name=$_POST['name'];
                if($name =="")
                    {
                        echo "Name cannot be empty";
                    }
                    else
                        {
                             echo "Your name Is :".htmlspecialchars($name);
                        }
            }
    }

?>