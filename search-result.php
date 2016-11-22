<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Search result</title>

    <?php include 'includes/imports.php'; ?>

</head>

<body>

<div id="container">

<?php include 'includes/header.php'; ?>

<div id="content">

    <div id="text-result">

    <?php
    require 'includes/connect.php';

    if (isset($_POST['search']) || isset($_POST['search_sub'])) {

        try {

            // search by either suburb or text
            if(isset($_POST['search'])) {
                $sth = $dbh->prepare("SELECT * FROM items WHERE name LIKE :name");

                $query = '%' . $_POST['parkname'] . '%';

                $sth->bindParam(':name', $query);
            } else if (isset($_POST['search_sub'])) {
                $sth = $dbh->prepare("SELECT * FROM items WHERE suburb = :suburb");

                $sth->bindParam(':suburb', $_POST['suburb']);
            }

            $sth->execute();

            $resultArray = [];

            // show results
            while($result = $sth->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="search-result">';
                echo '<a href="single-item.php?item-id=' . $result['itemID'] . '">';
                echo '<h1>' . $result['name'] . '</h1>';
                echo '<p>Suburb: ' . $result['suburb'] . '<br>Street: ' . $result['street'] . '</p></a></div>';

                $singleResult = [
                    "id" => $result['itemID'],
                    "name" => $result['name'],
                    "latitude" => $result['latitude'],
                    "longitude" => $result['longitude']
                ];

                array_push($resultArray, $singleResult);
            }
            ?>

            <script type="text/javascript">
                // push results to javascript
                var locations = (<?php echo json_encode($resultArray); ?>);
            </script>

            <?php

            include 'includes/mapimports.php';

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    } else {
        header('Location: search.php');
    }

    ?>

	</div>

    <div id="map-container">
        <div id="map-result"></div>
        <div id="circle-marker"><b>&#8413;</b> = your location</div>
    </div>

</div>
</div>

<div id="push"></div>

<?php include 'includes/footer.php'; ?>

</div>

</body>
</html>
