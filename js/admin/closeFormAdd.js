function closeFormAdd() {
    bodyContainer.lastChild.remove();
    bodyContainer.classList.remove("form-add-is-open");
}

bodyContainer.addEventListener("click", function (e) {
    if (bodyContainer.classList.contains("form-add-is-open")) {
        var formAdd = document.querySelector(".list__form");
        var formAdd1 = document.querySelector(".list__form-add");
        formAdd.addEventListener("click", function (e) {
            if (!formAdd1.contains(e.target)) {
                closeFormAdd();
            }
        });
        formAdd.addEventListener("click", function (e) {
            e.stopPropagation();
        });
    }
});
