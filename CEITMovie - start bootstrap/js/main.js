
function onMouseOverHandler(obj) {
    var poster = document.getElementsByClassName("subitem");
    var index = findIndex(poster, obj);
    var info = document.getElementsByClassName("info");
    info[index].style.visibility = "visible"
}
function onMouseOutHandler(obj) {
    var poster = document.getElementsByClassName("subitem");
    var index = findIndex(poster, obj);
    var info = document.getElementsByClassName("info");
    info[index].style.visibility = "hidden"
}
function onClickHandler(obj) {
    window.location.href = "../src/download.html";
}

function findIndex(array, obj) {
    for(i=0; i<array.length; i++){
        if(array[i]===obj) {
            return i;
        }
    }
}
window.onload = function () {
    var poster = document.getElementsByClassName("subitem");
    for(i=0; i<poster.length; i++){
        poster[i].onmouseover = function() {onMouseOverHandler(this)};
        poster[i].onmouseout = function() {onMouseOutHandler(this)};
        poster[i].onclick = function() {onClickHandler(this)};
    }

};

