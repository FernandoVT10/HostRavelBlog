const axios = require("axios");

module.exports = () => {
    const inputFile = document.createElement("input");
    inputFile.type = "file";
    inputFile.accept = "image/jpeg, image/png";
    inputFile.click();

    inputFile.addEventListener("change", () => {
        $("#image-loader").addClass("active");

        const imageFile = inputFile.files[0];

        const formData = new FormData();
        formData.append("image", imageFile);

        // we upload the image to the server for save it
        axios.default.post("/articles/uploadImage", formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        }).then(res => {
            // and then if the image has been uploaded, we show the image in the
            // text editor content
            if(res.data.status) {
                $("#text_editor_content").focus();
                const image = `<img src="${res.data.image_url}" class="img-fluid" />`;
                document.execCommand("insertHTML", true, image);
            }

            $("#image-loader").removeClass("active");
        });
    });
}