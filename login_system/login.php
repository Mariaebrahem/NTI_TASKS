<?php

include "db.php";


session_start();

$message = "";

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email) || empty($password))
    {
        $message = "<p class='error'>All fields are required</p>";
    }
    else
    {
        $query = "SELECT * FROM users WHERE email='$email'";

        $result = mysqli_query($conn, $query);

        $user = mysqli_fetch_assoc($result);

        if($user && password_verify($password, $user['password']))
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            header("Location: home.php");
            exit();
        }
        else
        {
            $message = "<p class='error'>Invalid email or password.</p>";
        }
    }
}

?>

<?php
include "header.php";
?>

<h2>Login</h2>

<?php echo $message; ?>

<form method="POST">

    <label>Email</label><br>
    <input type="email" name="email" placeholder="Enter your email" autocomplete="off"><br><br>

    <label>Password</label><br>
    <input type="password" name="password" placeholder="Enter your password"><br><br>

    <input type="submit" value="Login">

    <p class="register-link">
        Don't have an account?
        <a href="register.php">Register</a>
    </p>

</form>
<?php  include "footer.php";
?>
