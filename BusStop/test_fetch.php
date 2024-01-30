<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "qwerty123";
$dbname = "busstop";

$stopAreaFilter = ["e7e9b9b94674c99a2eebcd1cec5a3e59", "8c134198673965ec92644ee9cd9a5bba", "36edeafa025deda530cd260f4f88670f"];
$bus_route_id = [];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

foreach ($stopAreaFilter as $stopArea) {
    // Fetch data from the database for the specified stop_area
    $sql = "SELECT route_short_name FROM routes WHERE route_id = '$stopArea'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $bus_route_id[] = $row['route_short_name'];
        }
    }
}

$conn->close();

$busRouteIds = array_values(array_unique($bus_route_id));
$jsonBusStop = json_encode($busRouteIds, JSON_UNESCAPED_UNICODE);

echo $jsonBusStop;
?>
