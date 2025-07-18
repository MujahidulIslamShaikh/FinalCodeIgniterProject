<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>
   <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Reset here...</h1>

        <form class="max-w-sm mx-auto" action="/reset-password/<?= $token ?>" method="post">
            <div class="mb-5">
                <label for="pass" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                <input type="text" name="pass" id="pass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="New Password" required />
            </div>
     
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Reset</button>
            


        </form>
    </div>

</body>
</html>