

let modalShippings = document.getElementById("modalShippings");
let createShippingsBtn = document.getElementById("createShippings-btn-modal");
let cancelShippingsBtn = document.getElementById("cancelShippings-btn-modal");
let inputTracking = document.getElementById("inputTrackingCode");

function ModalShippingsView() {

    modalShippings.style.display = "flex";
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