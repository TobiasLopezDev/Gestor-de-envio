<?php 
use app\views\headerTemplate;
use app\views\footerTemplate;
use app\views\components\menu;

use app\views\orders\components\modals\modalCreateExcel;
use app\views\orders\components\modals\modalCreateFulfillments;
use app\views\orders\components\modals\modalCreatePdf;
use app\views\orders\components\modals\modalCreateShippings;

use app\views\orders\components\tables\tableAllOrders;
use app\views\orders\components\tables\tableShipped;
use app\views\orders\components\tables\tableUnshipped;

new headerTemplate('Orders');
new menu();
?>

<link rel="stylesheet" href="<?php echo $_ENV['URL']?>public/css/loader.css">
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">


<main class=" min-h-screen h-auto w-full bg-gray-200 flex flex-wrap">
    
    <div class="h-aut w-full p-8">

        <?php new tableAllOrders( $this->data['orders'] );?>
        <?php new tableUnshipped( $this->data['orders'] );?>
        <?php new tableShipped( $this->data['orders-shipped'] )?>
        

    </div>

</main>

<style>
    .dataTables_filter {
        margin-bottom: 20px;
    }

    .dataTables_info {
        margin-top: 10px;
    }

    .dataTables_paginate {
        margin-top: 10px;
    }
</style>


<?php new modalCreateExcel();?>
<?php new modalCreatePdf();?>
<?php new modalCreateShippings();?>
<?php new modalCreateFulfillments();?>

<script src="<?php echo $_ENV['URL']?>public/js/order.js"></script>

<?php  new footerTemplate() ?>