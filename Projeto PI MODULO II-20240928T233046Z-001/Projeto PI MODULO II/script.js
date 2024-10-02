document.getElementById("btn-info").addEventListener("click", function(event) {
    event.stopPropagation();
    var message = document.getElementById("floatingMessage");
    if
    (message.classList.contains("hidden")) {
        message.classList.remove("hidden");
        message.style.display = "block";
    } else {
        message.classList.add("hidden");
        message.style.display = "none";
    }
});

document.addEventListener("click", function() {
    var message = document.getElementById("floatingMessage");
    if (!message.classList.contains("hidden")) {
        message.classList.add("hidden");
        message.style.display = "none";
    }
});

document.getElementById("floatingMessage").addEventListener("click", function(event) {
    event.stopPropagation();
});