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

// Login form
var login = document.getElementById("loginForm");
var error = document.getElementById("error");

if (login && error) {
    login.addEventListener("submit", (e) => {
        e.preventDefault();

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.open("POST", login.getAttribute("action"), true);
        xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");

        var formdata = new FormData();
        formdata.append("email", document.getElementById("email").value);
        formdata.append("password", document.getElementById("password").value);

        xmlhttp.onreadystatechange = () => {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var res = JSON.parse(xmlhttp.responseText);

                console.log(res.status);
                if (res.status == "validate") {
                    error.textContent = "* " + res.message;
                }
                if (res.status == "error") {
                    error.textContent = "";
                    popalert("error", res.message);
                }
                if (res.status == "success") {
                    window.location.replace("/");
                }
            }
        };
        xmlhttp.send(formdata);
    });
}
