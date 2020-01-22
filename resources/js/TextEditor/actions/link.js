const getElement = require("../getElement");
const link = {
    editLink: false,
    element: null
};

module.exports = button => {
    button.classList.remove("active");
    const element = getElement("A");

    if(element.nodeName === "A") {
        $("#text_editor_title_link").val(element.innerHTML);
        $("#text_editor_href_link").val(element.dataset.originalTitle);
        $("#linkModal").modal("show");

        link.editLink = true;
        link.element = element;
    } else {
        link.editLink = false;
        $("#linkModal").modal("show");
    }
}

$("#text_editor_add_link").click(() => {
    $("#text_editor_content").focus();
    const title = $("#text_editor_title_link").val();
    const href = $("#text_editor_href_link").val();

    if(link.editLink) {
        console.log(link);
        link.element.href = href;
        link.element.dataset.originalTitle = href;
        link.element.innerHTML = title;
        link.editLink = false;
    } else {
        const html = `<a href="${href}"
                    data-toggle="tooltip"
                    data-placement="top"
                    title="${href}">${title}</a>`;
        document.execCommand("insertHTML", true, html);
    }
});