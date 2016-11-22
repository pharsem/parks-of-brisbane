<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register</title>

    <?php include 'includes/imports.php';?>

</head>

<body>



<div id="container">

    <?php include 'includes/header.php'; ?>

<div id="content">

    <?php

    if (isset($_POST['register']))
    {
        require 'includes/validate.php';

        $errors = array();

        // server side validation
        validateEmail($errors, $_POST, 'email');
        validateUsername($errors, $_POST, 'username');
        validatePassword($errors, $_POST, 'pwd1');
        matchPasswords($errors, $_POST, 'pwd1', 'pwd2');


        if (!$errors) {

            // generate salt and encrypt password
            $salt = uniqid(mt_rand(), false);
            $password = crypt($_POST['pwd1'], $salt);

            $dob = $_POST['dob_day'] . "-" . $_POST['dob_month'] . "-" . $_POST['dob_year'];

            // insert into the database
            try {
                $sth = $dbh->prepare("INSERT INTO members (username, email, dob, gender, password, salt)
                                VALUES (:username, :email, :dob, :gender, '$password', '$salt')");

                $sth->bindParam(':username', $_POST['username']);
                $sth->bindParam(':email', $_POST['email']);
                $sth->bindParam(':dob', $dob);
                $sth->bindParam(':gender', $_POST['gender']);

                $success = $sth->execute();

                if ($success) {

                    echo "<script type='text/javascript'>alert('User registered successfully, you can now log in')
                window.location = 'index.php';</script>";
                }

            } catch (PDOException $e) {
                echo $e->getMessage();
            }

        }
    }

    ?>

	<h1>Register as a user to review parks</h1>

    <div id="error"></div>

    <!-- making the form for registering as a user -->
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" onSubmit="return validateForm(this)">
        <fieldset class="inputs">

            <?php

            require('includes/fields.php');
            input_field($errors, 'username', 'Username');
            input_field($errors, 'email', 'Email');
            password_field($errors, 'pwd1', 'Password');
            password_field($errors, 'pwd2', 'Repeat password');

            ?>

            <h2>Additional information (not required)</h2>
            <?php date_field($errors, 'dob', 'Date of birth: '); ?>
            <div class="field">
                Male <input name="gender" type="radio" id="male" value="Male"/>
                Female <input name="gender" type="radio" id="female" value="Female"/>
            </div>
        </fieldset>
        <fieldset>
            <input name="register" type="submit" class="submit" value="Register"/>
        </fieldset>
    </form>


</div>

<div id="push"></div>

    <?php include 'includes/footer.php'; ?>

</div>

</body>
</html>
