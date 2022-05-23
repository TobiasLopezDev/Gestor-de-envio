<?php
use app\views\headerTemplate;
use app\views\footerTemplate;
use app\views\components\menu;

new headerTemplate('User Settings');
new menu();

?>
<main class=" min-h-screen h-auto w-full bg-gray-200 flex flex-wrap">

    <div class="h-auto w-full px-8">

        <div class="h-auto bg-gray-50 drop-shadow-lg my-8 rounded-lg ">

            <div class="bg-gray-900 w-full shadow-lg rounded-t-lg overflow-hidden p-4 text-white text-center">
                Ajustes de usuario
            </div>

            <div class="w-4/5 m-auto p-4 float-bottom flex flex-wrap ">
                <div class="w-1/2 p-4">
                    <form action="">
                        <label class="inline-block text-sm text-gray-600" for="inputNameZone">Declare nombre de
                            zona</label>
                        <div class="relative flex w-full">
                            <input type="text" placeholder="Nombre de la zona personalizada..." id="inputNameZone"
                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"></input>
                        </div>

                        <label class="inline-block text-sm text-gray-600" for="Multiselect">Seleccione las zonas</label>
                        <div class="relative flex w-full">
                            <select id="select-role" name="zonesSelected[]" multiple placeholder="Seleccione Zonas..."
                                autocomplete="off" class="block w-full rounded-sm cursor-pointer focus:outline-none"
                                multiple>
                            </select>
                        </div>

                        <button id="createZone"
                            class="my-4 block-flex w-full items-center text-white justify-center px-3 py-2 border border-transparent text-base font-medium rounded-md txt-white bg-indigo-600 hover:bg-indigo-700">
                            Crear zona
                        </button>
                    </form>
                </div>
                <div class="w-1/2 p-4">
                    <form action="">
                        <label class="inline-block text-sm text-gray-600" for="inputNameZone">Declare nombre de
                            zona</label>
                        <div class="relative flex w-full">
                            <input type="text" placeholder="Nombre de la zona personalizada..." id="inputNameZone"
                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"></input>
                        </div>

                        <label class="inline-block text-sm text-gray-600" for="Multiselect">Seleccione las zonas</label>
                        <div class="relative flex w-full">
                            <select id="select-role" name="zonesSelected[]" multiple placeholder="Seleccione Zonas..."
                                autocomplete="off" class="block w-full rounded-sm cursor-pointer focus:outline-none"
                                multiple>
                            </select>
                        </div>

                        <button id="createZone"
                            class="my-4 block-flex w-full items-center text-white justify-center px-3 py-2 border border-transparent text-base font-medium rounded-md txt-white bg-indigo-600 hover:bg-indigo-700">
                            Crear zona
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="<?php echo $_ENV['URL']?>public/js/user.js"></script>

<?php new footerTemplate();  ?>