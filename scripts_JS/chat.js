

function chat_refreshChat(){
    chat_retrieveMessages();
}

function chat_sendMessage(passedMessageBody) {

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
                    chat_refreshChat();
                } else{
                    alert('Error: ' + xhr.status); // An error occurred during the request.
                }
            }
        };
        // Send the request to send-ajax-data.php
        xhr.send(null);
    }
}

function chat_retrieveMessages() {
    // Initialize the HTTP request.
    var xhr = new XMLHttpRequest();
    var phpPage = 'scripts_AJAX/chat_retrieveMessages.php';
    var dateFrom = 'dateFrom=' + 'dateHere';
    var dateUpTo = 'dateUpTo=' + 'dateHere';
    xhr.open('get', phpPage +'?' + dateFrom + '&' + dateUpTo);

    // Track the state changes of the request.
    xhr.onreadystatechange = function () {
        var DONE = 4; // readyState 4 means the request is done.
        var OK = 200; // status 200 is a successful return.
        if (xhr.readyState === DONE) {
            if (xhr.status === OK) {
                // alert("it worked");
                document.getElementById("chat").innerHTML = xhr.responseText; // 'This is the returned text.'
            } else {
                alert('Error: ' + xhr.status); // An error occurred during the request.
            }
        }
    };
    // Send the request to send-ajax-data.php
    xhr.send(null);
}