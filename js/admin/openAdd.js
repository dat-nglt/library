const openAddBtn = document.querySelector("#list__add-btn");
const outSideForm = document.querySelector(".list__form");
const outSideForm1 = document.querySelector(".list__form-1");
const formAdd = document.querySelector(".list__form-add");
const closeAddIcons = document.querySelector(".close-add-icon");
const closeBtn = document.querySelector(".close-btn");
const categoryName = document.querySelector("#category-name");
const categoryNote = document.querySelector("#category-note");
const productNumber = document.querySelector("#product-number");
const emptyInputMsg = document.querySelector(`.list__form-error-input`);
const emptyTextareaMsg = document.querySelector(`.list__form-error-textarea`);
const emptyNumberMsg = document.querySelector(`.list__form-error-number`);

function openFormAdd() {
    outSideForm.classList.add("open");
}

function closeResetFormAdd() {
    if(outSideForm.contains(categoryName)){
        categoryName.value = "";
        categoryName.classList.remove("error-input-form");
        emptyInputMsg.innerText = "";
    }
    if(outSideForm.contains(categoryNote)){
        categoryNote.value = "";
        categoryNote.classList.remove("error-input-form");
        emptyTextareaMsg.innerText = "";
    }
    if(outSideForm.contains(productNumber)){
        productNumber.value = "";
        productNumber.classList.remove("error-input-form");
        emptyNumberMsg.innerText = "";
    }
    outSideForm.classList.remove("open");
}

function closeFormAdd() {
    outSideForm.classList.remove("open");
}

outSideForm.addEventListener("click", function (e) {
    if (!formAdd.contains(e.target)) {
        closeResetFormAdd();
    }
});

formAdd.addEventListener("click", function (e) {
    e.stopPropagation();
});