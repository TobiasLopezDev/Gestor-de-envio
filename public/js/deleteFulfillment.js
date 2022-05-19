let modal = document.getElementById("my-modal");
let elementsRemoveFulfill = document.getElementsByClassName("buttonEditFulfillment");
let deleteBtn = document.getElementById("delete-btn-modal");
let cancelBtn = document.getElementById("cancel-btn-modal");
let loader = document.querySelector('#loader')
let modalBody = document.querySelector('#modalBody')

deleteBtn.onclick = async function () {

    let params = new FormData();

    params.append('order_id', modal.dataset.orderId);
    params.append('fulfillments_id', modal.dataset.fulfillmentId); 

    //console.log(params.values())

    loader.style.display = 'block'
    modalBody.style.display = 'none'

    let request = await deleteFulfillmentsAsync('http://localhost/gestor-final/single/deletefulfillments' , params );

    loader.style.display = 'none'

    if(request.status == 201){
        //console.log("hecho");

        var elem = document.getElementById(modal.dataset.fulfillmentId);
        elem.parentNode.removeChild(elem);;
    }


   
    modalBody.style.display = 'block';
    loader.style.display = 'none';
    modal.style.display = "none";
    document.getElementById("body").style.overflowY = "scroll";
}

cancelBtn.onclick = function () {
    modal.style.display = "none";
    document.getElementById("body").style.overflowY = "scroll";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

for (var i = 0; i < elementsRemoveFulfill.length; i++) {
    elementsRemoveFulfill[i].addEventListener('click', removeFulfill, false);
}

function removeFulfill() {

    modal.style.display = "flex";
    modal.scrollIntoView()

    modal.dataset.orderId = createFulfill.dataset.orderId
    modal.dataset.fulfillmentId = this.dataset.fulfillId

    document.getElementById("body").style.overflowY = "hidden"; 


    //TODO: SEND POST ID AND GET FULFILLMENT VALUES
}


async function deleteFulfillmentsAsync(url , params) {
    const request = await fetch(url, {
        method: 'POST',
        body: params
    })

    const response = await request.json();

    return response;
  }