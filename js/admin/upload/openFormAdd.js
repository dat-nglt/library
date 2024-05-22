var bodyContainer = document.querySelector(".body__container");
var selectCategory = document.querySelector("#name-book-add");

function openFormAdd() {
    // var optionCategory = "";

    // if (selectCategory.options.length > 1) {
    //     for (var i = 1; i < selectCategory.options.length; i++) {
    //         var option = selectCategory.options[i];
    //         optionCategory +=
    //             '<option value="' +
    //             option.value +
    //             '">' +
    //             option.text +
    //             "</option>";
    //     }
    // }
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
                <div class="list__add-handmade">
                    <div style="text-align: start;">
                        <div style="font-size: 18px; font-weight: 500;">File tài liệu số</div>
                            <div style="display: flex; flex-direction: column;">
                            <div class="select_avatar" style="display: block">
                                <input type="file" id="newImg" accept="application/pdf" onchange="changeImg(event)">
                                <button class="button_change" type="button">Tải lên...</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="list__form-btn">
                <button type="button" class="close-btn" onclick="closeFormAdd()">Đóng</button>
                <button type="button" onclick="submitBook()" name="add-book" >Thêm</button>
            </div>
        </form>`;
}
