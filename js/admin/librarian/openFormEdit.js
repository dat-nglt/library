$(document).on("click", ".list__action-open-edit", function () {
    var userId = $(this).data('id');
    var username = $(this).closest("tr").find("td:eq(1)").text().trim();
    var fullName = $(this).closest("tr").find("td:eq(2)").text().trim();
    var phoneNumber = $(this).closest("tr").find("td:eq(3)").text().trim();
    var email = $(this).closest("tr").find("td:eq(4)").text().trim();
    var className = $(this).closest("tr").find("td:eq(5)").text().trim();

    var bodyContainer = document.querySelector(".body__container");
    bodyContainer.classList.add("form-add-is-open");
    var addFormEdit = document.createElement("div");
    addFormEdit.className = "list__form";
    bodyContainer.appendChild(addFormEdit);
    addFormEdit.innerHTML = `
        <form action="?controller=admin&action=librarian" method="post" style="height: 350px" class="list__form-add">
            <div class="list__form-title">
                <span><i class="fa-solid fa-user"></i> Chỉnh sửa tài khoản</span><i class="fa-solid fa-xmark close-icon"
                onclick="closeFormAdd()"></i>
            </div>
            <div class="list__form-content">
                <div class="list__add-handmade">
                    <div class="list__form-box">
                        <label for="input-username" class="list__form-label">MSSV <span>*</span></label>
                        <input type="text" class="list__form-input" value="${username}" name="username_user" required id="input-username"
                            placeholder="Nhập mã số sinh viên">
                    </div>
                    <div class="list__form-box">
                        <label for="input-name" class="list__form-label">Họ tên <span>*</span></label>
                        <input type="text" class="list__form-input" name="name_user" value="${fullName}" required id="input-name"
                            placeholder="Nhập họ tên">
                    </div>
                    <div class="list__form-box">
                        <label for="input-phone-number" class="list__form-label">Số điện thoại <span>*</span></label>
                        <input type="number" class="list__form-input" name="phone-number_user" value="${phoneNumber}" required id="input-phone-number"
                            placeholder="Nhập số điện thoại">
                    </div>
                    <div class="list__form-box">
                        <label for="input-email" class="list__form-label">Email <span>*</span></label>
                        <input type="email" class="list__form-input" name="email_user" value="${email}" required id="input-email"
                            placeholder="Nhập email">
                    </div>
                    <div class="list__form-box">
                        <label for="input-class" class="list__form-label">Lớp <span>*</span></label>
                        <input type="text" class="list__form-input" name="class_user" value="${className}" required id="input-class" 
                            placeholder="Nhập lớp">
                    </div>
                    <div class="list__form-box" id="password-admin">
                        <label for="input-password" class="list__form-label">Mật khẩu mới</label>
                        <input type="password" class="list__form-input" name="password_user" id="input-password" 
                            placeholder="Nhập mật khẩu">
                        <span onclick="showPassword()"><i id="eye-admin" class="fa-solid fa-eye"></i></span>
                    </div>
                    <input type="hidden" value="${userId}" name="id_user">
                </div>
            </div>
            <div class="list__form-btn">
                <button type="button" class="close-btn" onclick="closeFormAdd()">Đóng</button>
                <button type="submit" name="edit_librarian-handmade">Chỉnh sửa</button>
            </div>
        </form>`;
});
