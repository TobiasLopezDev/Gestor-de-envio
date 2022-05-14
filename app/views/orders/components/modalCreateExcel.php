<?php
namespace app\views\orders\components;

class modalCreateExcel{
    function __construct()
    {
        ?>

<div class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="modalExcelGen">

    <!--modal content-->
    <div class="relative m-auto p-5 border shadow-lg rounded-md bg-white" style="width:400px">
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
                        d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900">¿Deseas exportar estas ordenes a excel?</h3>
            <div class="mt-2 text-center">
                <p class="text-sm text-gray-500">¿Que valores quiere exportar?</p>
                <div>
                    <ul id="botoneraExcel" class="text-left">
                        <li class="my-2"><input class="mx-4 checkboxExcel" type="checkbox" name="number" id="number"
                                checked><label for="number">Numero de Orden</label>
                        </li>
                        <li class="my-2"><input class="mx-4 checkboxExcel" type="checkbox" name="products" id="products"
                                checked><label for="products">Detalle de
                                productos</label></li>
                        <li class="my-2"><input class="mx-4 checkboxExcel" type="checkbox" name="shipping_Info"
                                id="shipping_Info" checked><label for="shipping_Info">Informacion de envio</label></li>
                        <li class="my-2"><input class="mx-4 checkboxExcel" type="checkbox" name="custom_Zone"
                                id="custom_Zone" checked><label for="custom_Zone">Zona
                                custom</label></li>
                        <li class="my-2"><input class="mx-4 checkboxExcel" type="checkbox" name="customer_info" id="customer_info"
                                checked><label for="customer_info">Informacion del usuario</label></li>
                    </ul>
                </div>
            </div>
            <div class="items-center px-4 py-3 flex items-center justify-center">
                <button id="createExcel-btn-modal"
                    class="px-4 py-2 mr-4 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                    Crear
                </button>
                <button id="cancelExcel-btn-modal"
                    class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<?php
    }
}