function changeFormAdd(type){
    var addHandmade = document.querySelector('.list__nav-add-handmade');
    var addExcel = document.querySelector('.list__nav-add-excel');
    var formContentHandmade = document.querySelector('.list__add-handmade');
    var formContentExcel = document.querySelector('.list__add-file-excel');

    if(type === 'handmade'){
        addHandmade.classList.add('nav-selected')
        formContentHandmade.classList.remove('close');
        formContentHandmade.classList.add('open');
        if(addExcel.classList.contains('nav-selected')){
            addExcel.classList.remove('nav-selected');
            formContentExcel.classList.remove('open');
            formContentExcel.classList.add('close');
        }
    }else{
        addExcel.classList.add('nav-selected')
        formContentExcel.classList.remove('close');
        formContentExcel.classList.add('open');
        if(addHandmade.classList.contains('nav-selected')){
            addHandmade.classList.remove('nav-selected');
            formContentHandmade.classList.remove('open');
            formContentHandmade.classList.add('close');
        }
    }
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
