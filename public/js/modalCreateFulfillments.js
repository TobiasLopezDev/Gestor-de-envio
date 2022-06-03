

let modalFulfillments = document.getElementById("modalFulfillments");
let createFulfillmentsBtn = document.getElementById("createFulfillments-btn-modal");
let cancelFulfillmentsBtn = document.getElementById("cancelFulfillments-btn-modal");
let formCreateFulfillment = document.getElementById("form-create-fulfillment");

let modalBodyFulfillments = document.getElementById("modalBodyFulfillments");
let titleFulfillments = document.getElementById("titleFulfillments");
let containerFulfillemnts = document.getElementById("containerFulfillemnts");
let loaderFulfillments = document.getElementById("loaderFulfillments");
let botoneraFulfillments = document.getElementById("botoneraFulfillments");

cancelFulfillmentsBtn.addEventListener('click', function (e) {
    e.preventDefault();
    modalFulfillments.style.display = "none";

    location.reload();
});

createFulfillmentsBtn.addEventListener('click', async function (event) {
    event.preventDefault();
    ordersAction = modalFulfillments.dataset.orders;

    params = new FormData(formCreateFulfillment);
    params.append('ordersId', ordersAction);

    if (valideteFormFulfillments(params)) {
        containerFulfillemnts.classList.add("hidden");
        botoneraFulfillments.classList.add("hidden");
        loaderFulfillments.classList.remove("hidden");

        let response = await asyncCreateFulfillments('http://localhost/gestor-final/orders/createFulfillments', params);

        if (response.code == 201) {
            titleFulfillments.innerHTML = "Estado de envio creados";
            containerFulfillemnts.innerHTML = "";
            response.success.forEach(order => {
                var divResponse = document.createElement("div");
                divResponse.innerHTML = '<p>Order #' + order.numberOrder + ' actualizada con exito.</p>'
                containerFulfillemnts.appendChild(divResponse);
            });
            createFulfillmentsBtn.classList.add("hidden");
            loaderFulfillments.classList.add("hidden");

            botoneraFulfillments.classList.remove("hidden");
            containerFulfillemnts.classList.remove("hidden");
        }
        else {
        }
    }
    else {

    }

});

async function asyncCreateFulfillments(url, params) {
    const request = await fetch(url, {
        method: 'POST',
        body: params
    })

    const response = await request.json();

    return response;
}

function valideteFormFulfillments(formData) {
    inputNoValidate = [];

    for (var key of formData.keys()) {
        if (key == 'inputDescription') {
        }
        else {
            if (formData.get(key) == '') {
                inputNoValidate.push(key)
                document.getElementById(key).classList.add("ring-1");
                document.getElementById(key).classList.add("ring-red-700");
                document.getElementById(key).classList.add("ring-offset-2");
            } else {
                // formData.get(key)
                // document.getElementById(key).classList.remove("ring-1");
                // document.getElementById(key).classList.remove("ring-red-700");
                // document.getElementById(key).classList.remove("ring-offset-2");
            }
        }
    }

    if (inputNoValidate.length > 0) {
        return false
    }
    else {
        //console.log(inputNoValidate)
        return true;
    }

}