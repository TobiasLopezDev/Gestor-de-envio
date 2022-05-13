<?php
namespace app\views\single\components;

class modalDeleteFulfillments{
  public function __construct()
  {
    ?>

<div class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="my-modal">

    <!--modal content-->
    <div class="relative m-auto p-5 border shadow-lg rounded-md bg-white" style="width:400px">
        <div id="loader" style="display: none ; width:200px" class="m-3 h-auto">
            <svg class="circular-loader" viewBox="25 25 50 50">
                <circle class="loader-path" cx="50" cy="50" r="20" fill="none" stroke="#000000" stroke-width="2" />
            </svg>
        </div>
        <div class="mt-3 text-center" id="modalBody">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-900">¿Deseas eliminar este estado?</h3>
            <div class="mt-2 text-center">
                <p class="text-sm text-gray-500">Esta accion es irreversible</p>
            </div>
            <div class="items-center px-4 py-3 flex items-center justify-center">
                <button id="delete-btn-modal"
                    class="px-4 py-2 mr-4 bg-red-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                    Eliminar
                </button>
                <button id="cancel-btn-modal"
                    class="px-4 py-2 bg-gray-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.circular-loader {
    -webkit-animation: rotate 2s linear infinite;
    animation: rotate 2s linear infinite;
    height: 100%;
    -webkit-transform-origin: center center;
    -ms-transform-origin: center center;
    transform-origin: center center;
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
    margin: auto;
}

.loader-path {
    stroke-dasharray: 150, 200;
    stroke-dashoffset: -10;
    -webkit-animation: dash 1.5s ease-in-out infinite, color 6s ease-in-out infinite;
    animation: dash 1.5s ease-in-out infinite, color 6s ease-in-out infinite;
    stroke-linecap: round;
}

@-webkit-keyframes rotate {
    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

@keyframes rotate {
    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}

@-webkit-keyframes dash {
    0% {
        stroke-dasharray: 1, 200;
        stroke-dashoffset: 0;
    }

    50% {
        stroke-dasharray: 89, 200;
        stroke-dashoffset: -35;
    }

    100% {
        stroke-dasharray: 89, 200;
        stroke-dashoffset: -124;
    }
}

@keyframes dash {
    0% {
        stroke-dasharray: 1, 200;
        stroke-dashoffset: 0;
    }

    50% {
        stroke-dasharray: 89, 200;
        stroke-dashoffset: -35;
    }

    100% {
        stroke-dasharray: 89, 200;
        stroke-dashoffset: -124;
    }
}

@-webkit-keyframes color {
    0% {
        stroke: #000000;
    }

    40% {
        stroke: #000000;
    }

    66% {
        stroke: #000000;
    }

    80%,
    90% {
        stroke: #000000;
    }
}

@keyframes color {
    0% {
        stroke: #000000;
    }

    40% {
        stroke: #000000;
    }

    66% {
        stroke: #000000;
    }

    80%,
    90% {
        stroke: #000000;
    }
}
</style>

<script src="<?php echo $_ENV['URL']?>public/js/deleteFulfillment.js"></script>

<?php
  }
}