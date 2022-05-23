let btnActualizar = document.getElementById("modifyUser");

let formUser = document.getElementById("userData");

let botonera = document.getElementById("botonera")
let btnUpdate = document.getElementById("updateUser")
let btnCancel = document.getElementById("cancelUser")

btnActualizar.addEventListener('click' , function (e){
    e.preventDefault();

    inputs = document.forms["userData"].getElementsByTagName("input");

    for (i=0; i<inputs.length; i++){
        inputs[i].disabled = false;
    }

    btnActualizar.style.display = 'none';
    botonera.classList.remove("hidden");
})

btnCancel.addEventListener('click' , function (e){
    e.preventDefault();

    inputs = document.forms["userData"].getElementsByTagName("input");

    for (i=0; i<inputs.length; i++){
        inputs[i].disabled = true;
    }

    btnActualizar.style.display = 'block';
    botonera.classList.add("hidden");
})

btnUpdate.addEventListener('click' , function (e){
    e.preventDefault();

    
})