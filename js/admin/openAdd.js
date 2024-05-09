const openAddBtn = document.querySelector("#list__add-btn");
const outSideForm = document.querySelector(".list__form");
const formAdd = document.querySelector(".list__form-add");
const closeAddIcons = document.querySelector(".close-add-icon");
const closeBtn = document.querySelector(".close-btn");
const categoryName = document.querySelector("#category-name");
const categoryNote = document.querySelector("#category-note");
const productNumber = document.querySelector("#product-number");

function openFormAdd() {
    outSideForm.classList.add("open-add-form");
}

function closeResetFormAdd() {
    outSideForm.classList.remove("open-add-form");
}

function closeFormAdd() {
    outSideForm.classList.remove("open-add-form");
}

outSideForm.addEventListener("click", function (e) {
    if (!formAdd.contains(e.target)) {
        closeResetFormAdd();
    }
});

formAdd.addEventListener("click", function (e) {
    e.stopPropagation();
});