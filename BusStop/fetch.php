<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "qwerty123";
$dbname = "busstop";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT stop_area FROM busstops";
$result = $conn->query($sql);

$uniqueStopAreas = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $stopArea = $row['stop_area'];
        
        // Check if the stop area is not already in the array
        if (!in_array($stopArea, $uniqueStopAreas)) {
            $uniqueStopAreas[] = $stopArea;
        }
    }
}
    $jsonStopAreas = json_encode($uniqueStopAreas, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);


    if ($jsonStopAreas === false) {
        // Handle JSON encoding error
        echo "JSON encoding error: " . json_last_error_msg();
    } else {
        echo "let availableKeywords = " . $jsonStopAreas . ";";
    }
    

// Close the connection
$conn->close();
?>
