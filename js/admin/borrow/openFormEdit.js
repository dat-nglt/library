$(document).on("click", ".list__action-open-edit", function () {
  var id = $(this).data("id");
  var userID = $(this).closest("tr").find("td:eq(2)").text().trim();
  var fullName = $(this).closest("tr").find("td:eq(3)").text().trim();
  var Idname = userID + " - " + fullName;
  var created_at = $(this).closest("tr").find("td:eq(5)").text().trim();
  var status = $(this).closest("tr").find("td:eq(4)").text().trim(); // Extract current status
  var selectStatus = document.querySelector("#status-borrow");
  var optionSelectStatus = "";

  if (selectStatus.options.length > 1) {
      for (var i = 1; i < selectStatus.options.length; i++) {
          var option = selectStatus.options[i];

          // Skip "Quá hạn" and "Hoàn thành"
          if (option.text === "Quá hạn" || option.text === "Hoàn thành") {
              continue; // Skip this iteration
          }

          // Set selected status
          if (option.text === status) {
              optionSelectStatus +=
                  '<option value="' +
                  option.value +
                  '" selected>' +
                  option.text +
                  "</option>";
          } else {
              optionSelectStatus +=
                  '<option value="' + option.value + '">' + option.text + "</option>";
          }
      }
  }

  var bodyContainer = document.querySelector(".body__container");
  bodyContainer.classList.add("form-add-is-open");
  var addFormEdit = document.createElement("div");
  addFormEdit.className = "list__form";
  bodyContainer.appendChild(addFormEdit);

  addFormEdit.innerHTML = `
      <form action="" method="post" class="list__form-add" style="height: fit-content;">
          <div class="list__form-title">
              <span><i class="fa-solid fa-book icon"></i> Chỉnh sửa phiếu mượn</span>
              <i class="fa-solid fa-xmark close-icon" onclick="closeFormAdd()"></i>
          </div>
          <div class="list__form-content" style="display: block">
              <div class="list__add-handmade" style="display: flex;">
                  <div class="list__form-box" style="width: 100%;">
                      <label class="list__form-label">Mã yêu cầu</label>
                      <input type="text" class="list__form-input" name="id_borrow" value="${id}" readonly>
                  </div>
              </div>
              <div class="list__add-handmade" style="display: flex;">
                  <div class="list__form-box" style="width: 100%;">
                      <label class="list__form-label">Độc giả</label>
                      <input type="text" class="list__form-input" value="${Idname}" readonly>
                  </div>
              </div>
              <div class="list__add-handmade" style="display: flex;">
                  <div class="list__form-box" style="width: 100%;">
                      <label class="list__form-label">Ngày yêu cầu</label>
                      <input type="text" class="list__form-input" value="${created_at}" readonly>
                  </div>
              </div>
              <div class="list__add-handmade" style="display: flex;">
                  <div class="list__form-box" style="width: 100%;">
                      <label class="list__form-label">Trạng thái</label>
                      <select name="status_borrow">
                          ${optionSelectStatus}
                      </select>
                  </div>
              </div>
              <div class="list__form-btn" style="display: flex; justify-content: flex-end; position: relative;">
                  <button type="button" class="close-btn" onclick="closeFormAdd()">Đóng</button>
                  <button name="edit-borrow">Xác nhận</button>
              </div>
          </div>
      </form>`;
});