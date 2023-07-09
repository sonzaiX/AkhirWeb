function changeContent() {
    var selectValue = document.getElementById("layananSelect").value;
    var contentElements = document.getElementsByClassName("content");
    for (var i = 0; i < contentElements.length; i++) {
        contentElements[i].classList.remove("active");
    }
    document.getElementById("content" + selectValue).classList.add("active");
}
