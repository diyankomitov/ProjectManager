function projects_retrieveProjects() {

    // Initialize the HTTP request.
    var xhr = new XMLHttpRequest();
    var phpPage = 'projects_retrieveProjects.php';
    var userId = 'user=2';
    xhr.open('get', phpPage + '?' + userId);

    // Track the state changes of the request.
    xhr.onreadystatechange = function () {
        var DONE = 4; // readyState 4 means the request is done.
        var OK = 200; // status 200 is a successful return.
        if (xhr.readyState === DONE) {
            if (xhr.status === OK) {
                document.getElementById("projects").innerHTML = xhr.responseText; // 'This is the returned text.'
            } else {
                alert('Error: ' + xhr.status); // An error occurred during the request.
            }
        }
    };
    // Send the request to send-ajax-data.php
    xhr.send(null);
}

function projects_createProject() {

    // Initialize the HTTP request.
    var xhr = new XMLHttpRequest();
    var phpPage = 'projects_createProject.php';
    var user = 'user=2';
    var classs = 'class=' + document.getElementById("class").value;
    var project = 'name=' + document.getElementById("name").value;
    var description = 'description=' + document.getElementById("description").value;
    var deadline = 'deadline=' + document.getElementById("deadline").value;
    xhr.open('get', phpPage + '?' + user + '&' + classs + '&' + project + '&' + description + '&' + deadline);

    // Track the state changes of the request.
    xhr.onreadystatechange = function () {
        var DONE = 4; // readyState 4 means the request is done.
        var OK = 200; // status 200 is a successful return.
        if (xhr.readyState === DONE) {
            if (xhr.status === OK) {
                window.location.href = 'index.html';
            } else{
                alert('Error: ' + xhr.status); // An error occurred during the request.
            }
        }
    };
    // Send the request to send-ajax-data.php
    xhr.send(null);
}