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
var navvar = document.getElementById("navbar");

if (menu && sidebar && main && navbar) {
    menu.addEventListener("click", () => {
        sidebar.classList.toggle("sidebar-mini");
        main.classList.toggle("max");
        navbar.classList.toggle("max");
        // console.log(sidebar.classList.value.split(" ")[1]);
    });
}

// Time
var time = document.getElementById("time");
if (time) {
    setInterval(() => {
        var date = new Date();
        time.innerText = date.getHours() + ":" + date.getMinutes();
    }, 40);
}

// Formfix
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
