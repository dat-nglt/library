// Lấy các phần tử modal và nút mở
const modal = document.getElementById("myModal");
const openModalBtn = document.getElementById("openModalBtn");
const closeModalBtn = document.getElementById("closeModalBtn");
fetch
// Hàm mở modal
openModalBtn.onclick = function() {
    modal.style.display = "block";
}

// Hàm đóng modal khi nhấn vào nút đóng
closeModalBtn.onclick = function() {
    modal.style.display = "none";
}

// Đóng modal khi nhấn ra ngoài modal
window.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
}