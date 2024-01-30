// Autocomplete for the search box
let stop_resultsBox = document.querySelector(".stop_result-box");
const stop_inputBox = document.getElementById("stop_input-box");
const acceptButton = document.querySelector(".search-box button");

acceptButton.addEventListener("click", function () {
    sendData();
});
let availableKeywords1 = [];

function clearInputField() {
    document.getElementById('stop_input-box').value = '';
    document.getElementById('name_input-box').value = '';
}

function sendData() {
    // Get the input value
    clearInputField()
    var resultBoxData = inputBox.value;
    console.log("Input Value:", resultBoxData);
    console.log("Pressed");


    // Make a fetch request
    fetch('fetch_stop_name.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'stop_area=' + encodeURIComponent(resultBoxData),
        
    })
    .then(response => response.json())
    .then(data => {
        console.log('Fetched Data:', data);
        availableKeywords1 = data;
        
        
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function handleInput1() {
    let result = [];
    let input = stop_inputBox.value;
    console.log("input lenght:", input.length);

    if (input.length){
    result = availableKeywords1.filter((keyword)=>{
        return keyword.toLowerCase().includes(input.toLowerCase());
    });
} else {
    // Display all available values when the input box is empty
    result = availableKeywords1.slice();
    console.log("in else block");
    console.log(result);
    
}
    display1(result);



}

stop_inputBox.onclick = handleInput1;
stop_inputBox.onkeyup = handleInput1;

function display1(result){
    console.log("in display block");
    const content = result.map((list)=>{
        return "<li onclick=selectInput1(this)>" + list + "</li>";
    });
    stop_resultsBox.innerHTML = "<ul>" + content.join(' ') + "</ul>";
}
function selectInput1(list){
    stop_inputBox.value = list.innerHTML;
    stop_resultsBox.innerHTML = '';
}





