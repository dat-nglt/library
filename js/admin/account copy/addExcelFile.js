var bodyContainer = document.querySelector(".body__container");

function openFormAddExcel() {
    bodyContainer.classList.add("form-add-is-open");
    var addFormAdd = document.createElement("div");
    addFormAdd.className = "list__form";
    bodyContainer.appendChild(addFormAdd);
    addFormAdd.innerHTML = `
        <form action="" method="post" style="height: 180px" class="list__form-add">
            <div class="list__form-title">
                <span><i class="fa-solid fa-user"></i> Thêm tài khoản bằng excel</span><i class="fa-solid fa-xmark close-icon"
                onclick="closeFormAdd()"></i>
            </div>
            <div class="list__form-content">
                <div class="list__add-handmade">
                <input type="file" name="" id="file_excel" accept=".xlsx,.xls">
                </div>
            </div>
            <div class="list__form-btn">
                <button type="button" class="close-btn" onclick="closeFormAdd()">Đóng</button>
                <button type="button" onclick="postFileExcel()">Thêm</button>
            </div>
        </form>`;
}

function postFileExcel() {
  var file = $("#file_excel")[0].files[0];
  if (file === undefined) {
    Swal.fire({
      title: "Thông báo",
      text: "Vui lòng chọn file",
      icon: "warning",
      showConfirmButton: true,
    })
    return;
  }
    var reader = new FileReader();

    reader.onload = function(e) {
      var data = new Uint8Array(e.target.result);
      var workbook = XLSX.read(data, { type: 'array' });
      var sheetName = workbook.SheetNames[0];
      var worksheet = workbook.Sheets[sheetName];
      var jsonData = XLSX.utils.sheet_to_json(worksheet, { header: 1 });
      
      $.ajax({
        url: './services/admin/user/addExcel.php',
        method: 'POST',
        dataType: 'json',
        data: {
          file_data: jsonData
        },
      
        success: function(result) {
          Swal.fire({
            title: "Thông báo",
            text: result.msg,
            icon: result.status,
            showConfirmButton: true,
          }).then(function () {
      window.location.assign(result.path);
  });
        },
        error: function(xhr, textStatus, errorThrown) {
          Swal.fire({
            title: "Thông báo",
            text: "Thực hiện không thành công.",
            icon: "error",
            showConfirmButton: true,
          }).then(function () {
              window.location.assign("?controller=admin&action=account");
          });
        }
      });
    };

    reader.readAsArrayBuffer(file);
}
