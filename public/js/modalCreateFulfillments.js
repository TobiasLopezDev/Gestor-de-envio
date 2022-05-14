

let modalFulfillments = document.getElementById("modalFulfillments");
let createFulfillmentsBtn = document.getElementById("createFulfillments-btn-modal");
let cancelFulfillmentsBtn = document.getElementById("cancelFulfillments-btn-modal");
let formCreateFulfillment = document.getElementById("form-create-fulfillment");

cancelFulfillmentsBtn.addEventListener('click' ,function (e){
    e.preventDefault();
    modalFulfillments.style.display = "none";
});

createFulfillmentsBtn.addEventListener('click', function (event) {
    event.preventDefault();
    ordersAction = modalFulfillments.dataset.orders;

    params = new FormData(formCreateFulfillment);
    params.append('ordersId', ordersAction);

    for (var value of params.values()) {
        console.log(value);
     }

     if (valideteFormFulfillments(params)) {
         console.log('mandando solicitud')
        let response = asyncCreateFulfillments('http://localhost/gestor-final/orders/createFulfillments', params);
        if(response.status == 201){
        //   todo ok
        }
        else{
        //   todo mal
        }
     }
     else {
         console.log("invalido")

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
            }else{
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
        console.log(inputNoValidate)
        return true;
    }

}