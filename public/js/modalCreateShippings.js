

let modalShippings = document.getElementById("modalShippings");
let createShippingsBtn = document.getElementById("createShippings-btn-modal");
let cancelShippingsBtn = document.getElementById("cancelShippings-btn-modal");
let inputTracking = document.getElementById("inputTrackingCode");

let loaderShippings = document.getElementById("loader-shippings");
let modalBodyShippings = document.getElementById("modalBody");

function ModalShippingsView(checkedItems) {

    modalShippings.style.display = "flex";
    modalShippings.dataset.ordersId = checkedItems;
    modalShippings.scrollIntoView();

    document.getElementById("checkTracking").addEventListener('change', function () {

        if (true == document.getElementById("checkTracking").checked) {
            inputTracking.setAttribute("disabled", '');
        }
        else {
            inputTracking.removeAttribute("disabled");
        }


    });
}

cancelShippingsBtn.addEventListener('click' ,function (e){
    e.preventDefault();
    modalShippings.style.display = "none";
});

async function asyncCreateShippings(url, params) {
    const request = await fetch(url, {
        method: 'POST',
        body: params
    })

    const response = await request.json();

    return response;
}

createShippingsBtn.addEventListener('click', async function (e){
    e.preventDefault();

    var form = document.getElementById("tracking_number");
    var ordersId = modalShippings.dataset.ordersId;

    chState(document.getElementById("checkTracking"))
    chState(document.getElementById("checkNotification"))



    params = new FormData(form);
    params.append('ordersId' , ordersId )
    

    loaderShippings.style.display = "flex";
    modalBodyShippings.style.display = "hidden";
    response = await asyncCreateShippings('/gestor-final/order/createshippings' , params);

    console.log(response.status)

    if(response.status == 200){
        location.reload();
    }else{

    }
});


function chState(element)
{
    if(element.checked) 
        element.value='true'; 
   else
       element.value='false';
}