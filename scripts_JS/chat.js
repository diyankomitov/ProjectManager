

function chat_refreshPage(setChatTextAreaBlank, refreshAddUserForm){

    chat_retrieveMessages();
    projects_retrieveProjects();
    projects_retrieveProjectInfo(refreshAddUserForm);

    if(setChatTextAreaBlank)
        document.getElementById("textArea").value = "";
}

//This function runs the chat_sendMessage.php AJAX script.
function chat_sendMessage(passedMessageBody) {

    //If there is a non-empty message sent.
    if(passedMessageBody.trim() !== "") {
        // Initialize the HTTP request.
        var xhr = new XMLHttpRequest();
        var phpPage = 'scripts_AJAX/chat_sendMessage.php';
        var messageBody = 'messageBody=' + passedMessageBody;
        xhr.open('get', phpPage + '?' + messageBody);

        // Track the state changes of the request.
        xhr.onreadystatechange = function () {
            var DONE = 4; // readyState 4 means the request is done.
            var OK = 200; // status 200 is a successful return.
            if (xhr.readyState === DONE) {
                if (xhr.status === OK) {
                    //If all went well, refresh the chat window
                    chat_refreshPage(true, false);
                    document.getElementById("textArea").value = xhr.responseText;
                } else{
                    alert('Error: ' + xhr.status); // An error occurred during the request.
                }
            }
        };
        // Send the request to send-ajax-data.php
        xhr.send(null);
    }
}

//This function runs the chat_retrieveMessages.php AJAX script.
function chat_retrieveMessages() {
    // Initialize the HTTP request.
    var xhr = new XMLHttpRequest();
    var phpPage = 'scripts_AJAX/chat_retrieveMessages.php';
    var dateFrom = 'dateFrom=' + 'dateHere'; //TODO: sort out dates
    var dateUpTo = 'dateUpTo=' + 'dateHere';
    xhr.open('get', phpPage +'?' + dateFrom + '&' + dateUpTo);

    // Track the state changes of the request.
    xhr.onreadystatechange = function () {
        var DONE = 4; // readyState 4 means the request is done.
        var OK = 200; // status 200 is a successful return.
        if (xhr.readyState === DONE) {
            if (xhr.status === OK) {
                //If all went well, change the chat window to the returned html
                document.getElementById("chat").innerHTML = xhr.responseText; // 'This is the returned text.'
            } else {
                alert('Error: ' + xhr.status); // An error occurred during the request.
            }
        }
    };
    // Send the request to send-ajax-data.php
    xhr.send(null);
}