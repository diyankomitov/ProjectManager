function register() {
    var form = document.getElementById("registerForm");
    if(form.checkValidity() === true) {
        form.onsubmit = function (e) {
            e.preventDefault();
        };
        // Initialize the HTTP request.
        var xhr = new XMLHttpRequest();
        var phpPage = 'register.php';

        var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var uni = document.getElementById("uni").value;
        var course = document.getElementById("course").value;

        xhr.open("POST", phpPage, true);
        // Track the state changes of the request.

        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            var DONE = 4; // readyState 4 means the request is done.
            var OK = 200; // status 200 is a successful return.
            if (xhr.readyState === DONE) {
                if (xhr.status === OK) {
                    if(xhr.responseText.trim() === "") {
                        window.location.href = "login.html?registered=true"
                    }
                    else {
                        document.getElementById("registerForm").innerHTML = xhr.responseText; // 'This is the returned text.'
                    }
                } else {
                    alert('Error: ' + xhr.statusText); // An error occurred during the request.
                }
            }
        };
        xhr.send("name=" + name + "&" + "email=" + email + "&" + "password=" + password + "&" + "uni=" + uni + "&" + "course=" + course);
    }
}