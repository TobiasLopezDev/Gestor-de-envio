<div class="row">
        <div class="columns medium-12" style="display: flex; background:#000">
            <img src="<?php echo $_ENV['URL']?>public/img/logo300.png" style="margin: auto ;">
        </div>
        <div class="columns medium-12" style="border-left: 2px solid #000; padding-left: 1rem; margin-left: 1rem;">
            Por : <span class='order-detail name'><?php echo $order[0]["shipping_address"]["name"]; ?></span> !<br>
            Telefone : <span class='order-detail name'><?php echo $order[0]["shipping_address"]['phone']; ?></span><br>
            <hr>
            Endereço : <span class='order-detail name'><?php echo $order[0]['shipping_address']["address"]; ?></span><br>
            Número : <span class='order-detail name'><?php echo $order[0]['shipping_address']["number"]; ?></span><br>
            Complemento : <span class='order-detail name'><?php echo $order[0]['shipping_address']["floor"]; ?></span><br>
            Bairro : <span class='order-detail name'><?php echo $order[0]['shipping_address']["locality"]; ?></span><br>
            CEP : <span class='order-detail name'><?php echo $order[0]['shipping_address']["zipcode"]; ?></span><br>
        </div>
    </div>

    <div class="row" style="border-top: 2px solid #000; margin-top:1rem;padding-top:1rem;">
        <div class="col-md-6 text-left p-4" style="border-right:2px solid #000;">
           <span class='order-detail name' style="float: left;">Nota de pedido:</span> 
           <p>&nbsp;&nbsp;
                <?php echo $order[0]['shipping_address']["customs"]; ?>
           </p>
        </div>
        <div class="col-md-6 text-center p-4" style=" display:flex; margin:auto;">
            <div style="margin:auto;">
                Shipping Tracking Number : <span class='order-detail name'><?php echo $order[0]["shipping_tracking_number"]; ?></span>
            </div>
        </div>
    </div>

    <div class="row" style="border-top: 2px solid #000; margin-top:1rem;padding-top:1rem;">
        <div class="col-md-12 text-center p-4">
            <span class='order-detail name' style="font-size: 45px ;">Obrigado pela sua compra!</span>
        </div>
    </div>