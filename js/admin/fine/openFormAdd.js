var bodyContainer = document.querySelector(".body__container");

function openFormAdd() {
  var optionUser = "";

  if (listUser.length > 0) {
    for (var i = 0; i < listUser.length; i++) {
      optionUser +=
        '<option value="' +
        listUser[i][0] +
        '">' +
        listUser[i][1] +
        "-" +
        listUser[i][2] +
        "";
      ("</option>");
    }
  }

  bodyContainer.classList.add("form-add-is-open");
  var addFormAdd = document.createElement("div");
  addFormAdd.className = "list__form";
  bodyContainer.appendChild(addFormAdd);
  addFormAdd.innerHTML = `
            <form action="" method="post" id="form-add-book" class="list__form-add" style="height: 590px;">
             <div class="list__form-title">
                <span><i class="fa-solid fa-file-invoice-dollar icon"></i></i> Thêm phiếu phạt</span><i class="fa-solid fa-xmark close-icon"
                onclick="closeFormAdd()"></i>
            </div>
                <div class="list__form-content"style="display: block">
                    <div class="list__add-handmade" style="display: flex;">
                        <div class="list__form-box" style="flex: 1;">
                            <label class="list__form-label">Độc giả</label>
                            <select id="user_borrow" name="user_borrow">
                            ${optionUser}
                            </select>
                        </div>
                    </div>
                    <div class="list__add-handmade" style="display: flex;">
                        <div class="list__form-box" style="flex: 1;">
                            <label class="list__form-label">Sách mượn</label>
                            <select id="request" name="request">
                            </select>
                        </div>
                    </div>
                     <input type="hidden" class="list__form-input" id="idRequest" disabled>
                    <div class="list__add-handmade" style="display:flex">
                      <div class="list__form-box" style="margin-top: 10px">
                        <label for="day" class="list__form-label">Số ngày trễ hạn</label>
                        <input type="text" class="list__form-input" style="background-color: rgb(239 239 239)" id="day" disabled>
                    </div>
                    <div class="list__form-box" style="margin-top: 10px">
                        <label for="price" class="list__form-label">Số tiền phạt<span>*<small>(Mỗi ngày quá hạn phạt 2000 VNĐ)</small></span></label>
                        <input type="text" class="list__form-input" id="price" required
                            placeholder="Nhập số tiền phạt">
                    </div>
                    </div>
                    <div class="list__add-handmade" style="display:flex">
                    <div class="list__form-box" style="flex: 1">
                        <label for="input-des" class="list__form-label">Lý do nộp phạt</label>
                        <textarea id="input-des" placeholder="Nhập lý do"></textarea>
                    </div>
                </div>
                </div>
                
            <div class="list__form-btn">
                <button type="button" class="close-btn" onclick="closeFormAdd()">Đóng</button>
                <button type="button" name="add_fine" onclick="submitFine()">Thêm</button>
            </div>
        </form>`;
        $(document).ready(function() {
            function updateRequest(userId) {
                $('#request').empty();
                $.each(listRequest, function(index, request) {
                    if (request[0] === userId) {
                        $('#request').append('<option value="' + request[1] + '" data-day="' + request[4] + '" data-request="' + request[3] + '">' + request[2] + '</option>');
                    }
                });
                if ($('#request option').length > 0) {
                    $('#request').prop('selectedIndex', 0);
                    updateDayValue();
                    updatePriceValue();
                } else {
                    $('#day').val('');
                }
            }
        
            function updateDayValue() {
                const selectedOption = $('#request option:selected');
                const dayValue = selectedOption.data('day');
                const idRequest = selectedOption.data('request');
                const validDayValue = Math.max(dayValue, 0);
                $('#day').val(validDayValue);
                $('#idRequest').val(idRequest);
                
            }

            function updatePriceValue() {
                const totalDay = parseInt($('#day').val(), 10) || 0;
                const priceValue = totalDay * 2000;
                $('#price').val(priceValue);
            }
        
            const initialUserId = $('#user_borrow').val();
            updateRequest(initialUserId);
            
            $('#user_borrow').change(function() {
                updateRequest($(this).val());
                updateDayValue();
                updatePriceValue();
            });
        
            $('#request').change(function() {
                updateDayValue();
                updatePriceValue();
            });
        });
       
        const priceInput = document.getElementById('price');
        priceInput.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });


    
}
