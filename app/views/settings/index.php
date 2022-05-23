<?php
use app\views\headerTemplate;
use app\views\footerTemplate;
use app\views\components\menu;

new headerTemplate('Settings');
new menu();

$customZones = $this -> data['customZones'] ;
?>

<link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet" />


<main class=" min-h-screen h-auto w-full bg-gray-200 flex flex-wrap">

    <div class="h-auto w-full px-8">

        <div class="h-auto bg-gray-50 drop-shadow-lg my-8 rounded-lg ">

            <div class="bg-gray-900 w-full shadow-lg rounded-t-lg overflow-hidden p-4 text-white text-center">
                Ajustes
            </div>

            <div class="w-1/3 m-auto p-4 float-bottom">

                <label class="inline-block text-sm text-gray-600" for="inputNameZone">Declare nombre de zona</label>
                <div class="relative flex w-full">
                    <input type="text" placeholder="Nombre de la zona personalizada..." id="inputNameZone"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"></input>
                </div>

                <label class="inline-block text-sm text-gray-600" for="Multiselect">Seleccione las zonas</label>
                <div class="relative flex w-full">
                    <select id="select-role" name="zonesSelected[]" multiple placeholder="Seleccione Zonas..."
                        autocomplete="off" class="block w-full rounded-sm cursor-pointer focus:outline-none" multiple>
                    </select>
                </div>

                <button id="createZone"
                    class="my-4 block-flex w-full items-center text-white justify-center px-3 py-2 border border-transparent text-base font-medium rounded-md txt-white bg-indigo-600 hover:bg-indigo-700">
                    Crear zona
                </button>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>
            <script src="<?php echo $_ENV['URL']?>public/js/settingsZone.js"></script>

        </div>

    </div>


    <div class="h-auto w-full px-8">

        <div class="h-auto bg-gray-50 drop-shadow-lg my-8 rounded-lg ">

            <div class="bg-gray-900 w-full shadow-lg rounded-t-lg overflow-hidden p-4 text-white text-center">
                Custom zones
            </div>

            <div class="w-full flex flex-wrap p-8">

                <?php for ($i = 0 ; $i < sizeof($customZones); $i++):?>
                <div class=" m-1 p-4 border-2 hover:shadow-lg hover:shadow-gray-200/50" style="width: 24%;">
                    <div class=" float-right">
                        <svg xmlns="http://www.w3.org/2000/svg" class="eliminateZone h-6 w-6 hover:stroke-red-500 hover:shadow-lg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2" data-zone-id="<?php echo $customZones[$i]['id'] ?>">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <div class="w-full">
                        <h1><?php echo $customZones[$i]['nombre']?></h1><br>
                        <p>Zonas: </p><br>
                        <ul>
                            <?php foreach( $customZones[$i]['zonas'] as $zona):?>

                            <li class="ml-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" />
                                </svg><?php echo $zona?>
                            </li>

                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
                <?php endfor;?>

            </div>


        </div>

    </div>
</main>

<style>
    .clear-button{
        font-size: 25px;
    }
</style>

<script src="<?php echo $_ENV['URL']?>public/js/deleteZone.js"></script>

<?php new footerTemplate();  ?>

<!-- TODO: Modal Delete zone-->