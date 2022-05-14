<?php
namespace app\views\orders\components;

class modalCreateFulfillments{
    function __construct()
    {
        ?>
<div class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="modalFulfillments">

    <!--modal content-->
    <div class="relative m-auto p-5 border shadow-lg rounded-md bg-white" style="width:auto">
        <div id="loader" style="display: none ; width:200px" class="m-3 h-auto">
            <svg class="circular-loader" viewBox="25 25 50 50">
                <circle class="loader-path" cx="50" cy="50" r="20" fill="none" stroke="#000000" stroke-width="2" />
            </svg>
        </div>
        <div class="mt-3 text-center" id="modalBody">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900">¿Deseas crear un estado de envio <br> para estas ordenes?</h3>
            <div class="mt-2 text-center">
                <form id="form-create-fulfillment" method="post">

                    <input type="hidden" name="inputOrderId" value="" id="orderIdForm">

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
                    <div class="form-group  mb-6">
                        <textarea type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                            id="inputDescription" name="inputDescription" aria-describedby="inputDescription"
                            placeholder="Description"></textarea>
                    </div>
                    <div class="flex wrap">


                        <div class="form-group w-1/2 mr-3 mb-6">
                            <input type="text"
                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                                id="inputCity" name="inputCity" aria-describedby="inputCity" placeholder="Ciudad">
                        </div>

                        <div class="form-group w-1/2 ml-3 mb-6">
                            <input type="text"
                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                                id="inputState" name="inputState" aria-describedby="inputState" placeholder="Provincia">
                        </div>
                    </div>

                    <div class="form-group mb-6">
                        <input type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                            id="inputCountry" name="inputCountry" aria-describedby="inputCountry" placeholder="Pais">
                    </div>

                    <div class="flex wrap">


                        <div class="form-group w-1/2 mr-3 mb-6">
                            <label for="inputHappendAt">Ocurrido el:</label>
                            <input type="date"
                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                                id="inputHappendAt" name="inputHappendAt" aria-describedby="inputHappendAt"
                                placeholder="Shipping Tracker Code">
                        </div>

                        <div class="form-group w-1/2 ml-3 mb-6">
                            <label for="inputEstimated">Delivery estimado:</label>
                            <input type="date"
                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                                id="inputEstimated" name="inputEstimated" aria-describedby="inputEstimated"
                                placeholder="Shipping Tracker Code">
                        </div>
                    </div>
            </div>
            <div class="items-center px-4 py-3 flex items-center justify-center">
                <button id="createFulfillments-btn-modal"
                    class="px-4 py-2 mr-4 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                    Crear
                </button>
                </form>
                <button id="cancelFulfillments-btn-modal"
                    class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo $_ENV['URL']?>public/js/modalCreateFulfillments.js"></script>
<?php
    }
}