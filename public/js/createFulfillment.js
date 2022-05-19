var createFulfill = document.getElementById("buttonCreateFulfillment");


var botonera = document.getElementById("botonera");

var formCreateFulfillment = document.getElementById("form-create-fulfillment");


var cancelCreateFulfillments = document.getElementById("cancelCreateFulfillments");

// var modalEliminate = document.getElementById("");


createFulfill.addEventListener('click', function () {
    //console.log(createFulfill.dataset.orderId);

    botonera.classList.add("hidden");

    formCreateFulfillment.parentNode.classList.remove("hidden");

    document.getElementById("orderIdForm").setAttribute("value", createFulfill.dataset.orderId);


});


cancelCreateFulfillments.addEventListener('click', function () {

    botonera.classList.remove("hidden");
    formCreateFulfillment.parentNode.classList.add("hidden");

    formCreateFulfillment.reset();


});

formCreateFulfillment.addEventListener('submit', async function (e) {
    e.preventDefault();

    let params = new FormData(formCreateFulfillment);
    //console.log("validando...")
    //console.log(params.values())

    if (valideteFormFulfillments(params)) {
       let response = await asynPOST('http://localhost/gestor-final/single/postFulfillments', params);
       if(response.status == 201){
        location.reload();
       }
       else{

       }
    }
    else {
        //console.log("invalido")
    }

})

async function asynPOST(url, params) {
    const call = await fetch(url, {
        method: 'POST',
        body: params
    })
    
    const response = await call.json();

    return response;

}

window.onload = function () {
    const titleFulfillments = document.querySelectorAll('.timeline-title span');

    [].forEach.call(titleFulfillments, function (title) {
        //console.log(title.innerHTML)

        switch (title.innerHTML) {
            case 'dispatched':
                title.innerHTML = 'Despachado'
                break;

            case 'received_by_post_office':
                title.innerHTML = 'Recibido por la oficina de correos'
                break;

            case 'in_transit':
                title.innerHTML = 'En tránsito'
                break;

            case 'out_for_delivery':
                title.innerHTML = 'Fuera para entrega'
                break;

            case 'delivery_attempt_failed':
                title.innerHTML = 'Intento de entrega fallido'
                break;

            case 'delayed':
                title.innerHTML = 'Demorado'
                break;

            case 'ready_for_pickup':
                title.innerHTML = 'Listo para recoger'
                break;

            case 'delivered':
                title.innerHTML = 'Entregado'
                break;

            case 'returned_to_sender':
                title.innerHTML = 'Devuelto a emisor'
                break;

            case 'lost':
                title.innerHTML = 'Perdido'
                break;

            case 'failure':
                title.innerHTML = 'Falla'
                break;

            default:
                break;
        }
    });
};

// function valideteFormFulfillments(formData) {
//     inputNoValidate = [];

//     for (var key of formData.keys()) {
//         if (key == 'inputDescription') {
            
//         }
//         else {
//             if (formData.get(key) == '') {
//                 inputNoValidate.push(key)
//                 document.getElementById(key).setAttribute("aria-invalid", "true");
//                 document.getElementById(key).classList.add("border-red-700");
//                 //console.log(key + "add class" )
//             }
//         }
//     }

//     if (inputNoValidate.length > 0) {
//         //console.log(inputNoValidate)
//         return false
//     }
//     else {
//         //console.log(inputNoValidate)
//         return true;
//     }

// }


