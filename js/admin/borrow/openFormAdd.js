var bodyContainer = document.querySelector(".body__container");
var selectedBooks = []; // Mảng lưu trữ sách đã chọn
var selectedUserId = ""; // Biến lưu trữ ID độc giả đã chọn

function openFormAdd() {
  bodyContainer.classList.add("form-add-is-open");
  var addFormAdd = document.createElement("div");
  addFormAdd.className = "list__form";
  bodyContainer.appendChild(addFormAdd);

  addFormAdd.innerHTML = `
        <form action="" method="post" class="list__form-add" style="height: 500px;" onsubmit="return updateBooksInput(event)">
            <div class="list__form-title">
                <span><i class="fa-solid fa-book icon"></i> Thêm phiếu mượn</span>
                <i class="fa-solid fa-xmark close-icon" onclick="closeFormAdd()"></i>
            </div>
            <div class="list__form-content" style="display: block">
                <div class="list__add-handmade" style="display: flex">
                    <div class="list__form-box" style="flex: 1">
                        <label class="list__form-label">MSSV</label>
                        <input type="text" name="user-input" id="user-input" placeholder="Nhập mã số sinh viên..." oninput="filterUsers()" />
                        <ul id="user-suggestions" style="z-index: 998; top: 60px; border-radius: 8px; list-style-type: none; padding: 0; border: 1px solid #ddd; display: none; position: absolute; background: white; max-height: 150px; overflow-y: auto;"></ul>
                        <input type="hidden" name="user-id" id="user-id-input" /> <!-- Input ẩn cho ID người dùng -->
                    </div>
                </div>
                <div class="list__add-handmade" style="display: flex">
                    <div class="list__form-box" style="flex: 1">
                        <label class="list__form-label">Sách cần mượn</label>
                        <input type="text" name="book-input" id="book-input" placeholder="Nhập tên sách..." oninput="filterBooks()" />
                        <ul id="suggestions" style="z-index: 999; top: 60px; border-radius: 8px; list-style-type: none; padding: 0; border: 1px solid #ddd; display: none; position: absolute; background: white; max-height: 150px; overflow-y: auto;"></ul>
                    </div>
                </div>
                <div class="list__added-books">
                    <h4>Sách đã chọn:</h4>
                    <ul id="selected-books-list" style="list-style-type: none; padding: 0;"></ul>
                     <input type="hidden" name="books" id="books-input" />
                </div>
            </div>
            <div class="list__form-btn">
                <button type="button" class="close-btn" onclick="closeFormAdd()">Đóng</button>
                <button type="submit" name="add-borrow">Thêm</button>
            </div>
        </form>`;
}

function filterUsers() {
  const input = document.getElementById("user-input");
  const filter = input.value.toLowerCase();
  const suggestions = document.getElementById("user-suggestions");
  suggestions.innerHTML = ""; // Xóa gợi ý trước đó
  suggestions.style.display = "none"; // Ẩn gợi ý ban đầu

  if (filter) {
    const matchedUsers = listUser
      .filter((user) => user[1].toLowerCase().includes(filter))
      .slice(0, 10);
    matchedUsers.forEach((user) => {
      const li = document.createElement("li");
      li.textContent = user[1]; // Hiển thị mã số sinh viên
      li.style.padding = "10px";
      li.style.cursor = "pointer";
      li.style.borderBottom = "1px solid #ddd";
      li.onmouseover = () => (li.style.backgroundColor = "#f0f0f0");
      li.onmouseout = () => (li.style.backgroundColor = "");
      li.onclick = () => selectUser(user); // Gọi với cả ID và mã số sinh viên
      suggestions.appendChild(li);
    });

    if (matchedUsers.length > 0) {
      suggestions.style.display = "block";
    }
  }
}

