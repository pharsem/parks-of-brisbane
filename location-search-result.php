<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Location search result</title>

    <?php include 'includes/imports.php';
    include 'includes/mapimports.php';

    require 'includes/connect.php';

    // select all parks and put them into an array
    $sth = $dbh->prepare("SELECT * FROM items");
    $sth->execute();

    $resultArray = [];

    while($result = $sth->fetch(PDO::FETCH_ASSOC)) {

        $singleResult = [
            "id" => $result['itemID'],
            "name" => $result['name'],
            "latitude" => $result['latitude'],
            "longitude" => $result['longitude']
        ];

        array_push($resultArray, $singleResult);
    }

    ?>

    <!-- get the PHP array to javascript by calling json_encode -->
    <script type="text/javascript">
        var locations = (<?php echo json_encode($resultArray); ?>);
    </script>


</head>

<body>

<div id="container">

<?php include 'includes/header.php'; ?>

<div id="content">
	
    <div id="distance-result">
        <h2>Showing the parks within 10 km of you location, up to a maximum of 20 parks</h2>
        
	</div>
    
    <div id="map-result">
    
    </div>
    
</div>

<div id="push"></div>

<?php include 'includes/footer.php' ?>

</div>

</body>
</html>
