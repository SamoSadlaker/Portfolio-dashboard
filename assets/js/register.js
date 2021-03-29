// Register form
var register = document.getElementById("registerForm");
var rerror = document.getElementById("error");

register.addEventListener("submit", (e) => {
    e.preventDefault();

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "/core/register.php", true);
    xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    var formdata = new FormData();
    formdata.append("name", document.getElementById("name").value);
    formdata.append("lastname", document.getElementById("lastname").value);
    formdata.append("username", document.getElementById("username").value);
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
