const getElement = require("./getElement");
const link = require("./actions/link");
const image = require("./actions/image");

module.exports = (button) => {
    $("#text_editor_content").focus();

    const action = button.dataset.action;
    button.classList.toggle("active");

    if(action === "image") {
        image();
    } else if(action === "bold") {
        document.execCommand("bold");
    } else if(action === "italic") {
        document.execCommand("italic");
    } else if(action === "underline") {
        document.execCommand("underline");
    } else if(action === "strikeThrough") {
        document.execCommand("strikeThrough");
    } else if(action === "link") {
        link(button);
    } else if(action === "code") {
        button.classList.remove("active");
        const element = getElement("PRE");
        
        if(element.classList.contains("code")) {
            document.execCommand("formatBlock", true, "p");
        } else {
            document.execCommand("formatBlock", true, "pre");

            const selectedElement = getElement("PRE");
            
            if(selectedElement.nodeName === "PRE") {
                selectedElement.classList.add("code");

                button.classList.add("active");
            }
        }
    }
}