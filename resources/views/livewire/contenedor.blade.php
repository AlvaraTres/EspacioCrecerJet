<div class=" bg-white">

    <!-- presentación -->
    <a href="#" name="acercaDeNosotros"></a>
    <div class="grid grid-cols-1 md:grid-cols 2 lg:grid-cols-3 gap-3">
        <div></div>
        <div class="mx-auto">
            <img src="{{ asset('images/LogoEspacioCrecersinfondo.png') }}" style="margin: -4%;">
        </div>
        <div></div>
        <div></div>
        <div>
            <h1 class="text-3xl text-center text-teal-400 col-span-2">BIENVENIDOS/AS, SOMOS UN GRUPO DE PSICÓLOGOS/AS
                QUE BUSCA PROMOVER LA SALUD MENTAL DENTRO DE LA COMUNIDAD. NUESTRO QUEHACER VA DIRIGIDO HACIA NIÑOS/AS,
                JÓVENES, ADULTOS/AS Y ADULTOS/AS MAYORES.</h1>
        </div>
        <div></div>
    </div>

    <!-- información de los servicios y links -->
    <a href="#" name="tarifa"></a>
    <div class="container" style="margin-top: 4%;">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            <div class="bg-white p-4 text-center js-show-on-scroll-left"><strong class="text-teal-700">¿Cómo funcionamos?</strong><br><p class="text-center text-teal-600">Crea tu cuenta <a href="{{ route('register') }}" class="underline text-green-900">aquí</a>, e indica el motivo de tu consulta al momento de reservar hora, para asi mantener a nuestro equipo al tanto de tu situación antes de la primera sesión.</p></div>
            <div class="bg-white p-4 text-center js-show-on-scroll-right"><strong class="text-teal-700">¿Cómo agendo?</strong><br><p class="text-center text-teal-600">Agenda una sesión con nosotros en el calendario de reservas, dónde puedes escoger al psicológo y revisar sus horarios de atención.</p></div>
            <div class="bg-white p-4 text-center js-show-on-scroll-left"><strong class="text-teal-700">¿Cuánto cuesta?</strong><br><p class="text-center text-teal-600">Para estudiantes universitarios el valor de la sesión es de $15.000. Mientras que para niños, adultos y mayores es de $20.000.</p></div>
            <div class="bg-white p-4 text-center js-show-on-scroll-right"><strong class="text-teal-700">¿Cómo pagar?</strong><br><p class="text-center text-teal-600">Por el momento tenemos sólo habilitado el pago mediante la plataforma <a href="https://www.paypal.com/cl/home" target="_blank" class="underline text-green-900">Paypal</a>, prontamente se integrará a los medios de pago la plataforma transbank.</p></div>
        </div>
        <div class="grid grid-cols-3">
            <div></div>
            <div><div class="bg-white p-4 text-center js-show-on-scroll-left"><strong class="text-teal-700">A tener en cuenta</strong><br><p class="text-center text-red-900"> - La primera sesión es gratuita.</p><p class="text-center text-red-900"> - Para estudiantes universitarios, al momento de crear tu perfil debes adjuntar tu certificado de alumno regular vigente.</p></div>
        </div>
            <div></div>
        </div>
    </div>
    <a href="#" name="profesionales"></a>
    <div class="grid grid-cols-1 md:grid-cols 2 lg:grid-cols-4 gap-4" style="margin-top: 4%;">
        
        <div></div>
        <div class="col-span-2">
            <h1 class="text-3xl text-center text-teal-400 col-span-2">NUESTROS PROFESIONALES.</h1>
        </div>
        <div></div>
    </div>
    <!-- información de los profesionales -->
    <div class="container" style="margin-top: 4%;">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            <div class="bg-blue-300 text-center rounded-lg js-show-on-scroll-left">
                <img class="rounded-lg" src="{{ asset('images/perfil_barbara.jpeg') }}" alt="">
            </div>
            <div class="bg-blue-300 text-center rounded-lg js-show-on-scroll-right">
                <img class="rounded-lg" src="{{ asset('images/perfil_daska.jpeg') }}" alt="">
            </div>
            <div class="bg-blue-300 text-center rounded-lg js-show-on-scroll-left">
                <img class="rounded-lg" src="{{ asset('images/perfil_nicolas.jpeg') }}" alt="">
            </div>
            <div class="bg-blue-300 text-center rounded-lg js-show-on-scroll-right">
                <img class="rounded-lg" src="{{ asset('images/perfil_sofia.jpeg') }}" alt="">
            </div>
        </div>
    </div>

    <script type="text/javascript">
        const callback = function(entries) {
            entries.forEach((entry) => {
                console.log(entry);

                if(entry.isIntersecting){
                    entry.target.classList.add("animate-fade-in-left");
                }else{
                    entry.target.classList.remove("animate-fade-in-left");
                }
            });
        };

        const observer = new IntersectionObserver(callback);

        const targets = document.querySelectorAll(".js-show-on-scroll-left");
        targets.forEach(function(target){
            target.classList.add("opacity-1");
            observer.observe(target);
        });
    </script>
    <script type="text/javascript">
        const callback2 = function(entries) {
            entries.forEach((entry) => {
                console.log(entry);

                if(entry.isIntersecting){
                    entry.target.classList.add("animate-fade-in-right");
                }else{
                    entry.target.classList.remove("animate-fade-in-right");
                }
            });
        };

        const observer2 = new IntersectionObserver(callback2);

        const targets2 = document.querySelectorAll(".js-show-on-scroll-right");
        targets2.forEach(function(target){
            target.classList.add("opacity-1");
            observer2.observe(target);
        });
    </script>
</div>
