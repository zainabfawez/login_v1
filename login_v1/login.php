<?php 

    include "connection.php";

    if (isset($_POST['email']) && isset($_POST['password'])) {
       
        $email = $_POST['email'];
        $password =  hash('sha256', $_POST['password']);

        if (empty($email)) {
            echo("User Name is required");
            exit();

        }else if(empty($password)){
            echo("Password is required");
            exit();

        }else{
            $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $result = mysqli_query($connection, $sql);
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);

                if ($row['email'] === $email && $row['password'] === $password) {
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['username'] = $row['username'];
                    header("Location: home.php");
                    exit();

                }else{
                   echo " Incorrect Email or password. ";
                   echo "</br>";
                   echo '<a href= "index.html"> Back to the main page </a>';
                }

            }else{
                echo " Incorrect Email or password. ";
                echo "</br>";
                echo '<a href= "index.html"> Back to the main page </a>';
            }
        }

    }else{
        header("Location: index.php");
        exit();
    }
?>