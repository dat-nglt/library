var bodyContainer = document.querySelector(".body__container");
var selectCategory = document.querySelector("#category-book");

function openFormAdd() {
    var optionCategory = "";

    if (selectCategory.options.length > 1) {
        for (var i = 1; i < selectCategory.options.length; i++) {
            var option = selectCategory.options[i];
            optionCategory +=
                '<option value="' +
                option.value +
                '">' +
                option.text +
                "</option>";
        }
    }
    bodyContainer.classList.add("form-add-is-open");
    var addFormAdd = document.createElement("div");
    addFormAdd.className = "list__form";
    bodyContainer.appendChild(addFormAdd);
    addFormAdd.innerHTML = `
            <form action="" method="post" id="form-add-book" class="list__form-add" style="height: 620px;">
            <div class="list__form-title">
                <span><i class="fa-solid fa-book icon"></i> Thêm sách</span><i class="fa-solid fa-xmark close-icon"
                onclick="closeFormAdd()"></i>
            </div>
            <div class="list__form-content"style="display: block">
                <div class="list__add-handmade" style="padding: 10px 15px 0 15px;">
                    <div style="text-align: start;">
                        <div style="font-size: 18px; font-weight: 500;">Hình ảnh sách</div>
                        <div style="display: flex; flex-direction: column;">
                            <div style="display: flex;justify-content: center; margin-bottom: 5px;" id="imgContainer"></div>
                            <img id="oldimg" src="" alt="">
                            <div class="select_avatar" style="display: block">
                                <input type="file" id="newImg" accept="image/*" onchange="changeImg(event)">
                                <button class="button_change" type="button">Chọn ảnh</button>
                            </div>
                        </div>
                    </div>
                    <div>
                    <div class="list__form-box">
                    <label for="input-name" class="list__form-label">Tên sách <span>*</span></label>
                    <input type="text" class="list__form-input" id="input-name" required placeholder="Nhập tên sách">
                    </div>
                    <div class="list__form-box" style="margin-top: 10px">
                        <label for="input-creator" class="list__form-label">Tác giả <span>*</span></label>
                        <input type="text" class="list__form-input" id="input-creator" required
                            placeholder="Nhập tác giả">
                    </div>
                </div>
                </div>
                <div class="list__add-handmade">
                    <div>
                        <div class="list__form-box">
                        <label for="input-count" class="list__form-label">Số lượng <span>*</span></label>
                            <input type="number" class="list__form-input" id="input-count" required
                                placeholder="Nhập số lượng" inputmode="numeric" pattern="[0-9]*">
                        </div>
                        <div class="list__form-box" style="margin-top: 10px">
                            <label class="list__form-label">Danh mục</label>
                                <select name="category-book" id="category-book-add">
                                    ${optionCategory}
                                </select>
                        </div>
                    </div>
                    <div>
                    <div class="list__form-box">
                        <label for="input-publisher" class="list__form-label">Nhà xuất bản <span>*</span></label>
                        <input type="text" class="list__form-input" id="input-publisher" required
                            placeholder="Nhập nhà xuất bản">
                    </div>
                    <div class="list__form-box" style="margin-top: 10px">
                        <label for="input-date-book" class="list__form-label">Năm xuất bản <span>*</span></label>
                        <input type="text" class="list__form-input" id="input-date-book" required
                            placeholder="Nhập Năm xuất bản">
                    </div>
                </div>
                </div>
                <div class="list__add-handmade" style="display:flex">
                    <div class="list__form-box" style="flex: 1">
                        <label for="input-des" class="list__form-label">Mô tả</label>
                        <textarea id="input-des" placeholder="Nhập mô tả"></textarea>
                    </div>
                </div>
            </div>
            <div class="list__form-btn">
                <button type="button" class="close-btn" onclick="closeFormAdd()">Đóng</button>
                <button type="button" onclick="submitBook()" name="add-book" >Thêm</button>
            </div>
        </form>`;
}