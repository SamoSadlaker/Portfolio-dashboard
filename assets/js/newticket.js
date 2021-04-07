// NEW TICKET
const form = document.getElementById("newTicket");
const error = document.getElementById("Error");

form.addEventListener("submit", (e) => {
    e.preventDefault();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "/core/newticket.php", true);
    xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    var formdata = new FormData();
    formdata.append("title", document.getElementById("title").value);
    formdata.append("type", document.getElementById("type").value);
    formdata.append("message", document.getElementById("message").value);

    xmlhttp.onreadystatechange = () => {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var res = JSON.parse(xmlhttp.responseText);

            switch (res.status) {
                case "error":
                    error.textContent = "";
                    popalert("error", res.message);
                    break;
                case "validate":
                    error.textContent = "* " + res.message;
                    break;

                case "success":
                    error.textContent = "";
                    popalert("success", res.message);
                    break;
            }
        }
    };
    xmlhttp.send(formdata);
});
