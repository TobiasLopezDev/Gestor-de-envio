<?php
use app\views\headerTemplate;
use app\views\footerTemplate;
use app\views\components\menu;

new headerTemplate('User Settings');
new menu();
$user = $this->data['user'];
?>
<main class=" min-h-screen h-auto w-full bg-gray-200 flex flex-wrap">

    <div class="h-auto w-full px-8">

        <div class="h-auto bg-gray-50 drop-shadow-lg my-8 rounded-lg ">

            <div class="bg-gray-900 w-full shadow-lg rounded-t-lg overflow-hidden p-4 text-white text-center">
                Ajustes de usuario
            </div>

            <div class="w-4/5 m-auto p-4 float-bottom flex flex-wrap ">
                <div class="w-1/2 p-4">
                    <form action="" id="userData">
                        <label class="inline-block text-sm text-gray-600" for="username">Nombre de usuario:</label>
                        <div class="relative flex w-full">
                            <input type="text" placeholder="Username" id="username"
                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                                disabled value="<?php echo $user -> getUsername()?>"></input>
                        </div>

                        <label class="inline-block text-sm text-gray-600" for="name">Nombre:</label>
                        <div class="relative flex w-full">
                            <input type="text" placeholder="Nombre" id="name"
                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                                disabled value="<?php echo $user -> getUsername()?>"></input>
                        </div>

                        <label class="inline-block text-sm text-gray-600" for="email">Email:</label>
                        <div class="relative flex w-full">
                            <input type="email" placeholder="email" id="email"
                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                                disabled value="<?php echo $user -> getEmail()?>"></input>
                        </div>

                        <label class="inline-block text-sm text-gray-600" for="passwordact">Contraseña actual:</label>
                        <div class="relative flex w-full">
                            <input type="password" placeholder="Contraseña actual" id="passwordact"
                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                                disabled></input>
                        </div>
                        <label class="inline-block text-sm text-gray-600" for="passwordnew">Contraseña nueva:</label>
                        <div class="relative flex w-full">
                            <input type="password" placeholder="Contraseña nueva" id="passwordnew"
                                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                                disabled></input>
                        </div>

                        <div class="relative flex w-full hidden" id="botonera">
                        <button id="updateUser"
                            class="my-4 mx-4 block-flex w-full items-center text-white justify-center px-3 py-2 border border-transparent text-base font-medium rounded-md txt-white bg-green-600 hover:bg-green-700">
                            Actualizar
                    </button>
                    <button id="cancelUser"
                            class="my-4 mx-4 block-flex w-full items-center text-white justify-center px-3 py-2 border border-transparent text-base font-medium rounded-md txt-white bg-gray-600 hover:bg-gray-700">
                            Cancelar
                    </button>
                        </div>

                        
                    </form>

                    <button id="modifyUser"
                            class="my-4 block-flex w-full items-center text-white justify-center px-3 py-2 border border-transparent text-base font-medium rounded-md txt-white bg-indigo-600 hover:bg-indigo-700">
                            Modificar
                    </button>
                </div>
                <div class="w-1/2 p-4">
                    
                </div>
            </div>
        </div>
    </div>
</main>
<script src="<?php echo $_ENV['URL']?>public/js/user.js"></script>

<?php new footerTemplate();  ?>