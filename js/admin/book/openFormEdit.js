$(document).on("click", ".list__action-open-edit", function () {
    var id = $(this).data('id');
    var name = $(this).closest("tr").find("td:eq(1)").text().trim();
    var creator = $(this).closest("tr").find("td:eq(2)").text().trim();
    var image = $(this).closest("tr").find("td:eq(3) img").attr("src");
    var count = $(this).closest("tr").find("td:eq(4)").text().trim();
    var publisher = $(this).closest("tr").find("td:eq(5)").text().trim();
    var dateBook = $(this).closest("tr").find("td:eq(6)").text().trim();
    var category = $(this).closest("tr").find("td:eq(7)").text().trim();
    var des = $(this).closest("tr").find("td:eq(8)").text().trim();
    if(image != ''){
        styleImg = 'style="width: 100px; height: 120px;"';
        heghtForm = '670px';
    }else{
        styleImg = '';
        heghtForm = '620px';
    }
    var optionCategoryEdit = '';

    if(selectCategory.options.length>1){
        for (var i = 1; i < selectCategory.options.length; i++) {
            var option = selectCategory.options[i];
            if(option.text === category){
                optionCategoryEdit += '<option value="' + option.value + '" selected>' + option.text + '</option>';
            }else{
                optionCategoryEdit += '<option value="' + option.value + '">' + option.text + '</option>';
            }
          }
    }

    var bodyContainer = document.querySelector(".body__container");
    bodyContainer.classList.add("form-add-is-open");
    var addFormEdit = document.createElement("div");
    addFormEdit.className = "list__form";
    bodyContainer.appendChild(addFormEdit);
    addFormEdit.innerHTML = `
    <form action="" method="post" id="form-add-book" class="list__form-add" style="height: ${heghtForm};">
    <div class="list__form-title">
        <span><i class="fa-solid fa-book icon"></i> Chỉnh sửa sách</span><i class="fa-solid fa-xmark close-icon"
        onclick="closeFormAdd()"></i>
    </div>
    <div class="list__form-content"style="display: block">
        <div class="list__add-handmade" style="padding: 10px 15px 0 15px;">
            <div style="text-align: start;">
                <div >Hình ảnh sách</div>
                <div style="display: flex; flex-direction: column;">
                    <div style="display: flex;justify-content: center; margin-bottom: 5px;" id="imgContainer"></div>
                    <div style="display: flex;justify-content: center; margin-bottom: 5px;"><img ${styleImg} id="oldimg" src="${image}" alt=""></div>
                    <div class="select_avatar" style="display: block">
                        <input type="file" id="newImg" accept="image/*" onchange="changeImg(event)">
                        <button class="button_change" type="button">Chọn ảnh</button>
                    </div>
                </div>
            </div>
            <div>
            <div class="list__form-box">
            <label for="input-name" class="list__form-label">Tên sách <span>*</span></label>
            <input type="text" class="list__form-input" id="input-name" value="${name}" required placeholder="Nhập tên sách">
            </div>
            <div class="list__form-box" style="margin-top: 10px">
                <label for="input-creator" class="list__form-label">Tác giả <span>*</span></label>
                <input type="text" class="list__form-input" value="${creator}" id="input-creator" required
                    placeholder="Nhập tác giả">
            </div>
        </div>
        </div>
        <div class="list__add-handmade">
            <div>
                <div class="list__form-box">
                <label for="input-count" class="list__form-label">Số lượng <span>*</span></label>
                    <input type="number" class="list__form-input" id="input-count" required
                        placeholder="Nhập số lượng" inputmode="numeric" value="${count}" pattern="[0-9]*">
                </div>
                <div class="list__form-box" style="margin-top: 10px">
                    <label class="list__form-label">Danh mục</label>
                        <select name="category-book" id="category-book-add">
                            ${optionCategoryEdit}
                        </select>
                </div>
            </div>
            <div>
            <div class="list__form-box">
                <label for="input-publisher" class="list__form-label">Nhà xuất bản <span>*</span></label>
                <input type="text" class="list__form-input" value="${publisher}" id="input-publisher" required
                    placeholder="Nhập nhà xuất bản">
            </div>
            <div class="list__form-box" style="margin-top: 10px">
                <label for="input-date-book" class="list__form-label">Năm xuất bản <span>*</span></label>
                <input type="text" class="list__form-input" value="${dateBook}" id="input-date-book" required
                    placeholder="Nhập Năm xuất bản">
            </div>
        </div>
        </div>
        <div class="list__add-handmade" style="display:flex">
            <div class="list__form-box" style="flex: 1">
                <label for="input-des" class="list__form-label">Mô tả</label>
                <textarea id="input-des" placeholder="Nhập mô tả">${des}</textarea>
            </div>
        </div>
        <input type="hidden" id="id_book" value="${id}">
    </div>
    <div class="list__form-btn">
        <button type="button" class="close-btn" onclick="closeFormAdd()">Đóng</button>
        <button type="button" onclick="submitBookEdit()" name="add-book" >Chỉnh sửa</button>
    </div>
</form>`;
});
