const singleUpload = document.querySelector(".single-photo-upload");
const realUpload = document.querySelector(".real-upload");
const uploadLogo = document.querySelector(".upload-logo");

singleUpload.addEventListener("click", () => {
    realUpload.click();
});
realUpload.addEventListener("change", (e) => {
    const file = e.target.files[0];
    const reader = new FileReader();
    const img = new Image();
    const div = document.createElement("div");
    const delBtn = document.createElement("button");
    delBtn.innerHTML = `<i class="bi bi-trash"></i>`;
    delBtn.classList.add("btn", "btn-danger", "btn-sm");
    delBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        delBtn.parentElement.remove();
        realUpload.value = null;
    });
    reader.addEventListener("load", () => {
        img.src = reader.result;
        img.width="250";
        img.height="250";
        div.classList.add("img-container");
        img.classList.add("upload-img");
        div.prepend(img);
        div.append(delBtn);
        singleUpload.prepend(div);
    });
    reader.readAsDataURL(file);
});
