var bodyContainer = document.querySelector(".body__container");

function openFormAdd() {
    var optionBook = "";
    var optionCategory = "";
    if (listBook.length > 0) {
        for (var i = 0; i < listBook.length; i++) {
            optionBook +=
                '<option value="' + listBook[i][0] + '">' + listBook[i][1] + "";
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
    bodyContainer.classList.add("form-add-is-open");
    var addFormAdd = document.createElement("div");
    addFormAdd.className = "list__form";
    bodyContainer.appendChild(addFormAdd);
    addFormAdd.innerHTML = `
            <form action="?controller=admin&action=upload" method="post" id="form-add-book" class="list__form-add" style="height: 420px; width: fit-content">
            <div class="list__form-title">
                <span style="padding: 40px"><i class="fa-solid fa-book icon"></i> Tải lên tài liệu</span><i class="fa-solid fa-xmark close-icon"
                onclick="closeFormAdd()"></i>
            </div>
            <div class="list__form-content" style="display: block">
                <div class="list__add-handmade"  style="display: flex; justify-content: center;">
                    <div style="text-align: start; width: 80%;">
                    <div class="list__form-box" style="padding: 5px 0; flex: 1">
                    <label class="list__form-label">Tài liệu <span>*</span></label>
                        <select name="user_borrow" id="select-book">
                        ${optionBook} 
                        </select>
                </div>
                <div class="list__form-box" style="padding: 5px 0; flex: 1">
                <label class="list__form-label">Danh mục <span>*</span></label>
                    <select name="user_borrow" id="select-category">
                    ${optionCategory} 
                    </select>
            </div>
                    <div class="list__form-box" style="padding: 5px 0;">
                    <label for="input-name" class="list__form-label">Nhan đề <span>*</span></label>
                    <input type="text" class="list__form-input" id="input-name" required placeholder="Nhập tên sách">
                    </div>
                        <div style="font-size: 18px; font-weight: 500; margin-top: 10px">File tài liệu số <span style="color: red">*</span></div>
                            <div style="display: flex; flex-direction: column;">
                                <input id='upload-file' type="file" accept="application/pdf" style="padding: 10px 0;">
                    </div>
                    </div>
                </div>
            </div>
            
            <div class="list__form-btn">
                <button type="button" class="close-btn" onclick="closeFormAdd()">Đóng</button>
                <button type="button" onclick="submitUpload()" name="add-book" >Thêm</button>
            </div>
        </form>`;
}
