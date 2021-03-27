// Popalert
function popalert(type, message) {
    var icon = "info";

    if (type == "success") {
        icon = "check";
    }
    if (type == "error") {
        icon = "error";
    }

    var alert = `<div id="alert" class="alert-${type}"><i class='bx bxs-${icon}-circle'></i>${message}</div>`;

    // $("main").append(alert);
    document.body.innerHTML += alert;

    setTimeout(() => {
        document.getElementById("alert").remove();
    }, 8000);
}

function getLoginData() {
    var formdata = new FormData();
    formdata.append("email", document.getElementById("email").value);
    formdata.append("password", document.getElementById("password").value);
    return formdata;
}

function getRegistrationData() {
    var formdata = new FormData();
    formdata.append("name", document.getElementById("name").value);
    formdata.append("lastname", document.getElementById("lastname").value);
    formdata.append("username", document.getElementById("username").value);
    formdata.append("email", document.getElementById("email").value);
    formdata.append("password", document.getElementById("password").value);
    return formdata;
}

// Sidebar
var sidebar = document.getElementById("Sidebar");
var menu = document.getElementById("menu");
var main = document.getElementById("Main");

if (menu && sidebar && main) {
    menu.addEventListener("click", () => {
        sidebar.classList.toggle("mini");
        main.classList.toggle("max");
    });
}

// Formfix
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

// Time
var time = document.getElementById("time");
if (time) {
    setInterval(() => {
        var date = new Date();
        time.innerText = date.getHours() + ":" + date.getMinutes();
    }, 40);
}

// Login form
var login = document.getElementById("loginForm");
var lerror = document.getElementById("error");

if (login && lerror) {
    login.addEventListener("submit", (e) => {
        e.preventDefault();

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "/core/login.php", true);
        xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");

        var formdata = getLoginData();

        xmlhttp.onreadystatechange = () => {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var res = JSON.parse(xmlhttp.responseText);

                switch (res.status) {
                    case "validate":
                        lerror.textContent = "* " + res.message;
                        break;

                    case "error":
                        lerror.textContent = "";
                        popalert("error", res.message);
                        break;

                    case "success":
                        window.location.replace("/");
                        break;
                }
            }
        };
        xmlhttp.send(formdata);
    });
}

// Register form
var register = document.getElementById("registerForm");
var rerror = document.getElementById("error");

if (register && rerror) {
    register.addEventListener("submit", (e) => {
        e.preventDefault();

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", "/core/register.php", true);
        xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");

        var formdata = getRegistrationData();

        xmlhttp.onreadystatechange = () => {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var res = JSON.parse(xmlhttp.responseText);

                switch (res.status) {
                    case "validate":
                        lerror.textContent = "* " + res.message;
                        break;

                    case "error":
                        lerror.textContent = "";
                        popalert("error", res.message);
                        break;

                    case "success":
                        window.location.replace("/");
                        break;
                }
            }
        };
        xmlhttp.send(formdata);
    });
}
