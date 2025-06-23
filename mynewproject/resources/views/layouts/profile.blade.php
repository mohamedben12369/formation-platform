<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Profile')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-black text-white fixed h-full">
            <div class="p-6">
                <h2 class="text-xl font-bold mb-4">Mon Profil</h2>
                <nav class="space-y-4">
                    <a href="{{ route('profile.competences.index') }}" class="block hover:text-gray-300">Mes Compétences</a>
                    <a href="{{ route('profile.experiences.index') }}" class="block hover:text-gray-300">Mes Expériences</a>
                    <a href="{{ route('profile.diplomes.index') }}" class="block hover:text-gray-300">Mes Diplômes</a>
                    <a href="{{ route('profile.settings') }}" class="block hover:text-gray-300">Paramètres du Compte</a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="ml-64 flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
