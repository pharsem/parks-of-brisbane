<?php session_start(); ?>
<html>
<head>
    <title>Admin - Parks of Brisbane</title>

    <?php include 'includes/imports.php'; ?>

</head>

<body>



<div id="container">

    <?php include 'includes/header.php' ?>

    <div id="content">


        <?php

        // Check that the user is actually logged in as an admin user
        if (!isset($_SESSION['signedin'])) {
            echo 'You need to sign in to see this page.';
            exit();
        } else {
            if (!($_SESSION['username'] == 'admin')) {
                echo 'Only site admins may access this page.';
                exit();
            }
        }
        ?>

        <h1>Upload dataset to database</h1>
        <h2>Note: This will delete all current items in the parks table</h2>

        <!-- upload file form -->
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <label for="file">Filename:</label>
            <input type="file" name="csv" id="file"><br>
            <input type="submit" name="submit" value="Submit">
        </form>

        <?php

        require 'includes/connect.php';

        if (isset($_POST['submit'])) {

            // check that a file is uploaded and if it is, check that it's a .csv file
            if ($_FILES["csv"]["error"] > 0) {
                echo "Error: File not uploaded";
            } else {
                if (preg_match('([^\s]+(\.(?i)(csv))$)', $_FILES["csv"]["name"])) {

                    // temporarily store and open the file
                    $file = $_FILES["csv"]["tmp_name"];
                    $handle = fopen($file,"r");

                    $successCount = 0;
                    $failCount = 0;

                    // delete all current items from the table
                    $sth = $dbh->exec("TRUNCATE TABLE  items");

                    // loop through the rows in the file
                    while (($data = fgetcsv($handle, 1000, ",", '"'))) {

                        if (!($data[0] == 'id')) { //avoid that the header is being inserted

                            $sth = $dbh->prepare("INSERT INTO items (itemID, parkCode, name, street, suburb, easting,
                                northing, latitude, longitude) values ('$data[0]','$data[1]','$data[2]',
                                '$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]')");

                            $success = $sth->execute();

                            // keep track of the rows inserted
                            if ($success) {
                                $successCount++;
                            } else {
                                $failCount++;
                            }
                        }

                    }

                    // close the file
                    fclose($handle);

                    // feedback to the user
                    echo "Number of rows successfully imported: " . $successCount . "<br>" .
                            "Number of rows failed: " . $failCount;


                } else {
                    echo "Error: File must be of type .csv";
                }
            }
        }


        ?>

    </div>

    <div id="push"></div>

    <?php include 'includes/footer.php' ?>

</div>

</body>
</html>
