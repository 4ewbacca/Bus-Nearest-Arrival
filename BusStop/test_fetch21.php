<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "qwerty123";
$dbname = "busstop";


// Check if a stop_area is provided in the request
if (true) {
    $stopAreaFilter = "Kreenholmi keskus";
    $stopAreaFilter1 = "9c20fa132e25507a14cabd12ae542964";
    //if (isset($_POST['stop_area'])) {
    //$stopAreaFilter = $_POST['stop_area'];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data from the database for the specified stop_area
    $sql = "SELECT stop_id FROM busstops WHERE stop_name = '$stopAreaFilter'";
    $result = $conn->query($sql);

    $busStops_id = array();
    while ($row = $result->fetch_assoc()) {
        $busStopId = $row['stop_id'];
    }

    // ...

    if ($result->num_rows > 0) {
        // Initialize an associative array to store results for each bus stop based on trip_id
        $resultArrays = [];

        // Fetch bus_ids in batches for the current bus stop
        $sql = "SELECT trip_id FROM stop_times WHERE stop_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $busStopId);
        $stmt->execute();
        $stmt->bind_result($busId);

        $busIdsForBusStop = []; // Create a separate array for each bus stop

        while ($stmt->fetch()) {
            $busIdsForBusStop[] = $busId;
        }

        $stmt->close();

        // Separate the results based on the values of trip_id
        foreach ($busIdsForBusStop as $busId) {
            // Determine the result array based on the trip_id value
            if (!isset($resultArrays[$busId])) {
                $resultArrays[$busId] = [];
            }
            $resultArrays[$busId][$busStopId][] = $busId;
        }
    }

    // Now $resultArrays contains the desired structure

    // $resultArrays now contains separate arrays for each $busstopId
    // Access them using $resultArrays[$busstopId]

    // Do something with $busStops and $zoneIds arrays

    // ...

    // Convert the array to JSON
    $uniqueBusStops = array_values(array_unique($busStops_id));
    $jsonBusStops = json_encode($uniqueBusStops, JSON_UNESCAPED_UNICODE);
    echo $jsonBusStops;

    // Unique values from $resultArrays
    //$uniqueResultArrays = array_map("unserialize", array_unique(array_map("serialize", $resultArrays)));
    //$jsonResultArrays = json_encode($uniqueResultArrays, JSON_UNESCAPED_UNICODE);
    //echo $jsonResultArrays;

    //$busStops = array_values(array_unique($zoneIds));
    //$jsonBusStops = json_encode($busStops, JSON_UNESCAPED_UNICODE);

    //echo $jsonBusStops;

    // Close the connection
    $conn->close();
} else {
    echo "Please provide a stop_area parameter.";
}
?>
