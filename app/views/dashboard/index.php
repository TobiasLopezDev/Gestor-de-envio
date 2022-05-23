<?php 
use app\views\headerTemplate;
use app\views\footerTemplate;
use app\views\components\menu;

new headerTemplate('Dashboard');
new menu();
?>
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js" type="text/javascript"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">


<script src="<?php echo $_ENV['URL']?>public/js/dashboard.js"></script>
<main class=" min-h-screen h-auto w-full bg-gray-200 flex flex-wrap">

    <div class="h-auto w-1/2 p-8">

        <div class="h-auto bg-gray-50 drop-shadow-lg rounded-lg ">
            <div class="bg-gray-900 w-full shadow-lg rounded-t-lg overflow-hidden p-4 text-white text-center">
                Orders Stats
            </div>

            <div class="shadow-lg w-full rounded-lg overflow-hidden" id="stats">
                <canvas class="p-10" id="orderStats"></canvas>
            </div>

            <!-- Required chart.js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <!-- Chart doughnut -->
            <script>
            const dataDoughnut = {
                labels: ["Empaquetadas", "Demoradas", "Entregadas" , "Sin Envio"],
                datasets: [{
                    label: "Orders Stats",
                    data: [
                        <?php echo $this -> data ['dataOrders']['noStatus']?>, 
                        <?php echo $this -> data ['dataOrders']['delayed']?>,
                        <?php echo $this -> data ['dataOrders']['shippings']?>,
                        <?php echo $this -> data ['dataOrders']['unshippings']?>
                    ],
                    backgroundColor: [
                        "rgb(230, 154, 14)",
                        "rgb(252, 48 , 3)",
                        "rgb(92 , 184, 31)",
                        "rgb(182, 182, 182)",
                    ],
                    hoverOffset: 1,
                }, ],
            };

            const configDoughnut = {
                type: "doughnut",
                data: dataDoughnut,
                options: {},
            };

            var chartBar = new Chart(
                document.getElementById("orderStats"),
                configDoughnut
            );
            </script>


        </div>

    </div>

    <div class="h-auto w-1/2 p-8  flex flex-col flex-wrap justify-center">

        <div class="h-auto bg-gray-50 drop-shadow-lg rounded-lg ">

            <div class="bg-gray-900 w-full shadow-lg rounded-t-lg overflow-hidden p-4 text-white text-center">
                Cantidad de ventas por localidad
            </div>

            <div class="shadow-lg rounded-lg overflow-hidden p-4">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full text-center"  id='tableBodySales'>
                                    <thead class="border-b bg-gray-50">
                                        <tr>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                                Posicion
                                            </th>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                                Zona
                                            </th>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                                Cantidad de ordenes
                                            </th>
                                        </tr>
                                    </thead class="border-b">
                                    <tbody>
                                        <?php foreach($this-> data['dataOrders']['locality'] as $locality):?>

                                            <tr class="bg-white border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                <?php echo $locality['name'] ?>
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                <?php echo $locality['count'] ?>
                                            </td>
                                        </tr class="bg-white border-b">

                                        <?php endforeach;?>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- <div class="h-auto bg-gray-50 drop-shadow-lg my-8 rounded-lg ">
            <div class="bg-gray-900 w-full shadow-lg  rounded-t-lg overflow-hidden p-4 text-white text-center">
                Ventas
            </div>

            <div class="shadow-lg rounded-lg overflow-hidden p-4">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden">
                                <table class="min-w-full text-center">
                                    <thead class="border-b bg-gray-50">
                                        <tr>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                                #
                                            </th>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                                Zona
                                            </th>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                                Cantidad de ordenes
                                            </th>
                                            <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4">
                                                Fecha
                                            </th>
                                        </tr>
                                    </thead class="border-b">
                                    <tbody>
                                        <tr class="bg-white border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">1
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                São Paulo
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                15
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                30/04/2022
                                            </td>
                                        </tr class="bg-white border-b">
                                        <tr class="bg-white border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">2
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                Pinheiros
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                20
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                02/05/2022
                                            </td>
                                        </tr>
                                        <tr class="bg-white border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">3
                                            </td>
                                            <td
                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                                Vila Madalena.
                                            </td>
                                            <td
                                                class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                                10
                                            </td>
                                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                                05/05/2022
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <style>
            #stats canvas{
                width: 100% !important;
            }
        </style>
    </div>

    
</main>

<?php new footerTemplate() ?>