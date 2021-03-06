
var infoShipping = document.getElementById("main-info-shipping");
var createShipping = document.getElementById("create-info-shipping");
var inputTracking = document.getElementById("inputTrackingCode");

document.getElementById("buttonCreateShipping").addEventListener('click',function ()
{

    infoShipping.classList.add("hidden");

    createShipping.classList.remove("hidden");
    
}  ); 

document.getElementById("cancelCreateShipping").addEventListener('click',function ()
{

    infoShipping.classList.remove("hidden");

    createShipping.classList.add("hidden");

}  ); 

document.getElementById("checkTracking").addEventListener('change',function ()
{
    
    if(true == document.getElementById("checkTracking").checked){
        inputTracking.setAttribute("disabled" , '');
    }
    else{
        inputTracking.removeAttribute("disabled");
    }

    
}  );


document.getElementById("tracking_number").addEventListener('submit',function (e)
{
    e.preventDefault();

    chState(document.getElementById("checkTracking"))
    chState(document.getElementById("checkNotification"))

    let params = new FormData(  document.getElementById('tracking_number') );

    asynPOST('http://localhost/gestor-final/create/shipping' , params );

}  ); 

function chState(element)
{
    if(element.checked) 
        element.value='true'; 
   else
       element.value='false';
}

async function asynPOST(url , params){
    const call = await fetch(url , {
        method : 'POST',
        body : params
    })
    .then(response => response.json())
    .then(response => {
        return true;
    });

    
  }