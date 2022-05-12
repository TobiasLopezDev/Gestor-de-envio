let btnCreateZona = document.getElementById('createZone');
let zones = []

var zonaselect = new TomSelect('#select-role', {
    plugins: {
        remove_button: {
            title: 'Remover esta zona',
        },
        clear_button: {
            'title': 'Remover todas las zonas',
        }
    },
    persist: false,
    create: true,
    onDelete: function (values) {
        return confirm(values.length > 1 ? 'Are you sure you want to remove these ' + values
            .length + ' items?' : 'Are you sure you want to remove "' + values[0] + '"?');
    }
});

window.onload = async function () {

    let request = await getZonesAsync('http://localhost/aaa/settings/getAllZone');

    for (i = 0; request.length > i; i++) {

        zones.push({ value: request[i].nome, text: request[i].nome })

    }

    zonaselect.addOptions(zones)

}

async function getZonesAsync(url) {
    const request = await fetch(url)

    const response = await request.json();

    return response;
}

btnCreateZona.addEventListener('click', async function () {

    valores = zonaselect.getValue();
    nombreZone = document.getElementById('inputNameZone').value;

    let params = new FormData();
    params.append('zonesSelected',valores);
    params.append('zonesName' , nombreZone)

    let request = await sendZonesAsync('http://localhost/aaa/settings/createZone', params);

    if(request.status == 201){
        location.reload();
    }
});

async function sendZonesAsync(url , params) {
    const request = await fetch(url, {
        method: 'POST',
        body: params
    })

    const response = await request.json();

    return response;
  }


