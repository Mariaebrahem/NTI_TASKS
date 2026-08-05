<?php
include "header.php";

session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: login.php");
    exit();
}

$message = "";

if(isset($_SESSION['success_message']))
{
    $message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}

?>



    <?php
    if($message != "")
    {
        echo "<p class='success'>$message</p>";
    }
    ?>

    <h2>
        Welcome 
        <?php echo $_SESSION['user_name']; ?>
    </h2>

    <h3>User Information</h3>

    <p>
        <strong>Name:</strong>
        <?php echo $_SESSION['user_name']; ?>
    </p>

    <p>
        <strong>Email:</strong>
        <?php echo $_SESSION['user_email']; ?>
    </p>

    <a href="logout.php">Logout</a>

<?php
include "header.php";
?>