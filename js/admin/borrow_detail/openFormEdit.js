$(document).on("click", ".updateRequestDetail", function () {
  var id = $(this).data("id");
  var returneDate = $(this)
    .closest(".book-item")
    .find("div.value-info div:eq(4) span")
    .text()
    .trim();

  // Lấy trạng thái hiện tại từ phần tử DOM
  var currentStatus = $(this)
    .closest(".book-item")
    .find("div.value-info div:eq(6) span")
    .text()
    .trim();
  var statusValue = currentStatus === "Đã trả" ? "1" : "0"; // Giả sử "Đã trả" là 1 và "Chưa trả" là 0

  var bodyContainer = $(".container-borrowdetail");
  bodyContainer.addClass("form-add-is-open");

  // Tạo phần tử modal
  var addFormEdit = $(`
        <div class="list__form" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; border-radius: 8px; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2); z-index: 1000; padding: 20px; width: 400px;">
            <form action="" method="post" class="list__form-add" style="height: fit-content;">
                <div class="list__form-title" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 10px; margin-bottom: 20px;">
                    <span style="font-weight: bold; color: #333;"><i class="fa-solid fa-book icon"></i> Cập nhật chi tiết mượn - trả</span>
                    <i class="fa-solid fa-xmark close-icon" onclick="closeFormAdd()" style="cursor: pointer; color: #ff5c5c;"></i>
                </div>
                <div class="list__add-handmade" style="display: flex; margin-bottom: 15px;">
                    <div class="list__form-box" style="width: 100%;">
                        <label class="list__form-label" style="font-weight: bold; margin-bottom: 5px; color: #333;">Ngày trả dự kiến</label>
                        <input type="text" name="returnDate" class="list__form-input" value="${returneDate}" readonly style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; transition: border-color 0.3s ease;">
                    </div>
                </div>
                <div class="list__add-handmade" style="display: flex; margin-bottom: 15px;">
                    <div class="list__form-box" style="width: 100%;">
                        <label class="list__form-label" style="font-weight: bold; margin-bottom: 5px; color: #333;">Trạng thái</label>
                        <select name="status_borrow" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; transition: border-color 0.3s ease;">
                            <option value="1" ${
                              statusValue === "1" ? "selected" : ""
                            }>Đã trả</option>
                            <option value="0" ${
                              statusValue === "0" ? "selected" : ""
                            }>Chưa trả</option>
                        </select>
                    </div>
                    <input type="hidden" name="idRequestDetail" value="${id}">
                </div>
                <div class="list__form-btn" style="display: flex; justify-content: flex-end; position: relative; margin-top: 20px;">
                    <button type="button" class="close-btn" onclick="closeFormAdd()" style="background-color: #f44336; color: white; border: none; border-radius: 4px; padding: 10px 15px; cursor: pointer; margin-right: 10px; transition: background-color 0.3s ease;">Đóng</button>
                    <button name="update-statusBorrowDetail" style="background-color: #007bff; color: white; border: none; border-radius: 4px; padding: 10px 15px; cursor: pointer; transition: background-color 0.3s ease;">Xác nhận</button>
                </div>
            </form>
        </div>
    `);

  // Thêm modal vào container
  bodyContainer.append(addFormEdit);
});

// Hàm đóng modal
function closeFormAdd() {
  $(".container-borrowdetail").removeClass("form-add-is-open");
  $(".list__form").remove(); // Xóa modal
}
