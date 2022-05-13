<?php
namespace app\views\single\components;

class createShipping{
  public function __construct()
  {
    ?>
<div id="create-info-shipping" class="border border-2 border-balck rounded-lg border-solid hidden">

    <div class="bg-gray-200  w-full shadow-lg rounded-t-lg overflow-hidden p-4  text-center">
        Create Shipping
    </div>

    <div class="h-auto w-full p-4 ">
        <form id="tracking_number" method="post">

            <input type="hidden" name="orderId" value="<?php echo $this->orderData['id'] ?>">

            <div class="form-group mb-6">
                <input type="text"
                    class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none disabled:opacity-75 disabled:bg-gray-100"
                    id="inputTrackingCode" name="inputTrackingCode" aria-describedby="inputTrackingCode"
                    placeholder="Shipping Tracker Code">
            </div>


            <div class="form-group form-check text-left mb-6">
                <div class="my-4">
                    <input type="checkbox"
                        class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain mr-2 cursor-pointer"
                        id="checkNotification" value="true" name="checkNotification" checked>
                    <label class="form-check-label inline-block text-gray-800" for="checkNotification">Notificar al
                        Usuario via Email</label>
                </div>
                <div class="my-4">
                    <input type="checkbox"
                        class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain mr-2 cursor-pointer"
                        id="checkTracking" value="true" name="checkTracking">
                    <label class="form-check-label inline-block text-gray-800" for="checkTracking">Creacion
                        automatica del shipping tracking number</label>
                </div>
            </div>
            <div class="text-center">
                <button type="submit"
                    class="w-2/5 px-6 py-2.5 bg-green-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-700 hover:shadow-lg focus:bg-green-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-800 active:shadow-lg transition duration-150 ease-in-out">Create</button>
                <button id="cancelCreateShipping"
                    class="w-2/5 px-6 py-2.5 bg-red-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out">Cancel</button>
            </div>
        </form>


    </div>

</div>

<script src="<?php echo $_ENV['URL']?>/public/js/single.js"></script>

<?php
  }
}