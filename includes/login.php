<?php

require 'connect.php';

$errors = array();
if (isset($_POST['login']))
{
        try {

            $sth = $dbh->prepare("SELECT password, salt, userID FROM members WHERE username = :username");

            $sth->bindParam(':username', $_POST['username']);

            $sth->execute();

            $result = $sth->fetch(PDO::FETCH_ASSOC);

            if(!empty($result)) {
                $salt = $result['salt'];
                $passwordInput = $_POST['password'];

                $password = crypt($passwordInput, $salt);

                $hashedPassword = $result['password'];

                if ($hashedPassword == $password) {
                    $_SESSION['signedin'] = true;
                    $_SESSION['username'] = $_POST['username'];
                    $_SESSION['userid'] = $result['userID'];
                    header('Location: '.$_SERVER['PHP_SELF']);
                } else {
                    $loginError = "Error: The password is incorrect";
                    echo $loginError;
                }
            } else {
                $loginError = "Error: User not found in database";
                echo $loginError;
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

}

?>


<div id='login-content'>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <fieldset class="inputs">
            <input id="username" type="text" name="username" placeholder="Username" required>
            <input id="password" type="password" name="password" placeholder="Password" required>
            <label>
                <a href="../register.php">Not a member yet? Register now!</a>
            </label>
        </fieldset>

        <fieldset id="login-button">
            <input name="login" type="submit" class="submit" value="Log in">
        </fieldset>

    </form>
</div>