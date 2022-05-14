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