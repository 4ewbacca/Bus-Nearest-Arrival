<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "qwerty123";
$dbname = "busstop";


//if(isset($_POST['bus_stop'])) {
//    $stopAreaFilter = $_POST['bus_stop'];
//if(true) {
if(isset($_POST['stop_name'])) {
    $stopAreaFilter = $_POST['stop_name'];
    //$stopAreaFilter = 'Mäepealse';
    
    // Create a single database connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    
    $sql = "SELECT stop_id FROM busstops WHERE stop_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $stopAreaFilter);
    $stmt->execute();
    $stmt->bind_result($stopId);
    
    $busStopIds = array();
    
    while ($stmt->fetch()) {
        $busStopIds[] = $stopId;
    }
    
    $stmt->close();
    
    $busIds = array();
    $busRouteIds = array();
    
    foreach ($busStopIds as $stopId) {
        
        $sql = "SELECT trip_id FROM stop_times WHERE stop_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $stopId);
        $stmt->execute();
        $stmt->bind_result($busId);
    
        while ($stmt->fetch()) {
            $busIds[] = $busId;
        }
    
        $stmt->close();
    
        
        $sql = "SELECT route_id FROM trips WHERE trip_id IN (" . implode(',', array_fill(0, count($busIds), '?')) . ")";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(str_repeat("i", count($busIds)), ...$busIds);
        $stmt->execute();
        $stmt->bind_result($routeId);
    
        while ($stmt->fetch()) {
            $busRouteIds[] = $routeId;
        }
    
        $stmt->close();
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
}

        foreach ($busRouteIds as $stopArea) {
    
            $sql = "SELECT route_short_name FROM routes WHERE route_id = '$stopArea'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $bus_route_id[] = $row['route_short_name'];
        }
    }
}

    }

    
    $conn->close();


    
    $busRouteIds = array_values(array_unique( $busRouteIds));
    $jsonBusStop2 = json_encode( $busRouteIds, JSON_UNESCAPED_UNICODE);
 

   

    $busRouteIds = array_values(array_unique( $bus_route_id));
    $jsonBusStop3 = json_encode( $busRouteIds, JSON_UNESCAPED_UNICODE);

    
    if ($jsonBusStop2 === false || $jsonBusStop3 === false) {
        // Handle JSON encoding
        echo json_encode(['error' => 'JSON encoding error: ' . json_last_error_msg()]);
    } else {
        
        echo json_encode(['availableKeywords2' => $jsonBusStop2, 'availableKeywords3' => $jsonBusStop3]);
    }


}



?>