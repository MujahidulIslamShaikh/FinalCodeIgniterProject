<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
	<div class="container mx-auto p-4">
		<h1 class="text-2xl font-bold mb-4">Users Table</h1>
		<a href="/">Back to Registration From</a>

		<form class="max-w-sm mx-auto" action="/signup-user" method="post">
			<div class="mb-5">
				<label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your username</label>
				<input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
			</div>
			<div class="mb-5">
				<label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
				<input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@flowbite.com" required />
			</div>
			<div class="mb-5">
				<label for="pass" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your pass</label>
				<input type="text" name="pass" id="pass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
			</div>
			<div class="mb-5">
				<label for="cpass" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your cpass</label>
				<input type="text" name="cpass" id="cpass" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
			</div>
			<button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
			 <?php if (session()->getFlashdata('error')): ?>
                <p style="color:red;"><?= session()->getFlashdata('error') ?></p>
            <?php endif; ?>
			<a href="/login-user">Login here</a>
		</form>
	</div>


</body>

</html>