function filterBooks() {
  const input = document.getElementById("book-input");
  const filter = input.value.toLowerCase();
  const suggestions = document.getElementById("suggestions");
  suggestions.innerHTML = "";

  if (filter) {
    const matchedBooks = listBook
      .filter((book) => book[1].toLowerCase().includes(filter))
      .slice(0, 10);

    matchedBooks.forEach((book) => {
      const li = document.createElement("li");
      li.textContent = book[1]; // Tên sách
      li.style.padding = "10px";
      li.style.cursor = "pointer";
      li.style.borderBottom = "1px solid #ddd";
      li.onmouseover = () => (li.style.backgroundColor = "#f0f0f0");
      li.onmouseout = () => (li.style.backgroundColor = "");
      li.onclick = () => selectBook(book); // Gọi với cả ID và tên

      suggestions.appendChild(li);
    });

    if (matchedBooks.length > 0) {
      suggestions.style.display = "block"; // Hiển thị khi có gợi ý
    } else {
      suggestions.style.display = "none"; // Ẩn khi không có gợi ý
    }
  } else {
    suggestions.style.display = "none"; // Ẩn nếu không có nội dung trong input
  }
}

function selectBook(book) {
  const bookId = book[0]; // ID sách
  const bookName = book[1]; // Tên sách

  if (!selectedBooks.includes(bookId)) {
    selectedBooks.push(bookId); // Lưu ID sách vào mảng

    // Hiển thị danh sách đã chọn
    const selectedBooksList = document.getElementById("selected-books-list");
    const li = document.createElement("li");
    li.textContent = bookName; // Hiển thị tên sách
    li.style.padding = "5px";
    li.style.display = "flex";
    li.onmouseover = () => (li.style.backgroundColor = "#f0f0f0");
    li.onmouseout = () => (li.style.backgroundColor = "");
    li.style.justifyContent = "center";

    const deleteButton = document.createElement("div");
    deleteButton.textContent = "x";
    deleteButton.style.color = "red";
    deleteButton.style.cursor = "pointer";
    deleteButton.style.marginLeft = "10px";
    deleteButton.onclick = () => removeBook(bookId, li); // Xóa theo ID

    li.appendChild(deleteButton);
    selectedBooksList.appendChild(li);
  }

  // Đặt lại input sách
  const input = document.getElementById("book-input");
  input.value = "";
  document.getElementById("suggestions").innerHTML = "";
  document.getElementById("suggestions").style.display = "none";
}

// Hàm để xóa ID sách khỏi mảng
function removeBook(bookId, liElement) {
  selectedBooks = selectedBooks.filter((id) => id !== bookId); // Xóa ID sách khỏi mảng
  liElement.remove(); // Xóa phần tử HTML
}

function selectUser(user) {
  const userId = user[0]; // Giả sử user[0] là ID người dùng
  const userName = user[1]; // Giả sử user[1] là mã số sinh viên
  const input = document.getElementById("user-input");

  input.value = userName; // Hiển thị mã số sinh viên
  selectedUserId = userId; // Lưu ID người dùng
  document.getElementById("user-suggestions").innerHTML = "";
  document.getElementById("user-suggestions").style.display = "none";
}

function closeFormAdd() {
  bodyContainer.classList.remove("form-add-is-open");
  const form = document.querySelector(".list__form");
  if (form) {
    bodyContainer.removeChild(form);
  }
}

function updateBooksInput(event) {
  const userInput = document.getElementById("user-input").value.trim();
  const bookInput = document.getElementById("book-input").value.trim();

  // Kiểm tra nếu trường MSSV hoặc tên sách bị bỏ trống
  if (userInput === "") {
    Swal.fire({
      title: "Thông báo",
      text: "Vui lòng nhập mã số sinh viên.",
      icon: "warning",
      showConfirmButton: true,
    });
    event.preventDefault(); // Ngăn chặn gửi biểu mẫu
    return false; // Trả về false
  }

  if (selectedBooks.length === 0) {
    Swal.fire({
      title: "Thông báo",
      text: "Vui lòng chọn ít nhất một sách.",
      icon: "warning",
      showConfirmButton: true,
    });
    event.preventDefault(); // Ngăn chặn gửi biểu mẫu
    return false; // Trả về false
  }

  // Nếu tất cả đều hợp lệ, cập nhật giá trị vào các input ẩn
  document.getElementById("books-input").value = JSON.stringify(selectedBooks);
  document.getElementById("user-id-input").value = selectedUserId; // Thêm ID người dùng vào input ẩn
  return true; // Trả về true để cho phép gửi biểu mẫu
}
