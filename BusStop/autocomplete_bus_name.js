// Autocomplete for the search box
let name_resultsBox = document.querySelector(".name_result-box");
const name_inputBox = document.getElementById("name_input-box");
const acceptButton1 = document.querySelector(".stop_search-box button");

acceptButton1.addEventListener("click", function () {
    sendData1();
});
let availableKeywords2 = [];
let availableKeywords3 = [];

function clearInputField1() {
    
    document.getElementById('name_input-box').value = '';
}


function sendData1() {
    // Get the input value
    clearInputField1()
    var resultBoxData = stop_inputBox.value;
    console.log("Input Value:", resultBoxData);
    console.log("Pressed");


   fetch('fetch_bus_info.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: 'stop_name=' + encodeURIComponent(resultBoxData),
})
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            console.error('Error:', data.error);
        } else {
            // Extract availableKeywords2 and availableKeywords3 from the response
            availableKeywords2 = data.availableKeywords3;
            availableKeywords3 = data.availableKeywords2;
            availableKeywords2 = JSON.parse(availableKeywords2);
            availableKeywords3= JSON.parse(availableKeywords3);

            console.log('Parsed Data for availableKeywords2:', availableKeywords2);
            console.log('Parsed Data for availableKeywords3:', availableKeywords3);

            // Handle the response data for autocomplete
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });

}


function handleInput2() {
    let input = name_inputBox.value.toLowerCase();
    let result = [];
    console.log("Is array",Array.isArray(availableKeywords2));
    console.log("Is type ",typeof availableKeywords2);

    if (input.length){
    // Show suggestions for all availableKeywords2
    result = availableKeywords2.filter((keyword) => {
        return keyword.toLowerCase().includes(input);
    });
    } else {
    // Display all available values when the input box is empty
    result = availableKeywords2.slice();
    console.log("in else block");
    console.log(result);
}
    display2(result);



}

name_inputBox.onclick = handleInput2;
name_inputBox.onkeyup = handleInput2;

function display2(result){
    const content = result.map((list)=>{
        return "<li onclick=selectInput2(this)>" + list + "</li>";
    });
    name_resultsBox.innerHTML = "<ul>" + content.join(' ') + "</ul>";
}
function selectInput2(list){
    name_inputBox.value = list.innerHTML;
    name_resultsBox.innerHTML = '';
}