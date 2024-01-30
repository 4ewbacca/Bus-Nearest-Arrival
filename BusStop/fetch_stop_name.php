<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "qwerty123";
$dbname = "busstop";


// Check if a stop_area is provided in the request
//if (true) {
    //$stopAreaFilter = "Narva linn";
if(isset($_POST['stop_area'])) {
    $stopAreaFilter = $_POST['stop_area'];
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the database for the specified stop_area
    $sql = "SELECT stop_name FROM busstops WHERE stop_area = '$stopAreaFilter'";
    $result = $conn->query($sql);

    $busStops = array();

    // ...

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $busStops[] = $row['stop_name'];
    }

    // Convert the array to JSON
    $busStops = array_values(array_unique($busStops));
    $jsonBusStops = json_encode($busStops, JSON_UNESCAPED_UNICODE);

    echo $jsonBusStops;
} else {
    echo "No bus stops found for the specified stop area.";
}

// ...

    // Close the connection
    $conn->close();
} else {
    echo "Please provide a stop_area parameter.";
}
?>
