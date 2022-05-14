

let modalFulfillments = document.getElementById("modalFulfillments");
let createFulfillmentsBtn = document.getElementById("createFulfillments-btn-modal");
let cancelFulfillmentsBtn = document.getElementById("cancelFulfillments-btn-modal");

cancelFulfillmentsBtn.addEventListener('click' ,function (e){
    e.preventDefault();
    modalFulfillments.style.display = "none";
});

async function asyncCreateFulfillments(url, params) {
    const request = await fetch(url, {
        method: 'POST',
        body: params
    })

    const response = await request.json();

    return response;
}