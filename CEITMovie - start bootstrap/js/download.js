function onClickHandler(obj) {

    var options = getFirstLevelChildNodes(document.getElementsByClassName("movie-options-list")[0]);
    var options_a = getFirstLevelChildNodeFromElements(options);
    var index = findIndex(options, obj);
    var content = document.getElementsByClassName("cnt");
    for(i=0; i<content.length; i++){
        if(i===index) {
            content[i].style.display = "block";
            options_a[i].style.color = "#000000";
            options_a[i].style.borderWidth = "2px"
            options_a[i].style.borderColor = "#000000";
        }
        else {
            content[i].style.display = "none";
            options_a[i].style.color = "#808080";
            options_a[i].style.borderWidth = "1px"
            options_a[i].style.borderColor = "#808080";
        }
    }
}
function getFirstLevelChildNodes(node) {
    var children = [];
    for(i=0; i<node.childNodes.length; i++) {
        if(node.childNodes[i].nodeType === 1) {
            children.push(node.childNodes[i]);
        }
    }
    return children;
}
function getFirstLevelChildNodeFromElements(node) {
    var children = [];
    for (j = 0; j < node.length; j++) {
        for (i = 0; i < node[j].childNodes.length; i++) {
            if (node[j].childNodes[i].nodeType === 1) {
                children.push(node[j].childNodes[i]);
            }
        }
    }
    return children;
}
function findIndex(array, obj) {
    for(i=0; i<array.length; i++){
        if(array[i]===obj) {
            return i;
        }
    }
}
window.onload = function () {
    var options = document.getElementsByClassName("movie-options-list")[0].childNodes;
    for(i=0; i<options.length; i++){
        options[i].onclick = function() {onClickHandler(this)};
    }

    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = process;
    xmlhttp.open("GET","http://www.theimdbapi.org/api/find/movie?title=despicableme3&year=2017",true);
    xmlhttp.send(null);

};
function process() {
    if(this.readyState == 4){
        if(this.status == 200){
            res = JSON.parse(xmlhttp.responseText);
            console.log(res);
            document.getElementById('test').innerHTML=res[0]["title"];
        }
        else{window.alert("Error "+ xmlhttp.statusText); }
    }
}
