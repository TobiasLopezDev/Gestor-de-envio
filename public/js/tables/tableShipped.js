var actionBtnShipped = document.getElementById("actionButtonShipped");
var actionShipped = document.getElementById("actionSelectShipped");

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

$(document).ready(function () {

    $('#tableBodyOrdersEnvios tfoot .searchable').each(function () {
        var title = $(this).html();
        $(this).html('<input type="text" placeholder="Buscar ' + title +
            '"  style="margin:auto !important;" class="form-control block w-2/3 m-auto px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"/>'
        );
    });
   
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


    $(".actionSelect").on("click", function (e) {
        var checkboxes = document.querySelectorAll('.checkboxDataTableShipped')
        for (const item of checkboxes) {
            if (item.checked) {
                const itemPadre = item.parentNode;

            }
        }

    });


    $("#selectAllBtnShipped").on("click", function (e) {
        var checkboxes = document.querySelectorAll('.checkboxDataTableShipped')

        const selectAll = document.getElementById('selectAllBtnShipped')

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

    actionBtnShipped.addEventListener('click', function () {

        if (actionShipped.value == '' && actionShipped.value == 0) {
            document.getElementById("p-action").innerHTML = 'Por favor seleccione una accion'
            document.getElementById("p-action").classList.remove('hidden')
            actionShipped.focus();
        } else {
            document.getElementById("p-action").classList.add('hidden')
            var checkboxes = document.querySelectorAll('.checkboxDataTableShipped');

            checkedItems = [];

            for (const item of checkboxes) {
                if (item.checked) {

                    const itemPadre = item.parentNode;
                    checkedItems.push(itemPadre.dataset.orderId);
                }
            }

            if (checkedItems != '') {

                switch (actionShipped.value) {
                    case "1":
                        //console.log("case 1")
                        modalExcel.style.display = "flex";
                        modalExcel.dataset.orders = checkedItems;
                        modalExcel.scrollIntoView();
                        break;

                    case "2":
                        //console.log("case 2")
                        modalPdf.style.display = "flex";
                        modalPdf.dataset.orders = checkedItems;
                        modalPdf.scrollIntoView();
                        break;

                    case "3":
                        //console.log("case 3")
                        modalFulfillments.dataset.orders = checkedItems;
                        modalFulfillments.style.display = "flex";
                        modalFulfillments.scrollIntoView();
                        break;

                    default:
                        break;
                }
            }
            else {
                document.getElementById("p-action").innerHTML = 'Por favor seleccione ordenes para ejecutar'
                document.getElementById("p-action").classList.remove('hidden')
                action.focus();
            }
        }

    })
});