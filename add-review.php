
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add new review</title>

    <?php include 'includes/imports.php';?>

</head>

<body>

<div id="container">

    <?php include 'includes/header.php'; ?>

<div id="content">

    <?php

    //Check that user is logged in
    if(!(isset($_SESSION['signedin'])) || !($_SESSION['signedin'])) {
        echo '<p>You have to be logged in to write reviews. Log in from the top menu or <a href="register.php">register</a> now.';
        exit();
    }


    // if form is submitted
    if (isset($_POST['submit']))
    {

        require 'includes/connect.php';

        //insert into the database
        try {
            $sth = $dbh->prepare("INSERT INTO reviews (userID, itemID, stars, text)
                            VALUES (:userID, :itemID, :stars, :text)");

            $sth->bindParam(':userID', $_SESSION['userid']);
            $sth->bindParam(':itemID', $_GET['item-id']);
            $sth->bindParam(':stars', $_POST['rating']);
            $sth->bindParam(':text', $_POST['text']);

            $success = $sth->execute();

            if ($success) {

                echo "<script type='text/javascript'>alert('Review successfully added')
                        window.location = 'single-item.php?item-id=" . $_GET['item-id'] . "';</script>";
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    ?>

	<h1>Register as a user to review parks</h1>

    <div id="error"></div>

    <!-- form to enter the review -->
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <fieldset class="inputs">

            <select required="true" name="rating">
                <option value="0" disabled selected="true">Select a rating</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select><br>

            <textarea required="true" rows="10" cols="80" name="text" placeholder="Write your review..."></textarea>
        </fieldset>
        <fieldset>
            <input name="submit" type="submit" class="submit" value="Submit"/>
        </fieldset>
    </form>


</div>



<div id="push"></div>

    <?php include 'includes/footer.php'; ?>

</div>

</body>
</html>
