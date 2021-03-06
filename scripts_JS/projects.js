
//This function runs the projects_retrieveProjects.php AJAX script.
function projects_retrieveProjects() {

    // Initialize the HTTP request.
    var xhr = new XMLHttpRequest();
    var phpPage = 'scripts_AJAX/projects_retrieveProjects.php';
    xhr.open('get', phpPage);

    // Track the state changes of the request.
    xhr.onreadystatechange = function () {
        var DONE = 4; // readyState 4 means the request is done.
        var OK = 200; // status 200 is a successful return.
        if (xhr.readyState === DONE) {
            if (xhr.status === OK) {
                //If all went well, change the projects nav to the returned html
                document.getElementById("projects").innerHTML = xhr.responseText; // 'This is the returned text.'
            } else {
                alert('Error: ' + xhr.status); // An error occurred during the request.
            }
        }
    };
    // Send the request to send-ajax-data.php
    xhr.send(null);
}

//This function runs the projects_createProjects.php AJAX script.
function projects_createProject() {
    var form = document.getElementById("createProjectForm");
    if(form.checkValidity() === true) {
        form.onsubmit = function (e) {
            // alert("preventing submit");
            e.preventDefault();
        };
        // Initialize the HTTP request.
        var xhr = new XMLHttpRequest();
        var phpPage = 'scripts_AJAX/projects_createProject.php';
        var classs = "class=" + document.getElementById("class").value;
        var project = "name=" + document.getElementById("name").value;
        var description = "description=" + document.getElementById("description").value;
        var deadline = "deadline=" + document.getElementById("deadline").value;
        xhr.open('POST', phpPage, true);
        // alert(classs + '&' + project + '&' + description + '&' + deadline);

        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // Track the state changes of the request.
        xhr.onreadystatechange = function () {
            var DONE = 4; // readyState 4 means the request is done.
            var OK = 200; // status 200 is a successful return.
            if (xhr.readyState === DONE) {
                if (xhr.status === OK) {
                    // If all went well, return to the main page and change to the newly created project.
                    location.hash = "#";
                    projects_openProject(xhr.responseText);
                    // alert(xhr.responseText)
                } else{
                    alert('Error: ' + xhr.status); // An error occurred during the request.
                }
            }
        };
        // Send the request to send-ajax-data.php
        xhr.send(classs + "&" + project + "&" + description + "&" + deadline);
    }

}

//This function runs the projects_openProject.php AJAX script.
function projects_openProject(projectId){
    var xhr = new XMLHttpRequest();
    var phpPage = 'scripts_AJAX/projects_setCurrentProject.php';
    var id = 'id=' + projectId;
    xhr.open('get', phpPage + '?' + id);

    // Track the state changes of the request.
    xhr.onreadystatechange = function () {
        var DONE = 4; // readyState 4 means the request is done.
        var OK = 200; // status 200 is a successful return.
        if (xhr.readyState === DONE) {
            if (xhr.status === OK) {
                //If all went well, refresh the chat so that the new project is shown
                chat_refreshPage(true, true);
            } else{
                alert('Error: ' + xhr.status); // An error occurred during the request.
            }
        }
    };
    // Send the request to send-ajax-data.php
    xhr.send(null);
}

//This function runs the projects_retrieveProjectInfo.php AJAX script.
function projects_retrieveProjectInfo(refreshButtons){
    // Initialize the HTTP request.
    var xhr = new XMLHttpRequest();
    var phpPage = 'scripts_AJAX/projects_retrieveProjectInfo.php';
    xhr.open('get', phpPage);

    // Track the state changes of the request.
    xhr.onreadystatechange = function () {
        var DONE = 4; // readyState 4 means the request is done.
        var OK = 200; // status 200 is a successful return.
        if (xhr.readyState === DONE) {
            if (xhr.status === OK) {
                //If all went well, set the aside to the returned html
                var infoArray = JSON.parse(xhr.responseText);
                if(refreshButtons) document.getElementById("info_buttons").innerHTML = infoArray[0];
                document.getElementById("info_info").innerHTML = infoArray[1];
                projects_getUsersInProject();
            } else {
                alert('Error: ' + xhr.status); // An error occurred during the request.
            }
        }
    };
    // Send the request to send-ajax-data.php
    xhr.send(null);
}

// This function runs the projects_getUsersInProject.php AJAX script
function projects_getUsersInProject() {
    // Initialize the HTTP request.
    var xhr = new XMLHttpRequest();
    var phpPage = 'scripts_AJAX/projects_getUsersInProject.php';
    xhr.open('get', phpPage);

    // Track the state changes of the request.
    xhr.onreadystatechange = function () {
        var DONE = 4; // readyState 4 means the request is done.
        var OK = 200; // status 200 is a successful return.
        if (xhr.readyState === DONE) {
            if (xhr.status === OK) {
                //If all went well, return the response html
                document.getElementById("info_users").innerHTML = xhr.responseText;
            } else {
                alert('Error: ' + xhr.status); // An error occurred during the request.
            }
        }
    };
    // Send the request to send-ajax-data.php
    xhr.send(null);

}

function projects_addUser(email) {

    //If the email is non-empty.
    if(email.trim() !== "") {
        // Initialize the HTTP request.
        var xhr = new XMLHttpRequest();
        var phpPage = 'scripts_AJAX/projects_addUser.php';
        var email = 'email=' + email;
        xhr.open('get', phpPage + '?' + email);

        // Track the state changes of the request.
        xhr.onreadystatechange = function () {
            var DONE = 4; // readyState 4 means the request is done.
            var OK = 200; // status 200 is a successful return.
            if (xhr.readyState === DONE) {
                if (xhr.status === OK) {
                    //If all went well, retrieve the projectInfo
                    projects_retrieveProjectInfo(true);
                    document.getElementById('info_error').innerHTML = xhr.responseText;
                } else {
                    alert('Error: ' + xhr.status); // An error occurred during the request.
                }
            }
        };
        // Send the request to send-ajax-data.php
        xhr.send(null);
    }
}

function projects_removeUserFromProject(userId) {
    // Initialize the HTTP request.
    var xhr = new XMLHttpRequest();
    var phpPage = 'scripts_AJAX/projects_removeUserFromProject.php';
    var user = 'user=' + userId;
    xhr.open('get', phpPage + '?' + user);

    // Track the state changes of the request.
    xhr.onreadystatechange = function () {
        var DONE = 4; // readyState 4 means the request is done.
        var OK = 200; // status 200 is a successful return.
        if (xhr.readyState === DONE) {
            if (xhr.status === OK) {
                //If all went well, refresh the page
                chat_refreshPage(false, false);
            } else {
                alert('Error: ' + xhr.status); // An error occurred during the request.
            }
        }
    };
    // Send the request to send-ajax-data.php
    xhr.send(null);
}

