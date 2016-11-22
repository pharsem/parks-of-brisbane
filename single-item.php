<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Show single park - Parks of Brisbane</title>

    <?php include 'includes/imports.php';
    include 'includes/mapimports.php'; ?>


</head>

<body>

<div id="container">

    <?php include 'includes/header.php' ?>

    <div id="content">

        <?php

        require 'includes/connect.php';

        $resultArray = [];

        // getting all the stuff from the database
        try {
            $sth1 = $dbh->prepare("SELECT * FROM items WHERE itemID = :id");

            $sth1->bindParam(':id', $_GET['item-id']);

            $sth1->execute();

            $item = $sth1->fetch(PDO::FETCH_ASSOC);

            $singleResult = [
                "id" => $item['itemID'],
                "name" => $item['name'],
                "latitude" => $item['latitude'],
                "longitude" => $item['longitude']
            ];

            array_push($resultArray, $singleResult);



            $sth2 = $dbh->prepare("SELECT * FROM reviews WHERE itemID = :id");

            $sth2->bindParam(':id', $_GET['item-id']);

            $sth2->execute();

            $rating = 0;
            $numRatings = 0;
            $users = [];

            while($ratings = $sth2->fetch(PDO::FETCH_ASSOC)) {
                $rating += $ratings['stars'];
                $numRatings++;

                $sth3 = $dbh->prepare("SELECT * FROM members WHERE userID = :id");

                $sth3->bindParam(':id', $ratings['userID']);

                $sth3->execute();

                $user = $sth3->fetch(PDO::FETCH_ASSOC);

                array_push($users, $user['username']);

            }

            if($numRatings > 0) {
                $rating = round($rating / $numRatings);
            }



        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        ?>

        <script type="text/javascript">
            var locations = (<?php echo json_encode($resultArray); ?>);
        </script>

        // listing item info and reviews
        <div id="item-description">
            <h1><?php echo $item['name'];?></h1>
            <div id="map-single-item"></div>
            <p>
                Suburb: <?php echo $item['suburb'];?><br />
                Street: <?php echo $item['street'];?><br />
                Rating: <?php
                if($numRatings > 0) {
                    echo str_repeat('&#9733;', $rating) . str_repeat('&#9734;', (5 - $rating));
                } else {
                    echo "<i>This park hasn't received any ratings yet</i>";
                }
                ?>
            </p>

        </div>

        <div>
            <h1>User reviews</h1>
            <a id="review-link" href="add-review.php?item-id=<?php echo $_GET['item-id'];?>">Add a new review</a><hr>

            <?php


            $sth2->execute();
            $i = 0;

            while($reviews = $sth2->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="single-review"><p>';
                echo 'Time: ' . $reviews['datestamp'] . '<br />';
                echo 'User: ' . $users[$i] . '<br />';
                echo 'Rating: ' . str_repeat('&#9733;', $reviews['stars']) . str_repeat('&#9734;', (5 - $reviews['stars']));
                echo '</p><p>' . $reviews['text'] . '</p></div><hr>';

                $i++;

            }

            ?>

        </div>



    </div>

    <div id="push"></div>

    <?php include 'includes/footer.php' ?>

</div>

</body>
</html>
