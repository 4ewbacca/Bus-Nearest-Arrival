const bus_sname_inputBox = document.querySelector("#name_input-box");

acceptButton2.addEventListener("click", function () {
    sendData2();
});

function sendData2() {
    var resultBoxData = bus_sname_inputBox.value;
    console.log("Result:", resultBoxData);

    // Find the index of resultBoxData in availableKeywords2
    var index = availableKeywords2.indexOf(resultBoxData);

    // Check if the value was found in availableKeywords2
    if (index !== -1) {
        // Display the corresponding value from availableKeywords3
        var correspondingValue = availableKeywords3[index];
        console.log("Corresponding Value:", correspondingValue);
    } else {
        console.log("Value not found in availableKeywords2");
    }

    console.log("availableKeywords2:", availableKeywords2);
    console.log("availableKeywords3:", availableKeywords3);
}


//var now = new Date();
//var datetime = now.toLocaleTimeString();
// Insert date and time into HTML
//console.log(datetime);
//document.getElementById("datetime").innerHTML = datetime;
