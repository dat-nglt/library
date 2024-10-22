$(document).on("click", ".list__action-open-edit", function () {
    var id = $(this).data('id');
    var title = $(this).closest("tr").find("td:eq(1)").text().trim();
    var image = $(this).closest("tr").find("td:eq(2) img").attr("src");
    var content = $(this).closest("tr").find("td:eq(3)").text().trim();

    if(image != ''){
        styleImg = 'style="width: 120px; height: 100px;"';
        heghtForm = '605px';
    }else{
        styleImg = '';
        heghtForm = '505px';
    }
    
    var bodyContainer = document.querySelector(".body__container");
    bodyContainer.classList.add("form-add-is-open");
    var addFormEdit = document.createElement("div");
    addFormEdit.className = "list__form";
    bodyContainer.appendChild(addFormEdit);
    addFormEdit.innerHTML = `
        <form action="" method="post" id="form-add-book" class="list__form-add" style="height: ${heghtForm};">
            <div class="list__form-title">
                <span><i class="fa-solid fa-newspaper"></i>Chỉnh sửa tin tức</span><i class="fa-solid fa-xmark close-icon"
                onclick="closeFormAdd()"></i>
            </div>
            <div class="list__form-content"style="display: block">
             <input type="hidden" id="id" value="${id}">
              <div class="list__add-handmade" style="display:flex">
                   <div class="list__form-box" style="flex: 1">
                    <label for="title" class="list__form-label">Tiêu đề<span>*</span></label>
                    <input type="text" class="list__form-input" value="${title}" id="title" required placeholder="Nhập tiêu đề">
                    </div>
                </div>
                <div class="list__add-handmade" style="padding: 10px 15px 0 15px;">
                    <div style="text-align: start;">
                        <div style="font-size: 18px; font-weight: 500; margin-bottom: 5px">Ảnh bìa</div>
                        <div style="display: flex; flex-direction: column;">
                            <div style="display: flex;justify-content: center; margin-bottom: 5px;" id="imgContainer"></div>
                            <img ${styleImg} id="oldimg" src="${image}" alt="">
                            <div class="select_avatar" style="display: block">
                                <input type="file" id="newImg" accept="image/*" onchange="changeImg(event)">
                                <button class="button_change" type="button">Chọn ảnh</button>
                            </div>
                        </div>
                    </div>
                    <div>
                </div>
                </div>
                <div class="list__add-handmade" style="display:flex">
                    <div style="flex: 1; text-align: start;">
                        <label style="font-size: 18px; font-weight: 500;" for="content" class="list__form-label">Nội dung</label>
                        <textarea id="content" placeholder="Nhập nội dung">${content}</textarea>
                    </div>
                </div>
            </div>
            <div class="list__form-btn">
                <button type="button" class="close-btn" onclick="closeFormAdd()">Đóng</button>
                <button type="button" onclick="submitNewsEdit()" name="add-news" >Thêm</button>
            </div>
        </form>`
        ClassicEditor
            .create(document.querySelector('#content'))
            .then(newEditor => {
                editor = newEditor;
            })
            .catch(error => {
                console.error(error);
            });
});
