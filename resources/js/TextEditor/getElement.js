module.exports = tag => {
    var element = window.getSelection().focusNode;

    while(element.nodeName !== tag && element.nodeName !== "DIV") {
        element = element.parentElement;
    }

    return element;
};