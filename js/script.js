function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
}

window.addEventListener("DOMContentLoaded", function() {
    let boxes = document.querySelectorAll(".box");

    Array.from(boxes, function(box) {
        box.addEventListener("click", function() {
            alert(this.classList[1]);
        });
    });
});