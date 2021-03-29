var reset = document.getElementById("resetForm");

reset.addEventListener("submit", (e) => {
    e.preventDefault();

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "/core/reset.php", true);
    xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    var formdata = new FormData();
    formdata.append("email", document.getElementById("email").value);

    xmlhttp.onreadystatechange = () => {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var res = JSON.parse(xmlhttp.responseText);

            switch (res.status) {
                case "error":
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
