<?= $this->extends('/index'); ?>

<?= $this->section("contentIndex");   ?>

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">forgot here...</h1>

        <form class="max-w-sm mx-auto" action="/forgot" method="post">
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
            </div>
     
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Send Reset Link</button>
            
            <?php if (session()->getFlashdata('msg')): ?>
                <p><?= session()->getFlashdata('msg') ?></p>
            <?php endif; ?>

        </form>
    </div>


<?=  $this->endSection();  ?>

