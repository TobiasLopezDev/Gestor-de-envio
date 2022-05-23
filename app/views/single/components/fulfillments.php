<?php
namespace app\views\single\components;

class fulfillments{
  public function __construct(array $data)
  {
    $fulfillments = $data['fulfillments'];
    $orderData = $data['order'];
?>

<div class="border border-2 border-balck rounded-lg border-solid my-4">

    <div class="bg-gray-200  w-full shadow-lg rounded-t-lg overflow-hidden p-4  text-center">
        Fulfillments
    </div>
    <div class="p-4 flex flex-wrap">
        <?php if(isset($fulfillments['error']) && $fulfillments['error'] == 0):?>
        <div class="bg-yellow-100 rounded-lg py-5 px-6 mb-3 text-base text-yellow-700 inline-flex items-center   w-3/4 p-4"
            role="alert">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="exclamation-triangle"
                class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <path fill="currentColor"
                    d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z">
                </path>
            </svg>
            No hay fulfillments creados


        </div>
        <?php endif?>

        <?php if(isset($fulfillments['error']) && $fulfillments['error'] == 404):?>
        <div class="bg-red-100 rounded-lg py-5 px-6 mb-3 text-base text-red-700 font-bold inline-flex items-center   w-3/4 p-4"
            role="alert">
            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="exclamation-triangle"
                class="w-4 h-4 mr-2 fill-current" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                <path fill="currentColor"
                    d="M569.517 440.013C587.975 472.007 564.806 512 527.94 512H48.054c-36.937 0-59.999-40.055-41.577-71.987L246.423 23.985c18.467-32.009 64.72-31.951 83.154 0l239.94 416.028zM288 354c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z">
                </path>
            </svg>
            Hubo un error en la solicitud!
        </div>
        <?php endif?>

        <div class="flex flex-wrap w-3/4 p-4">
            <?php 
        
        if(!isset($fulfillments['error']) && sizeof($fulfillments) > 0):?>
            <div class='timeline'>
                <?php for ($i = 0; sizeof($fulfillments) > $i ; $i++ ):?>
                <div class="timeline-container primary" id="<?php echo $fulfillments[$i]['id'] ?>">
                    <div class="timeline-icon">
                        <i class="far fa-grin-wink"></i>
                    </div>
                    <div class="timeline-body flex flex-row">
                        <div class="basis-4/5">
                            <h4 class="timeline-title"><span
                                    class="badge"><?php echo $fulfillments[$i]['status'] ?></span>
                            </h4>
                            <p><?php echo $fulfillments[$i]['description'] ?></p>
                            <p class="timeline-subtitle">Ocurrido el:
                                <?php echo date("d/m/Y",strtotime($fulfillments[$i]['happened_at'])) ?></p>
                                <p class="timeline-subtitle">Delivery estimado:
                                <?php echo date("d/m/Y",strtotime($fulfillments[$i]['estimated_delivery_at'])) ?></p>
                        </div>
                        <div class="basis-1/5 flex flex-row-reverse m-auto mt-0">


                            <svg data-fulfill-id="<?php echo $fulfillments[$i]['id'] ?>"
                                xmlns="http://www.w3.org/2000/svg" class="buttonEditFulfillment h-6 w-6" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                                data-modal-toggle="defaultModal">>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
            <?php  endif; ?>



        </div>

        <div class="w-1/4 flex flex-wrap justify-center">
            <div class="p-4 my-2 " id="botonera">
                <div class="w-fill text-center mb-4">
                    Acciones
                </div>

                <?php if (isset($fulfillments)): ?>

                <button id='buttonCreateFulfillment' data-order-id='<?php echo $orderData['id'] ?>'
                    class="block-flex items-center justify-center px-3 py-2 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                    Crear Fulfillments

                </button>

                <?php endif;?>



            </div>

            <div id="form-create" class="w-full hidden">
                <form id="form-create-fulfillment" method="post">

                    <input type="hidden" name="ordersId" value="" id="orderIdForm">

                    <div class="form-group mb-6">
                        <select
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                            id="inputStatus" name="inputStatus" aria-describedby="inputStatus"
                            placeholder="Shipping Tracker Code">
                            <option value="" selected>Seleccionar...</option>
                            <option value="dispatched">Despachado</option>
                            <option value="received_by_post_office">Recibido por la oficina de correos</option>
                            <option value="in_transit">En tránsito</option>
                            <option value="out_for_delivery">Fuera para entrega</option>
                            <option value="delivery_attempt_failed">Intento de entrega fallido</option>
                            <option value="delayed">Demorado</option>
                            <option value="ready_for_pickup">Listo para recoger</option>
                            <option value="delivered">Entregado</option>
                            <option value="returned_to_sender">Devuelto a emisor</option>
                            <option value="lost">Perdido</option>
                            <option value="failure">Falla</option>
                        </select>
                    </div>

                    <div class="form-group mb-6">
                        <textarea type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                            id="inputDescription" name="inputDescription" aria-describedby="inputDescription"
                            placeholder="Description"></textarea>
                    </div>

                    <div class="form-group mb-6">
                        <input type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                            id="inputCity" name="inputCity" aria-describedby="inputCity" placeholder="Ciudad">
                    </div>

                    <div class="form-group mb-6">
                        <input type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                            id="inputState" name="inputState" aria-describedby="inputState" placeholder="Provincia">
                    </div>

                    <div class="form-group mb-6">
                        <input type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                            id="inputCountry" name="inputCountry" aria-describedby="inputCountry" placeholder="Pais">
                    </div>

                    <div class="form-group mb-6">
                        <label for="inputHappendAt">Ocurrido el:</label>
                        <input type="date"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                            id="inputHappendAt" name="inputHappendAt" aria-describedby="inputHappendAt"
                            placeholder="Shipping Tracker Code">
                    </div>

                    <div class="form-group mb-6">.
                        <label for="inputEstimated">Delivery estimado:</label>
                        <input type="date"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                            id="inputEstimated" name="inputEstimated" aria-describedby="inputEstimated"
                            placeholder="Shipping Tracker Code">
                    </div>



                    <div class="text-center">
                        <button type="submit" data-order-id='<?php echo $orderData['id'] ?>'
                            class="w-2/5 px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">Create</button>
                </form>
                <button id="cancelCreateFulfillments"
                    class="w-2/5 px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">Cancel</button>
            </div>

        </div>

    </div>




</div>

<script src="<?php echo $_ENV['URL']?>/public/js/createFulfillment.js"></script>


<?php
  }
}