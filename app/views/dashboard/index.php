<?php 
use app\views\headerTemplate;
use app\views\footerTemplate;
use app\views\components\menu;

new headerTemplate('Dashboard');
new menu();
?>
<main class=" min-h-screen h-auto w-full bg-gray-200 flex flex-wrap">

    <div class="h-auto w-1/2 p-8">

        <div class="h-auto bg-gray-50 drop-shadow-lg rounded-lg ">
            <div class="bg-gray-900 w-full shadow-lg rounded-t-lg overflow-hidden p-4 text-white text-center">
                Orders Stats
            </div>

            <div class="shadow-lg rounded-lg overflow-hidden">
                <canvas class="p-10" id="orderStats"></canvas>
            </div>

            <!-- Required chart.js -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <!-- Chart doughnut -->
            <script>
            const dataDoughnut = {
                labels: ["Empaquetadas", "Demoradas", "Enviadas"],
                datasets: [{
                    label: "Orders Stats",
                    data: [<?php echo 2?>, <?php echo 2?>,
                        <?php echo 3?>
                    ],
                    backgroundColor: [
                        "rgb(230, 154, 14)",
                        "rgb(252, 48, 3)",
                        "rgb(92, 184, 31)",
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
                Proximas entregas
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
                                        <tr class="bg-white border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">4
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
                                        <tr class="bg-white border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">5
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
                                        <tr class="bg-white border-b">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">6
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

        </div>

        <div class="h-auto bg-gray-50 drop-shadow-lg my-8 rounded-lg ">
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
        </div>

    </div>

    
</main>

<?php new footerTemplate() ?>


<!-- <div class="h-aut w-full p-8">

        <div class="h-auto bg-gray-50 drop-shadow-lg my-8 rounded-lg ">

            <div class="bg-gray-900 w-full shadow-lg rounded-t-lg overflow-hidden p-4 text-white text-center">
                Mas datos XL
            </div>
            <div class="shadow-lg rounded-lg overflow-hidden p-4 text-center"> -->

                <?php 
        
                    // $orders = $this -> tiendaNube ;
                    // for ($i = 0 ; sizeof($orders) > $i ; $i++) {
                    //     echo '<br>';
                    //     echo($orders [$i]['id']);
                    //     echo '<br>';
                    //     echo($orders [$i]['number']);
                    //     echo '<br>';

                    // }
                    // var_dump($orders);

                
                ?>

            <!-- </div>

        </div>


    </div> -->