var infoShipping = document.getElementById("tableBodyOrders");
var arrows = document.getElementsByClassName("arrow-hidden");
let modalExcel = document.getElementById("modalExcelGen");
let createExcelBtn = document.getElementById("createExcel-btn-modal");
let cancelExcelBtn = document.getElementById("cancelExcel-btn-modal");

async function asynGET(url) {
    const call = await fetch(url)



        .then(response => {
            console.log("STATUS ES:" + response.status)
            console.log("data ES:" + response.data)
            console.log(response)
            return true;
        });

}


for (var i = 0; i < arrows.length; i++) {
    arrows[i].addEventListener('click', hiddenShowElement, false);
}

function hiddenShowElement() {
    target = this.dataset.hiddenTarget;

    arrowClass = this.classList;
    targetClass = document.getElementById(target).classList;

    targetClass.toggle('hidden')
    arrowClass.toggle('rotate-180')
}


var actionBtn = document.getElementById("actionButton");
var action = document.getElementById("actionSelect");

actionBtn.addEventListener('click', function () {

    if (action.value == '' && action.value == 0) {
        document.getElementById("p-action").innerHTML = 'Por favor seleccione una accion'
        document.getElementById("p-action").classList.remove('hidden')
        action.focus();
    } else {
        document.getElementById("p-action").classList.add('hidden')
        console.log(action.value);

        var checkboxes = document.querySelectorAll('.checkboxDataTableShipped');

        checkedItems = [];

        for (const item of checkboxes) {
            if (item.checked) {

                const itemPadre = item.parentNode;
                checkedItems.push(itemPadre.dataset.orderId);
            }
        }

        if (checkedItems != '') {
            console.log(checkedItems);

            modalExcel.style.display = "flex";
            modalExcel.dataset.orders = checkedItems;
            modalExcel.scrollIntoView();
        }
        else {
            document.getElementById("p-action").innerHTML = 'Por favor seleccione ordenes para ejecutar'
            document.getElementById("p-action").classList.remove('hidden')
            action.focus();
        }
    }

})

createExcelBtn.addEventListener('click', function () {

    ordersAction = modalExcel.dataset.orders;
    checkboxOptions = document.querySelectorAll('.checkboxExcel');

    options = [];

    for (const item of checkboxOptions) {
        if (item.checked) {

            options.push(item.name)

        }
    }

    params = new FormData;
    params.append('orders', ordersAction);
    params.append('filters', options);

    asyncCreateCExcel('http://localhost/gestor-final/orders/genXLSX', params);

});

cancelExcelBtn.addEventListener('click', function () {
    modalExcel.style.display = "none";
    document.getElementById("body").style.overflowY = "scroll";
})


async function asyncCreateCExcel(url, params) {
    const request = await fetch(url, {
        method: 'POST',
        body: params
    })

    const response = await request.json();

    return response;
}


$(document).ready(function () {

    $('#tableBodyOrdersEnvios tfoot .searchable').each(function () {
        var title = $(this).html();
        console.log(title);
        $(this).html('<input type="text" placeholder="Buscar ' + title +
            '"  style="margin:auto !important;" class="form-control block w-2/3 m-auto px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"/>'
        );
    });

    lenguageOptions = {
        "lengthMenu": "Ver _MENU_ ordenes por pagina",
        "zeroRecords": "No hay ordenes",
        "info": "Pagina _PAGE_ de _PAGES_",
        "infoEmpty": "No hay ordenes",
        "infoFiltered": "(Filtrado de _MAX_ ordenes)",
        "search": "Buscar",
        "previous": "Previo",
        "next": "Proximo",
    }

    var tableShipped = $('#tableBodyOrdersEnvios').DataTable({
        "language": lenguageOptions,
        select: true,
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": [0, 6]
        }],
        "order": [1, 'asc'],
        "bSort": true,
        initComplete: function () {
            this.api().columns().every(function () {
                var that = this;

                $('input', this.footer()).on('keyup change clear', function () {
                    if (that.search() !== this.value) {
                        that
                            .search(this.value)
                            .draw();
                    }
                });
            });
        }
    });

    $('#tableBodyAllOrders').DataTable({
        "language": lenguageOptions
    });


    $(".actionSelect").on("click", function (e) {
        var checkboxes = document.querySelectorAll('.checkboxDataTableShipped')
        for (const item of checkboxes) {
            if (item.checked) {

                const itemPadre = item.parentNode;

            }
        }

    });


    $(".selectAll").on("click", function (e) {
        var checkboxes = document.querySelectorAll('.checkboxDataTableShipped')
        const selectAll = document.getElementById('selectAllBtn')

        for (const item of checkboxes) {
            if (selectAll.dataset.selectAll == "false") {
                item.checked = false;

            } else {
                item.checked = true;
            }
        }

        if (selectAll.dataset.selectAll == "true") {
            selectAll.dataset.selectAll = "false";
            selectAll.innerHTML = "Deseleccionar Todos"

        } else {
            selectAll.dataset.selectAll = "true";
            selectAll.innerHTML = "Seleccionar Todos"
        }


    });
});