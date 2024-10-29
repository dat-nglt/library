var bodyContainer = document.querySelector('.body__container')

function openFormAdd() {
    var optionUser = "";
    
   if (listUser.length > 0) {
        for (var i = 0; i < listUser.length; i++) {
            optionUser +=
                '<option value="' +
                listUser[i][0] +
                '">'+ listUser[i][8] + '-' + listUser[i][9] +'' 
                '</option>';
        }
    } 
    var optionRequest = "";
    
    if (listRequest.length > 0) {
         for (var i = 0; i < listRequest.length; i++) {
             optionRequest +=
                 '<option value="' +
                 listRequest[i][0] +
                 '">'+ listRequest[i][8] + '-' + listRequest[i][9] +'' 
                 '</option>';
         }
     } 
  bodyContainer.classList.add('form-add-is-open')
  var addFormAdd = document.createElement('div')
  addFormAdd.className = 'list__form'
  bodyContainer.appendChild(addFormAdd)
  addFormAdd.innerHTML = `
            <form action="" method="post" id="form-add-book" class="list__form-add" style="height: 620px;">
             <div class="list__form-title">
                <span><i class="fa-solid fa-file-invoice-dollar icon"></i></i> Thêm phiếu phạt</span><i class="fa-solid fa-xmark close-icon"
                onclick="closeFormAdd()"></i>
            </div>
              <div class="list__add-handmade" style="display: flex">
                    <div class="list__form-box" style="flex: 1">
                        <label class="list__form-label">Tên sách mượn</label>
                            <select name="book_borrow">
                            ${optionUser}
                            </select>
                    </div>
                </div>
            <div class="list__form-btn">
                <button type="button" class="close-btn" onclick="closeFormAdd()">Đóng</button>
                <button type="submit" name="add_category-handmade">Thêm</button>
            </div>
        </form>`
}
