<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel E-commerce</title>
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'spink': '#FF9999',
                        'primary': '#3B82F6',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-neutral-900 min-h-screen flex flex-col max-w-[1300px] mx-auto ">
    <!-- Header -->
    <x-header />

    <!-- Main Content -->
    <main class="flex-grow container mx-auto py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <x-footer />
</body>
</html>