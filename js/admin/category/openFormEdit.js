$(document).on("click", ".list__action-open-edit", function () {
    var id = $(this).data('id');
    var name = $(this).closest("tr").find("td:eq(2)").text().trim();
    var bodyContainer = document.querySelector(".body__container");
    bodyContainer.classList.add("form-add-is-open");
    var addFormEdit = document.createElement("div");
    addFormEdit.className = "list__form";
    bodyContainer.appendChild(addFormEdit);
    addFormEdit.innerHTML = `
        <form action="?controller=admin&action=category" method="post" style="height: 220px" class="list__form-add">
            <div class="list__form-title">
                <span><i class="fa-solid fa-list icon"></i> Chỉnh sửa thể loại</span><i class="fa-solid fa-xmark close-icon"
                onclick="closeFormAdd()"></i>
            </div>
            <div class="list__form-content">
                <div class="list__add-handmade" style="display: flex">
                    <div class="list__form-box" style="flex: 1">
                        <label for="input-name" class="list__form-label">Tên thể loại sách <span>*</span></label>
                        <input type="text" class="list__form-input" value="${name}" name="category_name" required id="input-name"
                            placeholder="Nhập tên thể loại sách">
                    </div>
                    <input type="hidden" value="${id}" name="category_id">
                </div>
            </div>
            <div class="list__form-btn">
                <button type="button" class="close-btn" onclick="closeFormAdd()">Đóng</button>
                <button type="submit" name="edit_category-handmade">Thêm</button>
            </div>
        </form>`;
});
