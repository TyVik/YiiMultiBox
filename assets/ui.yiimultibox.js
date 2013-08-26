function makeDraggable() {
    var list = document.getElementsByClassName("boxy");
    for (var i = 0; i < list.length; i++) {
        DragDrop.makeListContainer(list[i]);
        list[i].onDragOver = function() { this.style["background"] = "#EEF"; };
        list[i].onDragOut = function() {this.style["background"] = ""; };
    }
}

function attachToForm(name) {
    $("#"+name).submit(function(eventObject) {
    var result = {};
        $.each($("ul.boxy"), function(index, element) {
            var box = [];
            $(this).find("li").each(function() {
                box.push($(this).attr("id"));
            });
            result[element.id] = box;
        });
        document.getElementById("YiiMultiBox").value = JSON.stringify(result);
        return true;
    });
}
