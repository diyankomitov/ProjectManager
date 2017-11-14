// This is the client-side script.
function chat_sendMessage(passedMessageBody) {
    // Initialize the HTTP request.
    var xhr = new XMLHttpRequest();
    var phpPage = 'chat_sendMessage.php';
    var projectId = 'project=1';
    var userId = 'user=2';
    var messageBody = 'messageBody=' + passedMessageBody;
    xhr.open('get', phpPage +'?' + projectId + '&' + userId + '&' + messageBody);

    // Track the state changes of the request.
    xhr.onreadystatechange = function () {
        var DONE = 4; // readyState 4 means the request is done.
        var OK = 200; // status 200 is a successful return.
        if (xhr.readyState === DONE) {
            if (xhr.status === OK) {
                document.getElementById("chat").innerHTML += xhr.responseText; // 'This is the returned text.'
            } else {
                alert('Error: ' + xhr.status); // An error occurred during the request.
            }
        }
    };
    // Send the request to send-ajax-data.php
    xhr.send(null);
}