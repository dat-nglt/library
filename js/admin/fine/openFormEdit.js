$(document).on("click", ".list__action-open-edit", function () {
    var id = $(this).data('id');
    var mssv = $(this).closest("tr").find("td:eq(1)").text().trim();
    var name = $(this).closest("tr").find("td:eq(2)").text().trim();
    var book = $(this).closest("tr").find("td:eq(3)").text().trim();
    var price = $(this).closest("tr").find("td:eq(4)").text().trim();
    var des = $(this).closest("tr").find("td:eq(6)").text().trim();
    let amount = parseInt(price.replace(/\./g, '').replace('₫', ''), 10);


    var bodyContainer = document.querySelector(".body__container");
    bodyContainer.classList.add("form-add-is-open");
    var addFormEdit = document.createElement("div");
    addFormEdit.className = "list__form";
    bodyContainer.appendChild(addFormEdit);
    addFormEdit.innerHTML = `
    <form action="" method="post" id="form-add-book" class="list__form-add" style="height: 590px;">
             <div class="list__form-title">
                <span><i class="fa-solid fa-file-invoice-dollar icon"></i></i> Chỉnh sửa phiếu phạt</span><i class="fa-solid fa-xmark close-icon"
                onclick="closeFormAdd()"></i>
            </div>
                <div class="list__form-content"style="display: block">
                    <div class="list__add-handmade" style="display: flex;">
                        <div class="list__form-box" style="flex: 1;">
                            <label class="list__form-label">Độc giả</label>
                            <input type="text" value="${mssv}-${name}" class="list__form-input" style="background-color: rgb(239 239 239)" id="user" disabled>
                        </div>
                    </div>
                    <div class="list__add-handmade" style="display: flex;">
                        <div class="list__form-box" style="flex: 1;">
                            <label class="list__form-label">Sách mượn</label>
                            <input type="text" value="${book}" class="list__form-input" style="background-color: rgb(239 239 239)" id="book" disabled>
                        </div>
                    </div>
                     
                  <div class="list__add-handmade" style="display: flex;">
                        <div class="list__form-box" style="flex: 1;">
                            <label class="list__form-label">Số tiền phạt</label>
                            <input value="${amount}" type="text" class="list__form-input"  id="price" >
                        </div>
                    </div>
                   
                    <div class="list__add-handmade" style="display:flex">
                    <div class="list__form-box" style="flex: 1">
                        <label for="des" class="list__form-label">Lý do nộp phạt</label>
                        <textarea id="des" placeholder="Nhập lý do">${des}</textarea>
                    </div>
                </div>
                </div>
                  <input type="hidden" name="id_fine" id="idFine" value="${id}">
            <div class="list__form-btn">
                <button type="button" class="close-btn" onclick="closeFormAdd()">Đóng</button>
                <button type="button" name="add_fine" onclick="submitFineEdit()">Thêm</button>
            </div>
        </form>`;
});
