var bodyContainer = document.querySelector(".body__container");

function openFormAdd() {
    var optionBook = "";
    var optionUser = "";
   if (listBook.length > 0) {
        for (var i = 0; i < listBook.length; i++) {
            optionBook +=
                '<option value="' +
                listBook[i][0] +
                '">'+ listBook[i][1] +''
                '</option>';
        }
    } 

    if (listUser.length > 0) {
        for (var i = 0; i < listUser.length; i++) {
            optionUser +=
                '<option value="' +
                listUser[i][0] +
                '">' +
                listUser[i][1] + ' - ' + listUser[i][3]
                "</option>";
        }
    } 
    bodyContainer.classList.add("form-add-is-open");
    var addFormAdd = document.createElement("div");
    addFormAdd.className = "list__form";
    bodyContainer.appendChild(addFormAdd);
    addFormAdd.innerHTML = `
    <form action="?controller=admin&action=borrow" method="post" class="list__form-add" style="height: 300px;">
    <div class="list__form-title">
        <span><i class="fa-solid fa-book icon"></i> Thêm phiếu mượn</span><i class="fa-solid fa-xmark close-icon"
        onclick="closeFormAdd()"></i>
    </div>
    <div class="list__form-content"style="display: block">
        <div class="list__add-handmade" style="display: flex ">
            <div class="list__form-box" style="flex: 1">
                <label class="list__form-label">Độc giả</label>
                    <select name="user_borrow">
                    ${optionUser}
                    </select>
            </div>
        </div>
        <div class="list__add-handmade" style="display: flex">
            <div class="list__form-box" style="flex: 1">
                <label class="list__form-label">Tên sách mượn</label>
                    <select name="book_borrow">
                    ${optionBook}
                    </select>
            </div>
        </div>
    </div>
    <div class="list__form-btn">
        <button type="button" class="close-btn" onclick="closeFormAdd()">Đóng</button>
        <button name="add-borrow">Thêm</button>
    </div>
</form>`;
}
