const MAX_BUTTON = 3;
window.onload = function () {
    let addBtn = document.getElementById('add-btn');
    addBtn.onclick = function (e) {
        var blocks = document.getElementsByClassName('block');
        if (blocks.length < MAX_BUTTON) {
            // Remove hidden attribute
            for (var i = 0; i < blocks.length; i++) {
                blocks[i].getElementsByClassName('delete-btn')[0].removeAttribute('hidden');
            }
            // Clone block
            var block = blocks[blocks.length - 1];
            var cloneBlock = block.cloneNode(true);
            block.insertAdjacentElement('afterend', cloneBlock);
            cloneBlock.querySelector('input[name="meanings[]"]').value = '';
            // Add delete event
            block.getElementsByClassName('delete-btn')[0].onclick = deleteBtnEvent;
            cloneBlock.getElementsByClassName('delete-btn')[0].onclick = deleteBtnEvent;
        }
    }
}
// Delete event
function deleteBtnEvent(e) {
    // Remove block
    var block = e.target.parentNode.parentNode.parentNode;
    block.parentNode.removeChild(block);
    // Add hidden attribute
    var blocks = document.getElementsByClassName('block');
    if (blocks.length == 1) {
        blocks[0].getElementsByClassName('delete-btn')[0].setAttribute('hidden', true);
    }
}
