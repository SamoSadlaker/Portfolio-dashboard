var login = document.getElementById("loginForm");
var lerror = document.getElementById("error");

login.addEventListener("submit", (e) => {
    e.preventDefault();

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "/core/login.php", true);
    xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    var formdata = new FormData();
    formdata.append("email", document.getElementById("email").value);
    formdata.append("password", document.getElementById("password").value);

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
