
function login() {
    var form = document.getElementById("loginForm");
    if(form.checkValidity() === true) {
        form.onsubmit = function (e) {
            e.preventDefault();
        };
        // Initialize the HTTP request.
        var xhr = new XMLHttpRequest();
        var phpPage = 'login.php';
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        xhr.open("POST", phpPage, true);
        // Track the state changes of the request.

        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            var DONE = 4; // readyState 4 means the request is done.
            var OK = 200; // status 200 is a successful return.
            if (xhr.readyState === DONE) {
                if (xhr.status === OK) {
                    if(xhr.responseText === "") {
                        window.location.href = "index.html"
                    }
                    else {
                        document.getElementById("loginForm").innerHTML = xhr.responseText; // 'This is the returned text.'
                    }
                } else {
                    alert('Error: ' + xhr.statusText); // An error occurred during the request.
                }
            }
        };
        xhr.send("email=" + email + "&" + "password=" + password);
    }


}