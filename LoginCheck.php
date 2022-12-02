<?php
  include "dbcon.php";
  session_start();
  try 
  {
    if (isset($_POST["submit"])) 
    {
        if (empty($_POST["username"]) || empty($_POST["password"])) {
            echo <<<HTML
                 <label> All fields are required </label>
                 HTML;
        }

        else 
        {
            $query="select * from login where username = :username AND password = :password";
            $statement = $conn->prepare($query);
            $statement->execute(

                array(  
                    ':username'     =>     $_POST["username"],  
                    ':password'     =>     $_POST["password"]  
               ) 

            );
        
            $count = $statement->rowCount();
            if($count > 0)
            {   
              echo '<script>alert("login successfully")</script>'; 
                header("location:Dashboard.php");
            }

            else {
                echo <<<HTML
                <label> email or password is incorrect </label>
                HTML;
            }
      }
    }
  } catch (PDOException $e) 
  {
    echo "Connection failed: " . $e->getMessage();
  }
  session_destroy();
?>