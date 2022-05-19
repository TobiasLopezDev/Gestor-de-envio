<?php
if (!isset($order)) die();

?>

<body>
    <div class="container">
        <div class='panel'>
            <div class='panel-body'>
                <div class="row">
                    <div class="col-12" style=" text-align:center ">
                       <h2> Order #<?php echo $order["number"]?></h2>
                    </div>
                </div>
                <div class="row bt-2">
                    <div class="col-2" style="background-color:#000; padding-left:2rem;  height:auto;"><img
                            src="<?php echo $_ENV['URL']?>public/img/logo300.png" style="margin: auto; display:block;">
                    </div>
                    <div class="col-9" style="border-left: solid 2px #000;margin-left:2rem; height:auto;">
                        Por : <span class='order-detail name'><?php echo $order["shipping_address"]["name"]; ?></span>
                        !<br>
                        Telefone : <span
                            class='order-detail name'><?php echo $order["shipping_address"]['phone']; ?></span><br>
                        <hr>
                        Endereço : <span
                            class='order-detail name'><?php echo $order['shipping_address']["address"]; ?></span><br>
                        Número : <span
                            class='order-detail name'><?php echo $order['shipping_address']["number"]; ?></span><br>
                        Complemento : <span
                            class='order-detail name'><?php echo $order['shipping_address']["floor"]; ?></span><br>
                        Bairro : <span
                            class='order-detail name'><?php echo $order['shipping_address']["locality"]; ?></span><br>
                        CEP : <span
                            class='order-detail name'><?php echo $order['shipping_address']["zipcode"]; ?></span><br>

                        Shipping Tracking Number : <span
                            class='order-detail name'><?php echo $order["shipping_tracking_number"]; ?></span>
                    </div>
                </div>

                <div class="row bt-2">
                    <div class="col-6" style="margin: auto;">
                        <span class='order-detail name' style="float: left;">Nota de pedido:</span>
                        <p>&nbsp;&nbsp;
                            <?php echo $order["note"]; ?>
                        </p>
                    </div>
                </div>
                <div class="row bt-2">
                    <div class="col-12" style=" text-align:center">
                        <h1>Obrigado pela sua compra!</h1>
                    </div>
                </div>

            </div>

        </div>

    </div>
</body>