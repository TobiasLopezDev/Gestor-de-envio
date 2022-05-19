let btnsEliminateZone = document.querySelectorAll('.eliminateZone');

btnsEliminateZone.forEach( btnEliminate => {

    btnEliminate.addEventListener('click',async  function (event) {
        let params = new FormData();
        params.append('idZone',this.dataset.zoneId);
        response = await asynDeleteZone('http://localhost/gestor-final/settings/deleteZone', params);

        if(response.status == 201){
            padre = this.parentNode.parentNode;
            padre.remove();
        }else{
            alert('error');
        }    
    });

})

async function asynDeleteZone(url, params) {
    const call = await fetch(url, {
        method: 'POST',
        body: params
    })
    
    const response = await call.json();

    return response;

}
