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
    
    $('#tableBodyAllOrders').DataTable({
        "language": lenguageOptions
    });

    
});