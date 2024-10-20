$(document).on("click", ".list__action-open-edit", function () {
    var bodyContainer = document.querySelector(".body__container");
    bodyContainer.classList.add("form-add-is-open");
    var addFormEdit = document.createElement("div");
    addFormEdit.className = "list__form";
    bodyContainer.appendChild(addFormEdit);
    addFormEdit.innerHTML = `
   <form action="" method="post" style="width: 400px; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background-color: #f9f9f9;" class="list__form-add">
    <div class="list__form-title" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <span style="font-size: 18px; font-weight: bold;"><i class="fa-solid fa-list icon" style="margin-right: 10px;"></i>THÔNG TIN CHI TIẾT</span>
        <i class="fa-solid fa-xmark close-icon" onclick="closeFormAdd()" style="cursor: pointer; font-size: 20px;"></i>
    </div>

    
</form>

    `;
});
