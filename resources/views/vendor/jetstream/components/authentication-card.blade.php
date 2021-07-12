<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    <div class="bg-blue-500 sm:max-w-md shadow-md overflow-hidden sm:rounded-lg">
        <p class="font-bold text-white text-center mt-2 text-lg h-2">Iniciar Sesión</p>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg" style="background-image: url(images/LogoEspacioCrecer.jpeg); overflow: hidden; background-size: cover; background-position: center;">
        {{ $slot }}
    </div>
    </div>
</div>
