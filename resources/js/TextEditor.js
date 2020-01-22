const actions = require("./TextEditor/startActions");
const actionButtons = document.querySelectorAll("#textEditor .actions .action-button");

if(actionButtons.length) {
    actionButtons.forEach(button => {
        button.addEventListener("click", () => {
            actions(button);
        });
    });

    document.getElementById("text_editor_content").addEventListener("input", () => {
        $("#text_editor_input").val($("#text_editor_content").html());
    });
}

// Activate all tooltips

$(document).ready(function() {
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
});