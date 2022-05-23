<?php
namespace app\views\orders\components\tables;

class tableAllOrders {
    public function __construct($orders)
    {
        ?>

<div class="h-auto bg-gray-50 drop-shadow-lg my-8 rounded-lg ">

    <div class="bg-gray-900 w-full shadow-lg rounded-t-lg overflow-hidden p-4 text-white text-center">
        Listado de Todas las ordenes:
        <div class="inline absolute right-5 arrow-hidden  ease-in-out duration-500" data-hidden-target="tableAllOrders">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </div>
    <div class="shadow-lg rounded-lg overflow-hidden p-4 text-center hidden ease-in-out duration-500 " id="tableAllOrders">
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <table class="min-w-full text-center" id='tableBodyAllOrders'>
                            <thead class="border-b bg-gray-50">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                        #Number
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                        Status Shipping
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                        Zona
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                        Fecha
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                        Actions
                                    </th>
                                </tr>
                            </thead class="border-b">
                            <tbody>
                                <?php
                            for ($i = 0 ; sizeof($orders) > $i ; $i++) {?>

                                <tr class="bg-white border-b">

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#
                                        <?php echo($orders [$i]['number']);?></td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php echo($orders [$i]['shipping_status']);?></td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php echo($orders [$i]['shipping_address']['city'] .' , ' );echo($orders [$i]['shipping_address']['locality'])?>
                                    </td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                        <?php echo($orders [$i]['shipped_at']);?></td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap"><a
                                            href="<?php echo $_ENV['URL'] . 'single/' .$orders [$i]['id']?>">Ver</a>
                                    </td>

                                </tr class="bg-white border-b">

                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="<?php echo $_ENV['URL']?>public/js/tables/tableAllOrders.js"></script>
<?php
    }
}