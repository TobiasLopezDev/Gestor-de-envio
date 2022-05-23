$(document).ready( function(){

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
    
    table = $('#tableBodySales').DataTable({
        "language": lenguageOptions,
        "columnDefs": [{
            "searchable": false,
            "orderable": false,
            "targets": [0]
        }],
        "order": [2, 'desc'],
    });

    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    
});