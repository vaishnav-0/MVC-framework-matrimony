const fileSelect = document.querySelector(".profilePhoto");
const fileElem = document.querySelector("#profileUp");
fileSelect.addEventListener("click", function (e) {
    if (fileElem) {
        fileElem.click();
    }
}, false);
const inputElement = document.getElementById("profileUp");
inputElement.addEventListener("change", handleFile, false);

function handleFile() {
    const file = this.files[0];
    if (file.type.startsWith('image/')) {
        const img = document.getElementById("profilePic");
        img.file = file;
        const objectURL = window.URL.createObjectURL(file);
        img.src = objectURL;
    }
}