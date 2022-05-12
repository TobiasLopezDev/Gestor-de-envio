<?php 
use app\views\headerTemplate;
use app\views\footerTemplate;
use app\views\components\menu;

new headerTemplate('Single');
new menu();

$order = $this-> data['order'];
?>


<main class=" min-h-screen h-auto max-w-full w-full bg-gray-200 flex flex-wrap overflow-hidden">

    <div class="h-aut w-full p-8">

        <div class="h-auto bg-gray-50 drop-shadow-lg my-8 rounded-lg ">

            <div class="bg-gray-900 w-full shadow-lg rounded-t-lg overflow-hidden p-4 text-white text-center">
                Order #<?php echo $order['number']?>
            </div>

            <div class="flex flex-wrap">

            <!-- INFO CONSUMER -->
                <div class="h-auto w-1/2 p-4 ">
                    <div class="border border-2 border-balck rounded-lg border-solid">
                        <div class="bg-gray-200 border w-full shadow-lg rounded-t-lg overflow-hidden p-4  text-center">
                            Info consumer
                        </div>
                        <div class="p-4">
                            <p><b>Nombre:</b> <?php echo $order['billing_name']?></p>
                            <p><b>Celular: </b> <?php echo $order['billing_phone']?></p>
                            <p><b>Direccion: </b> <?php echo $order['shipping_address']['address']?></p>
                            <p><b>Numero: </b> <?php echo $order['shipping_address']['number']?></p>
                            <p><b>Piso: </b> <?php echo $order['shipping_address']['floor']?></p>
                            <p><b>Custom zone: </b> <?php echo $order['custom_zone']?></p>
                            <p><b>Localidad: </b> <?php echo $order['shipping_address']['locality']?></p>
                            <p><b>ZIPCODE/CEP: </b> <?php echo $order['shipping_address']['zipcode']?></p>
                            <p><b>Ciudad: </b> <?php echo $order['shipping_address']['city']?></p>
                            <p><b>Provincia: </b> <?php echo $order['shipping_address']['province']?></p>
                            <p><b>Pais: </b> <?php echo $order['shipping_address']['country']?></p>
                        </div>
                    </div>
                </div>

                <div class="h-auto w-1/2 p-4">

                    <!-- Info Base -->
                    <div class="border border-2 border-balck rounded-lg border-solid " id="main-info-shipping">

                        <div class="bg-gray-200  w-full shadow-lg rounded-t-lg overflow-hidden p-4  text-center">
                            Info Shipping
                        </div>
                        <div class="p-4">
                            <p><b>Status:</b> <?php echo $order['shipping_status']?></p>
                            <p><b>Tracking Code:</b> <?php echo $order['shipping_tracking_number']?></p>
                            <p><b>Option: </b> <?php echo $order['shipping_option']?></p>
                            <p><b>note: </b> <?php echo $order['note']?></p>
                            <p><b>Fecha de creacion: </b> <?php echo $order['created_at']?></p>
                            <p><b>Ultima actualizacion: </b> <?php echo $order['updated_at']?></p>
                            <p><b>Proxima Accion: </b> <?php echo $order['next_action']?></p>
                        </div>

                        <div class="p-4 my-2">
                            <div class="w-fill text-center">
                                Acciones
                            </div>

                            <?php if ($order['shipping_status'] === 'unshipped'): ?>

                            <button href="<?php echo $_ENV['URL'] . 'single/createshipping?id=' . $order['id']?>"
                                id='buttonCreateShipping'
                                class="block-flex items-center justify-center px-3 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Crear Shipping

                            </button>

                            <?php endif;?>

                            <?php if ($order['shipping_status'] === 'shipped'): ?>

                            <button
                                id='imprimirTicket'
                                data-order-id='<?php echo $order['id'] ?>'
                                class="block-flex items-center justify-center px-3 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                Imprimir Ticket

                            </button>

                            <?php endif;?>

                        </div>
                    </div>

                    <pre><?php var_dump($order) ?></pre>

                    <!-- Create Shipping -->
                    <?php if ($order['shipping_status'] === 'unshipped'){require_once 'components/createShipping.php' ;}?>





                    <!-- FIXME: AL RELOAD GENERA UN SHIPPING TRACKED NUMBER -->
                </div>



                <?php if ($order['next_action'] === 'close'):?>
                <link rel="stylesheet" href="<?php echo $_ENV['URL']?>/public/css/fulfillments.css">
                <div class="h-auto w-full p-4">
                    <?php require_once 'components/fulfillments.php' ;?>
                    <?php //require_once 'components/createFulfillments.php' ;?>
                </div>
                <?php endif;?>


            </div>

        </div>
    </div>



</main>

<?php require_once 'components/modalDeleteFulfillments.php'; ?>


<?php  new footerTemplate(); ?>