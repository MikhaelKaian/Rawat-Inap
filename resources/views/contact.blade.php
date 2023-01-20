<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>Contact</title>
</head>
<body>
    <div class="container mx-auto m-6 p-6">
        <!-- Component-->
        <form class="w-full max-w-lg" method="POST" action="{{ route ('contact.send') }}">
            @csrf
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" 
                    for="grid-password">Email</label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4"
                     id="email" type="email" name="email">
                </div>
                @error('email')
                <span>{{message}}</span>
                @enderror
            </div>

            <div class="md:flex md-items-center">
                <div class="md:w-1/3">
                    <button class="shadow bg-blue-400 hover:bg-teal-400 focus:shadow-outline focus:outline-none text-white font-bold mb-2"
                    type="submit">Send
                    </button>
            </div>
                <div class="md:w-2/3">
                </div>
            </div>
        </form>
    </div>
</body>
</html> 