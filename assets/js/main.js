var sidebar = document.getElementById("Sidebar");
var menu = document.getElementById("menu");
var main = document.getElementById("Main");

if (menu && sidebar && main) {
    menu.addEventListener("click", () => {
        sidebar.classList.toggle("mini");
        main.classList.toggle("max");
    });
}
