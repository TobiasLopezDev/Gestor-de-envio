var infoShipping = document.getElementById("tableBodyOrders");
var arrows = document.getElementsByClassName("arrow-hidden");

let modalExcel = document.getElementById("modalExcelGen");
let createExcelBtn = document.getElementById("createExcel-btn-modal");
let cancelExcelBtn = document.getElementById("cancelExcel-btn-modal");

for (var i = 0; i < arrows.length; i++) {
    arrows[i].addEventListener('click', hiddenShowElement, false);
}

function hiddenShowElement() {
    target = this.dataset.hiddenTarget;

    arrowClass = this.classList;
    targetClass = document.getElementById(target).classList;

    targetClass.toggle('hidden')
    arrowClass.toggle('rotate-180')
}






// TODAS COSAS DEL XLSX
createExcelBtn.addEventListener('click', async function () {

    ordersAction = modalExcel.dataset.orders;
    checkboxOptions = document.querySelectorAll('.checkboxExcel');

    options = [];

    for (const item of checkboxOptions) {
        if (item.checked) {

            options.push(item.name)

        }
    }

    params = new FormData;
    params.append('orders', ordersAction);
    params.append('filters', options);

    let request = await asyncCreateCExcel('http://localhost/gestor-final/orders/genXLSX', params);


    if (request.status == 200) {
        window.open('http://localhost/gestor-final/download/'+ request.url, '_blank');
    }

});

cancelExcelBtn.addEventListener('click', function () {
    modalExcel.style.display = "none";
    document.getElementById("body").style.overflowY = "scroll";
})

async function asyncCreateCExcel(url, params) {
    const request = await fetch(url, {
        method: 'POST',
        body: params
    })

    const response = await request.json();

    return response;
}
