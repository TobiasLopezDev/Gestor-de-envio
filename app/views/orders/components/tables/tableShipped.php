<?php
namespace app\views\orders\components\tables;

class tableShipped {
    public function __construct($orders)
    {
        ?>

<div class="h-auto bg-gray-50 drop-shadow-lg my-8 rounded-lg ">
    <!-- ENCABEZADO -->
    <div class="bg-gray-900 w-full shadow-lg rounded-t-lg overflow-hidden p-4 text-white text-center">
        Listado de las ordenes en envio:
        <div class="inline absolute right-5 arrow-hidden rotate-180 ease-in-out duration-500"
            data-hidden-target="ShippingOrders">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </div>
    <!-- CUERPO -->
    <div class="shadow-lg rounded-lg overflow-hidden p-4 text-center ease-in-out duration-500 " id="ShippingOrders">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden p-8">
                        <table class="min-w-full text-center border border-black border my-4"
                            id='tableBodyOrdersEnvios'>
                            <!-- THEAD -->
                            <thead class="border-b bg-gray-50">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 w-8">
                                        Seleccionadas
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 w-8">
                                        #Number
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                        Tracking number:
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                        Zona
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                        Zona Personalizada
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                        Fecha
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 w-15">

                                    </th>
                                </tr>
                            </thead class="border-b">
                            <!-- TBODY -->
                            <tbody>
                                <?php 
                                        for ($i = 0 ; sizeof($orders) > $i ; $i++) :
                                        if($orders[$i]['shipping_status'] == 'shipped'):?>
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                                        data-order-id="<?php echo($orders [$i]['id']);?>">
                                        <input type="checkbox" class="checkboxDataTableShipped"
                                            id="<?php $orders [$i]['id']?>">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#
                                        <?php echo($orders [$i]['number']);?></td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php echo($orders [$i]['shipping_tracking_number']);?></td>

                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php echo($orders [$i]['shipping_address']['city'] .' , ' );echo($orders [$i]['shipping_address']['locality'])?>
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php echo($orders [$i]['custom_zone'])?>
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php echo date("d/m/Y" ,strtotime($orders [$i]['shipped_at']));?></td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><a
                                            href="<?php echo $_ENV['URL'] . 'single/' .$orders [$i]['id']?>">
                                            Ver orden
                                        </a>
                                    </td>

                                </tr class="bg-white border-b">

                                <?php
                                        endif;
                                        endfor;
                                        ?>
                            </tbody>
                            <!-- TFOOT -->
                            <tfoot>
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 w-8">
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 w-8">
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 searchable">Zona
                                        Personalizada
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 w-15">

                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- BOTONER -->
                    <div id="botoneraTables" class="flex wrap">
                        <!-- ACTION -->
                        <div class="w-3/5 inline px-6 py-2.5">
                            <label class="hidden float-left" id="p-action" for="actionSelect">Por favor seleccione una
                                accion</label>
                            <div class="relative flex w-full">
                                <select name="actionSelect" id="actionSelectShipped"
                                    class="form-control inline w-2/5 px-6 py-2.5  mr-2 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100">
                                    <option value="">Seleccione una accion...</option>
                                    <option value="1">Exportacion a Excel</option>
                                    <option value="2">Exportar datos de entrega a PDF</option>
                                    <option value="3">Creacion de estado en masa</option>
                                </select>
                                <button id="actionButtonShipped"
                                    class="inline w-2/5 px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">
                                    Acciones para ordenes seleccionadas
                                </button>
                            </div>
                        </div>
                        <!-- BOTONERA SELECTALL -->
                        <div class="w-2/5 inline px-6 py-2.5">
                            <div class="relative flex w-full h-full">
                                <button id="selectAllBtnShipped" data-select-all="true"
                                    class="selectAll inline  w-2/5 px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">
                                    Seleccionar Todos
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="<?php echo $_ENV['URL']?>public/js/tables/tableShipped.js"></script>
<?php

    }
}