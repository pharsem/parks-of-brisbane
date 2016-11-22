<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Advanced search</title>

    <?php include 'includes/imports.php'; ?>

</head>

<body>

<div id="container">

<?php include 'includes/header.php'; ?>

<div id="content">
	<h1>Advanced search</h1>
    <p>Search by entering whatever criterias you have</p>
	<form action="search-result.php" method="post">
        <fieldset class="inputs">
            <select name="suburb">
                <option value="" disabled selected>Choose a suburb</option>

                <?php

                require 'includes/connect.php';

                try {
                    $sth = $dbh->prepare("SELECT suburb FROM items");

                    $sth->execute();

                    $suburbs = array();

                    while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
                        array_push($suburbs, $result['suburb']);
                    }


                    sort($suburbs);

                    $uniqueSuburbs = array_unique($suburbs);

                    foreach($uniqueSuburbs as $suburb) {
                        echo '<option value="' . $suburb . '">' . $suburb . '</option>';
                    }


                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
                ?>
            </select>
        </fieldset>
        <fieldset><input type="submit" class="submit" name="search_sub" value="Search"></fieldset>
    </form>

    <form action="search-result.php" method="post">
        <fieldset class="input">
            <input name="parkname" type="text" placeholder="Enter name of park">
        </fieldset>
    
        <fieldset><input type="submit" class="submit" name="search" value="Search"></fieldset>

    </form>
    <fieldset><input type="button" class="submit" value="Search using your location" onClick="window.location='location-search-result.php';"></fieldset>
	<p>&nbsp;</p>
</div>

<div id="push"></div>

<div id="footer">
    <div id="footerText">
        &copy; Petter Harsem - 8683417 <br />
        Semester 1, 2014 - Assignment 1 <br />
        INB271 - Queensland University of Technology
    </div>
</div>

</div>

</body>
</html>
