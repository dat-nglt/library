var bodyContainer = document.querySelector(".body__container");

function openFormAdd() {
    bodyContainer.classList.add("form-add-is-open");
    var addFormAdd = document.createElement("div");
    addFormAdd.className = "list__form";
    bodyContainer.appendChild(addFormAdd);
    addFormAdd.innerHTML = `
        <form action="?controller=admin&action=librarian" method="post" style="height: 350px" class="list__form-add">
            <div class="list__form-title">
                <span><i class="fa-solid fa-user"></i> Thêm thủ thư</span><i class="fa-solid fa-xmark close-icon"
                onclick="closeFormAdd()"></i>
            </div>
            <div class="list__form-content">
                <div class="list__add-handmade">
                    <div class="list__form-box">
                        <label for="input-username" class="list__form-label">Tên đăng nhập <span>*</span></label>
                        <input type="text" class="list__form-input" name="username_user" required id="input-username"
                            placeholder="Nhập tên đăng nhập">
                    </div>
                    <div class="list__form-box">
                        <label for="input-name" class="list__form-label">Họ tên <span>*</span></label>
                        <input type="text" class="list__form-input" name="name_user" required id="input-name"
                            placeholder="Nhập họ tên">
                    </div>
                    <div class="list__form-box">
                        <label for="input-phone-number" class="list__form-label">Số điện thoại <span>*</span></label>
                        <input type="number" class="list__form-input" name="phone-number_user" required id="input-phone-number"
                            placeholder="Nhập số điện thoại">
                    </div>
                    <div class="list__form-box">
                        <label for="input-email" class="list__form-label">Email <span>*</span></label>
                        <input type="email" class="list__form-input" name="email_user" required id="input-email"
                            placeholder="Nhập email">
                    </div>
                    <div class="list__form-box">
                        <label for="input-class" class="list__form-label">Khoa <span>*</span></label>
                        <input type="text" class="list__form-input" name="class_user" required id="input-class" 
                            placeholder="Nhập khoa">
                    </div>
                    <div class="list__form-box" id="password-admin">
                        <label for="input-password" class="list__form-label">Mật khẩu <span>*</span></label>
                        <input type="password" class="list__form-input" name="password_user" required id="input-password" 
                            placeholder="Nhập mật khẩu">
                        <span onclick="showPassword()"><i id="eye-admin" class="fa-solid fa-eye"></i></span>
                    </div>
                </div>
            </div>
            <div class="list__form-btn">
                <button type="button" class="close-btn" onclick="closeFormAdd()">Đóng</button>
                <button type="submit" name="add_librarian-handmade">Thêm</button>
            </div>
        </form>`;
}
