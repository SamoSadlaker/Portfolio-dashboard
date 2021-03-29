var password = document.getElementById("passwordForm");
var perror = document.getElementById("error");

password.addEventListener("submit", (e) => {
    e.preventDefault();

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "/core/password.php", true);
    xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    var formdata = new FormData();
    formdata.append("password", document.getElementById("password").value);
    formdata.append("again", document.getElementById("again").value);
    formdata.append("id", document.getElementById("uid").value);

    xmlhttp.onreadystatechange = () => {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var res = JSON.parse(xmlhttp.responseText);

            switch (res.status) {
                case "validate":
                    perror.textContent = "* " + res.message;
                    break;

                case "error":
                    perror.textContent = "";
                    popalert("error", res.message);
                    break;

                case "success":
                    popalert("success", res.message);
                    setTimeout(() => {
                        window.location.replace("/login");
                    }, 8000);

                    break;
            }
        }
    };
    xmlhttp.send(formdata);
});
