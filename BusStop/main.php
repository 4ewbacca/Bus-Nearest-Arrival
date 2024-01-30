<!DOCTYPE html>
<html>
<head>
    <script src="fetch.php" defer></script>

<link rel="stylesheet" href="style_search.css">
<link rel="stylesheet" href="style_bus_stop.css">
<link rel="stylesheet" href="style_bus_name.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.dropbtn {
    background-color: #3498db;
    color: white;
    padding: 10px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}



</style>
</head>
<body style="background-color:grey;"> 
    
<h2>Hoverable Dropdown</h2>
    <div class="search-box" id="search-box1">
            <div class="row">
                <input type="text" id="input-box" placeholder="Region" autocomplete="off">
                <button onclick="sendData()">Accept</button>
            </div>
            <div class="result-box">
                <ul></ul>
            </div>
        </div>

        <!-- Second search box -->
        <div class="stop_search-box" id="search-box2">
            <div class="row1">
                <input type="text" id="stop_input-box" placeholder="Bus Stop" autocomplete="off">
                <button onclick="sendData1();">Accept</button>
            </div>
            <div class="stop_result-box">
                <ul></ul>
            </div>

        </div>

        <!-- Third search box -->
        <div class="name_search-box" id="search-box3">
            <div class="row">
                <input type="text" id="name_input-box" placeholder="Bus" autocomplete="off">
                <button onclick="sendData2()">Accept</button>
            </div>
            <div class="name_result-box">
                <ul></ul>
            </div>
        </div>
    </div>




</div>
<script src="autocomplete.js" defer></script>
<script src="autocomplete_bus_stop.js" defer></script>
<script src="autocomplete_bus_name.js" defer></script>
<script src="bus_time.js" defer></script>

</body>
</html>
