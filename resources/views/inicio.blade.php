<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Página web de LearnDo, para vender cursos" />
    <title>LearnDo - Cursos en línea</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Barra de navegación -->
    <nav id="header" class="fixed w-full z-10 top-0 bg-white shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 py-2">
            <div class="pl-4 flex items-center">
                <a class="text-gray-900 text-base no-underline hover:no-underline font-extrabold text-xl" href="#">
                    LearnDo
                </a>
            </div>
            <div class="block lg:hidden pr-4">
                <button id="nav-toggle"
                    class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-gray-900 hover:border-teal-500 appearance-none focus:outline-none">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <title>Menu</title>
                        <path
                            d="M0 3a3 3 0 013-3h14a3 3 0 013 3v2a3 3 0 01-3 3H3a3 3 0 01-3-3V3zm0 8a3 3 0 013-3h14a3 3 0 013 3v2a3 3 0 01-3 3H3a3 3 0 01-3-3v-2z" />
                    </svg>
                </button>
            </div>
            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block pt-6 lg:pt-0"
                id="nav-content">
                <ul class="list-reset lg:flex justify-end flex-1 items-center">
                    <li class="mr-3">
                        <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-2 px-4"
                            href="{{route('login')}}">Iniciar Sesion</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block py-2 px-4 text-gray-900 font-bold no-underline" href="#">Inicio</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-2 px-4"
                            href="{{route('usuarios')}}">Mostrar Usuarios</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block text-gray-600 no-underline hover:text-gray-900 hover:text-underline py-2 px-4"
                            href="#">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
        <hr class="border-b border-gray-100 opacity-25 my-0 py-0" />
    </nav>

    <!-- Sección de cabecera -->
    <header class="w-full container mx-auto">
        <div class="flex flex-col items-center py-12">
            <h1 class="text-5xl font-bold mb-2">Aprende a tu ritmo</h1>
            <h2 class="text-xl text-gray-600">Con los mejores cursos en línea</h2>
            <a href="#" class="mt-8 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Ver cursos
            </a>
        </div>
    </header>

    <!-- Sección de cursos -->
    <section class="bg-white py-8">
        <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
            <nav id="store" class="w-full z-30 top-0 px-6 py-1">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl"
                        href="#">
                        Cursos
                    </a>
                    <div class="flex items-center" id="store-nav-content">
                        <div class="relative">
                            <button
                                class="flex items-center text-gray-800 border border-gray-800 rounded py-2 px-3 mr-1 hover:bg-gray-800 hover:text-white">
                                Filtro
                                <svg class="h-4 w-4 fill-current ml-2" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path
                                        d="M0 3a3 3 0 013-3h14a3 3 0 013 3v2a3 3 0 01-3 3H3a3 3 0 01-3-3V3zm0 8a3 3 0 013-3h14a3 3 0 013 3v2a3 3 0 01-3 3H3a3 3 0 01-3-3v-2z" />
                                </svg>
                            </button>
                            <ul
                                class="absolute hidden text-gray-700 pt-1 group-hover:block bg-white rounded-lg shadow-lg z-20">
                                <li>
                                    <a class="rounded-t-lg px-4 py-2 block text-gray-900 font-bold hover:bg-gray-500 hover:text-white"
                                        href="#">
                                        Curso 1
                                    </a>
                                </li>
                                <li>
                                    <a class="px-4 py-2 block text-gray-800 font-bold hover:bg-gray-500 hover:text-white"
                                        href="#">
                                        Curso 2
                                    </a>
                                </li>
                                <li>
                                    <a class="rounded-b-lg px-4 py-2 block text-gray-800 font-bold hover:bg-gray-500 hover:text-white"
                                        href="#">
                                        Curso 3
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
            </div>
            <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                <a href="#">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1601655115999-7c69aae00c7d" alt="Placeholder"
                            class="transform hover:scale-110 transition duration-300 ease-in-out" />
                    </div>
                    <h3 class="text-xl font-medium py-2">Curso 1</h3>
                    <p class="py-2 text-gray-600 text-sm">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec
                        auctor in, mattis vitae leo.
                    </p>
                    <span class="text-gray-900 pb-2">$20</span>
                </a>
            </div>
            <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                <a href="#">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1601655115999-7c69aae00c7d" alt="Placeholder"
                            class="transform hover:scale-110 transition duration-300 ease-in-out" />
                    </div>
                    <h3 class="text-xl font-medium py-2">Curso 2</h3>
                    <p class="py-2 text-gray-600 text-sm">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec
                        auctor in, mattis vitae leo.
                    </p>
                    <span class="text-gray-900 pb-2">$30</span>
                </a>
            </div>
            <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                <a href="#">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1601655115999-7c69aae00c7d" alt="Placeholder"
                            class="transform hover:scale-110 transition duration-300 ease-in-out" />
                    </div>
                    <h3 class="text-xl font-medium py-2">Curso 3</h3>
                    <p class="py-2 text-gray-600 text-sm">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec
                        auctor in, mattis vitae leo.
                    </p>
                    <span class="text-gray-900 pb-2">$40</span>
                </a>
            </div>
            <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                <a href="#">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1601655115999-7c69aae00c7d" alt="Placeholder"
                            class="transform hover:scale-110 transition duration-300 ease-in-out" />
                    </div>
                    <h3 class="text-xl font-medium py-2">Curso 4</h3>
                    <p class="py-2 text-gray-600 text-sm">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec
                        auctor in, mattis vitae leo.
                    </p>
                    <span class="text-gray-900 pb-2">$50</span>
                </a>
            </div>
        </div>
        </div>
    </section>

    <section class="bg-gray-100 py-8">
        <div class="container mx-auto px-2 pt-4 pb-12 text-gray-800">
            <h1 class="text-2xl font-medium mb-2 text-gray-800">¿Por qué elegirnos?</h1>
            <p class="mb-4 leading-relaxed">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec
                auctor in, mattis vitae leo. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc
                quam urna, dignissim nec auctor in, mattis vitae leo.
            </p>
            <div class="flex flex-wrap">
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <div class="h-full flex flex-col items-center text-center">
                        <img alt="team" class="flex-shrink-0 rounded-lg w-full h-56 object-cover object-center mb-4"
                            src="https://images.unsplash.com/photo-1581098763499-7f77f6c74568" />
                        <div class="w-full">
                            <h2 class="title-font font-medium text-lg text-gray-900">Expertos en la materia</h2>
                            <h3 class="text-gray-500 mb-3">Calidad garantizada</h3>
                            <p class="mb-4">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim
                                nec auctor in, mattis vitae leo.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <div class="h-full flex flex-col items-center text-center">
                        <img alt="team" class="flex-shrink-0 rounded-lg w-full h-56 object-cover object-center mb-4"
                            src="https://images.unsplash.com/photo-1573497491454-4f3c4e5e8ef5" />
                        <div class="w-full">
                            <h2 class="title-font font-medium text-lg text-gray-900">Enseñanza personalizada</h2>
                            <h3 class="text-gray-500 mb-3">Ajustamos el ritmo a tus necesidades</h3>
                            <p class="mb-4">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim
                                nec auctor in, mattis vitae leo.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                    <div class="h-full flex flex-col items-center text-center">
                        <img alt="team" class="flex-shrink-0 rounded-lg w-full h-56 object-cover object-center mb-4"
                            src="https://images.unsplash.com/photo-1573497491454-4f3c4e5e8ef5" />
                        <div class="w-full">
                            <h2 class="title-font font-medium text-lg text-gray-900">Enseñanza personalizada</h2>
                            <h3 class="text-gray-500 mb-3">Ajustamos el ritmo a tus necesidades</h3>
                            <p class="mb-4">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim
                                nec auctor in, mattis vitae leo.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="text-gray-700 body-font">
        <div class="container px-5 py-8 mx-auto flex items-center sm:flex-row flex-col">
            <a class="flex title-font font-medium items-center md:justify-start justify-center text-gray-900" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-blue-500 rounded-full"
                    viewBox="0 0 24 24">
                    <path d="M12 1L2 7v10l10 6V1z" />
                </svg>
                <span class="ml-3 text-xl">LearnDo</span>
            </a>
            <p class="text-sm text-gray-500 sm:ml-4 sm:pl-4 sm:border-l-2 sm:border-gray-200 sm:py-2 sm:mt-0 mt-4">©
                2023 LearnDo — <a href="#" class="text-gray-600 ml-1" rel="noopener noreferrer"
                    target="_blank">@learnDo</a></p>
            <span class="inline-flex sm:ml-auto sm:mt-0 mt-4 justify-center sm:justify-start">
                <a class="text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-5 h-5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-5 h-5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
                <a class="ml-3 text-gray-500">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                        <path d="M16 11.37V12a4 4 0 0 1-4 4H8"></path>
                        <path d="M14 3h-4a2 2 0 0 0-2 2v5h8V5a2 2 0 0 0-2-2z"></path>
                    </svg>
                </a>
            </span>
        </div>
    </footer>


</body>

</html>