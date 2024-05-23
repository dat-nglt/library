$(document).on("click", ".list__action-open-edit", function () {
    var optionBook = "";
    var optionCategory = "";
    if (listBook.length > 0) {
        for (var i = 0; i < listBook.length; i++) {
            optionBook +=
                '<option title="' +
                listBook[i][1] +
                '" value="' +
                listBook[i][0] +
                '">' +
                listBook[i][1] +
                "";
            ("</option>");
        }
    }

    if (listCategory.length > 0) {
        for (var i = 0; i < listCategory.length; i++) {
            optionCategory +=
                '<option value="' +
                listCategory[i][0] +
                '">' +
                listCategory[i][1] +
                "";
            ("</option>");
        }
    }

    var id = $(this).data("id");
    var name = $(this).closest("tr").find("td:eq(1)").text().trim();
    var bodyContainer = document.querySelector(".body__container");
    bodyContainer.classList.add("form-add-is-open");
    var addFormEdit = document.createElement("div");
    addFormEdit.className = "list__form";
    bodyContainer.appendChild(addFormEdit);
    addFormEdit.innerHTML = `
        <form action="?controller=admin&action=category" method="post" style="height: 300px; width: fit-content;" class="list__form-add">
            <div class="list__form-title">
                <span style="padding: 40px"><i class="fa-solid fa-list icon"></i> Yêu cầu tải lên</span><i class="fa-solid fa-xmark close-icon"
                onclick="closeFormAdd()"></i>
            </div>
            <div class="list__form-content" style="display: block">
                <div class="list__add-handmade" style="display: flex;  flex-direction: column; padding: 10px 50px;">
                    <div class="list__form-box" style="padding: 5px 0; flex: 1;">
                        <label class="list__form-label">Tài liệu <span>*</span></label>
                        <select name="user_borrow" id="select-book" style="width: 400px">
                        <option value="null">Chờ xét duyệt</option>
                        ${optionBook} 
                        </select>
                    </div>
                    <span style="text-align: start; padding: 10px 0">Lưu ý: Chọn tài liệu để duyệt file dữ liệu số,<br> sau đó chọn xác nhận để duyệt yêu cầu!</span>
                </div>
            </div>
            <div class="list__form-btn">
                <button type="button" class="close-btn" onclick="closeFormAdd()">Huỷ</button>
                <button type="submit" name="edit_category-handmade">Xác nhận</button>
            </div>
        </form>`;
});
