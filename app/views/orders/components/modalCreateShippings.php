<?php
namespace app\views\orders\components;

class modalCreateShippings{
    function __construct()
    {
        ?>
<div class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="modalShippings">

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
                    <path d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900">¿Deseas crear un envio para estas ordenes?</h3>
            <div class="mt-2 text-center">
                <form id="tracking_number" method="post">

                    <div class="form-group mb-6">
                        <input type="text"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                            id="inputTrackingCode" name="inputTrackingCode" aria-describedby="inputTrackingCode"
                            placeholder="Shipping Tracker Code">
                    </div>


                    <div class="form-group form-check text-left mb-6">
                        <div class="my-4">
                            <input type="checkbox"
                                class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain mr-2 cursor-pointer"
                                id="checkNotification" value="true" name="checkNotification" checked>
                            <label class="form-check-label inline-block text-gray-800" for="checkNotification">Notificar
                                al
                                Usuario via Email</label>
                        </div>
                        <div class="my-4">
                            <input type="checkbox"
                                class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain mr-2 cursor-pointer"
                                id="checkTracking" value="true" name="checkTracking">
                            <label class="form-check-label inline-block text-gray-800" for="checkTracking">Creacion
                                automatica del shipping tracking number</label>
                        </div>
                    </div>
            </div>
            <div class="items-center px-4 py-3 flex items-center justify-center">
                <button id="createShippings-btn-modal"
                    class="px-4 py-2 mr-4 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                    Crear
                </button>
                </form>
                <button id="cancelShippings-btn-modal"
                    class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancelar
                </button>  
            </div>
        </div>
    </div>
</div>

<script src="<?php echo $_ENV['URL']?>public/js/modalCreateShippings.js"></script>
<?php
    }
}