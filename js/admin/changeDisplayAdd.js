function changeFormHandmade(){
    var addHandmade = document.querySelector('.list__nav-add-handmade');
    var addExcel = document.querySelector('.list__nav-add-excel');
    var formContentHandmade = document.querySelector('.list__add-handmade');
    var formContentExcel = document.querySelector('.list__add-file-excel');

    if(addExcel.classList.contains('nav-selected')){
        addExcel.classList.add('nav-selected');
    }
    if(formContentExcel.classList.contains('close')){
        formContentExcel.classList.add('close');
    }

    addHandmade.classList.add('nav-selected');
   
}

function changeFormExcel(){
    var addHandmade = document.querySelector('.list__nav-add-handmade');
    var addExcel = document.querySelector('.list__nav-add-excel');
    var formContentHandmade = document.querySelector('.list__add-handmade');
    var formContentExcel = document.querySelector('.list__add-file-excel');

    if(addHandmade.classList.contains('nav-selected'))
}

function handleSelectClass() {
    var selectClass = document.querySelector(".list__select-class");
    var inputClass = document.querySelector(".list__select-class-input");
    var selectClassSelect = document.querySelector(".list__select-class-select");
    if (selectClass.value === "0") {
        selectClassSelect.style.display = "block";
        inputClass.style.display = "none";
    } else if (selectClass.value === "1") {
        selectClassSelect.style.display = "none";
        inputClass.style.display = "block";
    }
}
