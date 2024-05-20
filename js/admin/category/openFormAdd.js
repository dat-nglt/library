var bodyContainer = document.querySelector(".body__container");

function openFormAdd() {
    bodyContainer.classList.add("form-add-is-open");
    var addFormAdd = document.createElement("div");
    addFormAdd.className = "list__form";
    bodyContainer.appendChild(addFormAdd);
    addFormAdd.innerHTML = `
        <form action="?controller=admin&action=category" method="post" style="height: 220px" class="list__form-add">
            <div class="list__form-title">
                <span><i class="fa-solid fa-list icon"></i> Thêm thể loại sách</span><i class="fa-solid fa-xmark close-icon"
                onclick="closeFormAdd()"></i>
            </div>
            <div class="list__form-content">
                <div class="list__add-handmade" style="display: flex">
                    <div class="list__form-box" style="flex: 1">
                        <label for="input-category" class="list__form-label">Nhập tên thể loại sách <span>*</span></label>
                        <input type="text" class="list__form-input" name="category_name" required id="input-category"
                            placeholder="Nhập tên thể loại sách">
                    </div>
                </div>
            </div>
            <div class="list__form-btn">
                <button type="button" class="close-btn" onclick="closeFormAdd()">Đóng</button>
                <button type="submit" name="add_category-handmade">Thêm</button>
            </div>
        </form>`;
}
