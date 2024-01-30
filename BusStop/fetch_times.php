<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "qwerty123";
$dbname = "busstop";

if (true){
    $stopAreaFilter = "9c20fa132e25507a14cabd12ae542964";


    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT trip_id FROM trips WHERE route_id = '$stopAreaFilter'";
    $stmt = $conn->prepare($sql);
    $result = $conn->query($sql);
    $busRouteId = array();


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $busTripId[] = $row['trip_id'];
        }
    }
    $stmt->close();
    
    
    $timeIds = array();
    
    foreach ($busTripId as $tripId) {

        $sql = "SELECT departure_time FROM stop_times WHERE trip_id = ? AND stop_id = '20882'";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $tripId);
        $stmt->execute();
        $stmt->bind_result($timeId);
    
        while ($stmt->fetch()) {
            $timeIds[] = $timeId;
        }
        $stmt->close();
    
    




    

        
    
       
}
$busStops = array_values(array_unique($timeIds));
$jsonBusStops = json_encode($busStops, JSON_UNESCAPED_UNICODE);
echo $jsonBusStops;

$busStops = array_values(array_unique($busTripId));
$jsonBusStops = json_encode($busStops, JSON_UNESCAPED_UNICODE);
//echo $jsonBusStops;
}
?>