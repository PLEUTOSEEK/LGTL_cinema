
function onDragStart(event) {
    if (event.target.parentElement.childElementCount == 1) {
        event.target.parentElement.style.height = "50px";
    }
    event.dataTransfer.setData('text/plain', event.target.id);
}
function onDragOver(event) {
    event.preventDefault();
}
function handleDrop(e) {
    var els = document.getElementsByClassName("drag-zone");
    for (var i = 0; i < els.length; i++)
    {
        if (e.target.id == els[i].id) {
            const id = e
                    .dataTransfer
                    .getData('text');
            e.srcElement.appendChild(document.getElementById(id));
            e.target.style.height = "auto";
            break;
        }

    }
}
