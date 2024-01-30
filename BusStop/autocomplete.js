let j_resultsBox = document.querySelector(".result-box");
const inputBox = document.getElementById("input-box");

function handleInput() {
    let result = [];
    let input = inputBox.value;
    console.log("input lenght:", input.length);

    if (input.length) {
        result = availableKeywords.filter((keyword) => {
            return keyword.toLowerCase().includes(input.toLowerCase());
        });
    } else {
        // Display all available values when the input box is empty
        result = availableKeywords.slice();
        console.log("in else block");
        console.log(result);
        
    }

    display(result);

    
}

inputBox.onclick = handleInput;
inputBox.onkeyup = handleInput;

function display(result) {
    console.log("in display block");
    const content = result.map((list) => {
        return "<li onclick=selectInput(this)>" + list + "</li>";
    });
    j_resultsBox.innerHTML = "<ul>" + content.join(' ') + "</ul>";
}

function selectInput(list) {
    inputBox.value = list.innerHTML;
    j_resultsBox.innerHTML = '';
}
