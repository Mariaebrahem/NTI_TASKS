<?php

include "db.php";
session_start();

include "header.php";

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if(empty($name) || empty($email) || empty($password) || empty($confirmPassword))
    {
        echo "<p class='error'>All fields are required.</p>";
    }
    elseif($password != $confirmPassword)
    {
        echo "<p class='error'>Passwords do not match.</p>";
    }
    else
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users(name,email,password)
                  VALUES('$name','$email','$hashedPassword')";

        $result = mysqli_query($conn,$query);

        if($result)
        {
            $_SESSION['user_id'] = mysqli_insert_id($conn);
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;

            header("Location: home.php");
            exit();
        }
        else
        {
            if(mysqli_errno($conn) == 1062)
            {
                echo "<p class='error'>Email already exists.</p>";
            }
            else
            {
                echo "<p class='error'>Registration failed.</p>";
            }
        }
    }
}

?>

<h2>Register</h2>

<form method="POST">

    <input type="text" name="name" placeholder="Write your name" autocomplete="off"><br><br>

    <input type="email" name="email" placeholder="Write your email" autocomplete="off"><br><br>

    <input type="password" name="password" placeholder="Write your password"><br><br>

    <input type="password" name="confirm_password" placeholder="Confirm your password"><br><br>

    
     <input type="submit" value="register">

</form>

<p class="register-link">
    Already have an account?
    <a href="login.php">Login</a>
</p>

<?php

include "footer.php";

?>