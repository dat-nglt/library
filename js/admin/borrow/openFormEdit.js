$(document).on(
  'click',
  '.list__action-open-edit',
  function () {
    var id = $(this).data('id')
    var user = $(this)
      .closest('tr')
      .find('td:eq(1)')
      .text()
      .trim()
    var book = $(this)
      .closest('tr')
      .find('td:eq(2)')
      .text()
      .trim()
    var status = $(this)
      .closest('tr')
      .find('td:eq(3)')
      .text()
      .trim()
    var timeRequest = $(this)
      .closest('tr')
      .find('td:eq(4)')
      .text()
      .trim()
    var timeBorrow = $(this)
      .closest('tr')
      .find('td:eq(5)')
      .text()
      .trim()
    var timeReturn = $(this)
      .closest('tr')
      .find('td:eq(6)')
      .text()
      .trim()
    var bodyContainer =
      document.querySelector(
        '.body__container'
      )
    var selectStatus =
      document.querySelector(
        '#status-borrow'
      )
    var optionSelectStatus = ''
    var optionBook = ''
    var optionUser = ''
    if (listBook.length > 0) {
      for (
        var i = 0;
        i < listBook.length;
        i++
      ) {
        if (listBook[i][1] === book) {
          optionBook +=
            '<option value="' +
            listBook[i][0] +
            '" selected>' +
            listBook[i][1] +
            '</option>'
        } else {
          optionBook +=
            '<option value="' +
            listBook[i][0] +
            '">' +
            listBook[i][1] +
            '</option>'
        }
      }
    }

    if (status === 'Đang mượn') {
      newTime =
        '<button name="new_time">Gia hạn</button>'
    } else {
      newTime = ''
    }

    if (listUser.length > 0) {
      for (
        var i = 0;
        i < listUser.length;
        i++
      ) {
        if (listUser[i][1] === user) {
          optionUser +=
            '<option value="' +
            listUser[i][0] +
            '" selected>' +
            listUser[i][1] +
            ' - ' +
            listUser[i][3] +
            '</option>'
        } else {
          optionUser +=
            '<option value="' +
            listUser[i][0] +
            '">' +
            listUser[i][1] +
            ' - ' +
            listUser[i][3] +
            '</option>'
        }
      }
    }

    if (
      selectStatus.options.length > 1
    ) {
      for (
        var i = 1;
        i < selectStatus.options.length;
        i++
      ) {
        var option =
          selectStatus.options[i]
        if (option.text === status) {
          optionSelectStatus +=
            '<option value="' +
            option.value +
            '" selected>' +
            option.text +
            '</option>'
        } else {
          optionSelectStatus +=
            '<option value="' +
            option.value +
            '">' +
            option.text +
            '</option>'
        }
      }
    }

    bodyContainer.classList.add(
      'form-add-is-open'
    )
    var addFormEdit =
      document.createElement('div')
    addFormEdit.className = 'list__form'
    bodyContainer.appendChild(
      addFormEdit
    )
    addFormEdit.innerHTML = `
        <form action="?controller=admin&action=borrow" method="post" class="list__form-add" style="height: 450px;">
    <div class="list__form-title">
        <span><i class="fa-solid fa-book icon"></i> Chỉnh sửa phiếu mượn</span><i class="fa-solid fa-xmark close-icon"
        onclick="closeFormAdd()"></i>
    </div>
    <div class="list__form-content"style="display: block">
        <div class="list__add-handmade" style="display: flex ">
            <div class="list__form-box" style="flex: 1">
                <label class="list__form-label">Độc giả</label>
                    <select name="user_borrow">
                    ${optionUser}
                    </select>
            </div>
        </div>
        <div class="list__add-handmade" style="display: flex">
            <div class="list__form-box" style="flex: 1">
                <label class="list__form-label">Tên sách mượn</label>
                    <select name="book_borrow">
                    ${optionBook}
                    </select>
            </div>
        </div>
        <div class="list__add-handmade">
            <div class="list__form-box">
                    <label class="list__form-label">Ngày yêu cầu mượn</label>
                    <input type="text" class="list__form-input" value="${timeRequest}" readonly>
            </div>
            <div class="list__form-box">
                <label for="input-date-book" class="list__form-label">Ngày mượn</label>
                <input type="text" class="list__form-input" name="time_borrow" value="${timeBorrow}" readonly>
            </div>
        </div>
        <div class="list__add-handmade">
            <div class="list__form-box">
                    <label class="list__form-label">Trạng thái</label>
                    <select name="status_borrow">
                    ${optionSelectStatus}
                    </select>
            </div>
            <div class="list__form-box">
                <label for="input-date-book" class="list__form-label">Ngày hết hạn mượn</label>
                <input type="text" class="list__form-input" value="${timeReturn}" readonly>
            </div>
        </div>
        <input type="hidden" name="id_borrow" value="${id}">
    </div>
    <div class="list__form-btn">
        <button type="button" class="close-btn" onclick="closeFormAdd()">Đóng</button>
        ${newTime}
        <button name="edit-borrow">Xác nhận</button>
    </div>
</form>`
  }
)
