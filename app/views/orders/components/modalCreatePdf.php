<?php
namespace app\views\orders\components;

class modalCreatePdf{
    function __construct()
    {
        ?>

<div class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="modalPdfGen">

    <!--modal content-->
    <div class="relative m-auto p-5 border shadow-lg rounded-md bg-white" style="width:400px">

        <div class="mt-3 text-center" id="modalBody">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900">¿Deseas exportar datos de envio <BR> a PDF?</h3>

            <div class="mt-2 text-center">
                <p class="text-sm text-gray-500">Se genarar un PDF por orden.</p>
                <p class="text-sm text-gray-500">Se comprimiran en un archivo ZIP.</p>
                <p class="text-sm text-gray-500">y decargara automaticamente.</p>
                <p class="text-sm text-gray-500">Generando...</p>
                <div id="loader" style="width:100px" class="h-auto flex m-auto">
                    <svg class="circular-loader"  style = "position:unset;" viewBox="25 25 50 50">
                        <circle class="loader-path" cx="50" cy="50" r="20" fill="none" stroke="#000000"
                            stroke-width="2" />
                    </svg>
                </div>
            </div>
            <div class="items-center px-4 py-3 flex items-center justify-center">
                <button id="createPdf-btn-modal"
                    class="px-4 py-2 mr-4 bg-green-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                    Crear
                </button>
                <button id="cancelPdf-btn-modal"
                    class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo $_ENV['URL']?>public/js/modalCreatePdf.js"></script>
<?php
    }
}