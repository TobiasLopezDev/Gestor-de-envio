let modalPdf = document.getElementById("modalPdfGen");
let createPdfBtn = document.getElementById("createPdf-btn-modal");
let cancelPdfBtn = document.getElementById("cancelPdf-btn-modal");

cancelPdfBtn.addEventListener('click' ,function (e){
    e.preventDefault();
    modalPdf.style.display = "none";
});


async function asyncCreatePdf(url, params) {
    const request = await fetch(url, {
        method: 'POST',
        body: params
    })

    const response = await request.json();

    return response;
}

createPdfBtn.addEventListener("click", async function(e){
//alert('click')
    e.preventDefault();

    params = new FormData();
    params.append('ordersId' , modalPdf.dataset.orders);

    let response = await asyncCreatePdf('/gestor-final/order/createpdf' , params);

  //console.log('redirect')
    if (response.status == 200) {
      //console.log('redirect')
        window.open('/gestor-final/downloadpdf/' + response.url , '_blank');

        modalPdf.style.display = "none";
    }
})