// UPDATE PASSWORD
const passwordlForm = document.getElementById("updatePassword");
const pError = document.getElementById("pError");

passwordlForm.addEventListener("submit", (e) => {
    e.preventDefault();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "/core/updatepass.php", true);
    xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    var formdata = new FormData();
    formdata.append("old", document.getElementById("oPassword").value);
    formdata.append("password", document.getElementById("pPassword").value);
    formdata.append("again", document.getElementById("pPasswordAgain").value);

    xmlhttp.onreadystatechange = () => {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var res = JSON.parse(xmlhttp.responseText);

            switch (res.status) {
                case "error":
                    pError.textContent = "";
                    popalert("error", res.message);
                    break;
                case "validate":
                    pError.textContent = "* " + res.message;
                    break;

                case "success":
                    pError.textContent = "";
                    popalert("success", res.message);
                    break;
            }
        }
    };
    xmlhttp.send(formdata);
});

// UPDATE EMAIL
const emailForm = document.getElementById("updateEmail");
const eError = document.getElementById("eError");

emailForm.addEventListener("submit", (e) => {
    e.preventDefault();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "/core/updateemail.php", true);
    xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    var formdata = new FormData();
    formdata.append("email", document.getElementById("uEmail").value);
    formdata.append("password", document.getElementById("uPassword").value);

    xmlhttp.onreadystatechange = () => {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var res = JSON.parse(xmlhttp.responseText);

            switch (res.status) {
                case "error":
                    eError.textContent = "";
                    popalert("error", res.message);
                    break;
                case "validate":
                    eError.textContent = "* " + res.message;
                    break;

                case "success":
                    eError.textContent = "";
                    popalert("success", res.message);
                    break;
            }
        }
    };
    xmlhttp.send(formdata);
});

// DROP UPLOAD
const dropArea = document.querySelector(".drop-area");
const error = document.getElementById("error");
const text = document.querySelector(".upload");
const button = document.getElementById("uploadBtn");
const input = document.getElementById("uploadInput");

let file;

button.onclick = () => {
    input.click();
};

input.addEventListener("change", function () {
    file = this.files[0];
    showFile();
    dropArea.classList.add("active");
});

dropArea.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropArea.classList.add("active");
    text.innerText = "Release to Upload file.";
});

dropArea.addEventListener("dragleave", () => {
    dropArea.classList.remove("active");
    text.innerText = "You can drop image here, or";
});

dropArea.addEventListener("drop", (e) => {
    e.preventDefault();
    file = e.dataTransfer.files[0];
    showFile();
});

function showFile() {
    let fileType = file.type;

    let validExtensions = ["image/jpeg", "image/jpg", "image/png"];
    if (validExtensions.includes(fileType)) {
        console.log("YAY");
        error.innerText = "";
        text.innerText = "You can drop image here, or";
        let fileReader = new FileReader();
        fileReader.onload = () => {
            let fileUrl = fileReader.result;
            let imgSource = `<img src="${fileUrl}" alt="Uploaded image">`;
            dropArea.innerHTML = imgSource;
            sendFile();
        };
        fileReader.readAsDataURL(file);
    } else {
        error.innerText = "* This is not a supported file extension.";
        dropArea.classList.remove("active");
    }
}

function sendFile() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "/core/upload.php", true);
    xmlhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");

    var formdata = new FormData();
    formdata.append("file", file);

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
                        window.location.replace("/settings");
                    }, 8000);
                    break;
            }
        }
    };
    xmlhttp.send(formdata);
}
