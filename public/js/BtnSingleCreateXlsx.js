let btnCreateXlsx = document.getElementById("descargarXLSX");
let modalExcel = document.getElementById("modalExcelGen");
let createExcelBtn = document.getElementById("createExcel-btn-modal");
let cancelExcelBtn = document.getElementById("cancelExcel-btn-modal");

btnCreateXlsx.addEventListener('click', function () {
    modalExcel.style.display = "flex";
    modalExcel.dataset.orderId = btnCreateXlsx.dataset.orderId;
    modalExcel.scrollIntoView();
    document.getElementById("body").style.overflowY = "hidden";
});

cancelExcelBtn.addEventListener('click', function () {
    modalExcel.style.display = "none";
    document.getElementById("body").style.overflowY = "scroll";
})

createExcelBtn.addEventListener('click' , async function(){

    checkboxOptions = document.querySelectorAll('.checkboxExcel');

    options = [];

    for (const item of checkboxOptions) {
        if (item.checked) {

            options.push(item.name)

        }
    }

    params = new FormData;
    params.append('orders', modalExcel.dataset.orderId);
    params.append('filters', options);

    let request = await asyncCreateCExcel('http://localhost/gestor-final/orders/genXLSX', params);


    if (request.status == 200) {
        window.open('http://localhost/gestor-final/download/'+ request.url, '_blank');
        document.getElementById("body").style.overflowY = "scroll";
        modalExcel.style.display = "none";
    }
})

async function asyncCreateCExcel(url, params) {
    const request = await fetch(url, {
        method: 'POST',
        body: params
    })

    const response = await request.json();

    return response;
}
