<div class="min-h-screen flex flex-col sm:justify-center items-center pb-20 sm:pt-0 bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    @if (Request::is('login'))
        <div class="bg-blue-500 sm:max-w-md shadow-md w-full overflow-hidden sm:rounded-lg">
            <p class="font-bold text-white text-center mt-2 text-lg h-2">Iniciar Sesión</p>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg"
                style="background-image: url(images/LogoEspacioCrecer.jpeg); overflow: hidden; background-size: cover; background-position: center;">
                {{ $slot }}
            </div>
        </div>
    @elseif(Request::is('forgot-password'))
        <div class="bg-blue-500 sm:max-w-md shadow-md w-full overflow-hidden sm:rounded-lg">
            <p class="font-bold text-white text-center mt-2 text-lg h-2">Recuperar Contraseña</p>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg"
                style="background-image: url(images/LogoEspacioCrecer.jpeg); overflow: hidden; background-size: cover; background-position: center;">
                {{ $slot }}
            </div>
        </div>
    @elseif(Request::is('register'))
        <div class="mt-20 bg-blue-500 sm:max-w-md shadow-md w-full overflow-hidden sm:rounded-lg">
            <p class="font-bold text-white text-center mt-2 text-lg h-2">Registrarse</p>
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg"
                style="background-image: url(images/LogoEspacioCrecer.jpeg); overflow: hidden; background-size: cover; background-position: center;">
                {{ $slot }}
            </div>
        </div>
    @endif

</div>
