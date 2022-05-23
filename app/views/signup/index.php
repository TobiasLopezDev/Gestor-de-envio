<?php
use app\views\headerTemplate;
use app\views\footerTemplate;

new headerTemplate('Sign Up');
?>

<body class="bg-gray-300">

    <section class="h-screen">
        <div class="h-screen">
            <div class="flex flex-row justify-center items-center h-full">
                <div class="w-full md:w-1/2 lg:w-1/4 p-4 h-auto bg-gray-900 rounded-lg">

                    <div class="items-center text-center">
                        <h1 class="text-white font-sans text-7xl leading-loose">Sign Up</h1>
                        <hr class="w-3/4 mb-4 m-auto border-gray-900 ">
                    </div>

                    <div class="items-center text-center w-full flex flex-wrap justify-center items-center">
                    </div>

                    <div class="flex justify-center items-center">
                        <div class="w-full lg:w-1/2">
                            <form action="<?php echo $_ENV['URL']?>register" method="POST">
                                <div class="w-full mb-4">
                                    <input type="text" name="username" id="username" placeholder="Nombre de usuario"
                                        class="text-white w-full bg-transparent border border-white rounded-lg px-2 py-3" />
                                </div>


                                <div class="w-full mb-4">
                                    <input type="email" name="email" id="email" placeholder="Email"
                                        class="text-white w-full bg-transparent border border-white rounded-lg px-2 py-3" />
                                </div>

                                <div class="w-full mb-4">
                                    <input type="password" name="password" id="password" placeholder="Contraseña"
                                        class="text-white w-full bg-transparent border border-white rounded-lg px-2 py-3" />
                                </div>

                                <div class="w-full mb-4">
                                    <button type="submit" class="bg-indigo-700 w-full text-white rounded-lg p-3">
                                        Registrate
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <?php new footerTemplate();  ?>