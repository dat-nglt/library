$(document).ready(function () {
  $("#request-Book").click(function () {
    const bid = $("#idBook").text();
    const bname = $("#nameBook").text();
    const category = $("#nameCategory").text();
    const author = $("#creatorBook").text();
    const totalQuantity = $("#quantityBook").text();
    const bookImg = $("#imgBook").attr("src");
    const qty = 1;

    // Check if the book is already in the cart
    $.ajax({
      url: "?controller=user&action=rentSticket",
      type: "POST",
      data: { CheckId: bid },
      dataType: "json",
      success: function (response) {
        // Assuming response returns true if the book exists
        if (response.exists) {
          Swal.fire({
            title: "Thông báo",
            text: "Sản phẩm đã tồn tại trong giỏ hàng.",
            icon: "warning",
            showConfirmButton: true,
          });
        } else {
          // Proceed to add the book to the cart
          $.ajax({
            url: "?controller=user&action=book_detail&id=" + bid,
            type: "POST",
            data: {
              bid: bid,
              bname: bname,
              category: category,
              author: author,
              bookImg: bookImg,
              totalQuantity: totalQuantity,
              qty: qty,
            },
            success: function () {
              Swal.fire({
                title: "Thông báo",
                text: "Upload tài liệu thành công",
                icon: "success",
                showConfirmButton: true,
              }).then(function () {
                window.location.assign(
                  "http://localhost/library/?controller=user&action=book_detail&id=" +
                    bid
                );
              });
            },
            error: function () {
              alert("Có lỗi xảy ra. Vui lòng thử lại!");
            },
          });
        }
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.error("Error checking book in cart:", textStatus, errorThrown);
        alert(
          "Có lỗi xảy ra trong việc kiểm tra giỏ hàng. Vui lòng thử lại!!!"
        );
      },
    });
  });
});