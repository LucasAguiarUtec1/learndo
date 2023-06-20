
<body>
    <div id="app">
    <nav class="navbar navbar-expand-lg navbar-light">
		<a class="navbar-brand" href="{{route('inicio')}}">
			<img src="{{ asset('images/1.png')}}" width="150" height="50" class="d-inline-block align-top" alt="Logo de Mi Página">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="{{route('inicio')}}">Inicio</a>
				</li>
                <li class="nav-item active">
					<a class="nav-link" href="{{route('forum.index')}}">Foro</a>
				</li>
				<li class="nav-item active">
					<a class="nav-link" href="{{route('mapa')}}">Mapa</a>
				</li>

				<li class="nav-item">
					<a class="nav-link" href="{{route('miscursos')}}">Cursos</a>
				</li>
				@if(Auth::check() && (Auth::user()->userable_type == 'App\Models\Estudiante' || Auth::user()->userable_type == 'App\Models\Organizador'))
				<li class="nav-item">
					<a class="nav-link" href="{{route('paypal')}}">paypal</a>
				</li>
				@endif
			</ul>
			<ul class="navbar-nav">
			<li class="nav-item">
					<a class="nav-link" href="{{route('ListarUsuarios')}}">Usuarios</a>
				</li>
				@if (Auth::check())
				<li class="nav-item">
					<a class="nav-link" href="{{route('logout')}}">Cerrar Sesión</a>
				</li>
				@else
				<li class="nav-item">
					<a class="nav-link" href="{{route('login')}}">Iniciar Sesión</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('registro')}}">Registrarse</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('maps')}}">Mapa</a>
				</li>
				@endif
				@if(Auth::check() && Auth::user()->userable_type == 'App\Models\Organizador')
				<li class="nav-item">
					<a class="nav-link" href="{{route('registrocurso')}}">Crear Curso</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('registroseminario')}}">Crear Seminario</a>
				</li>
				@endif
				@if(Auth::check() && (Auth::user()->userable_type == 'App\Models\Estudiante'))
				<li class="nav-item active">
					<a class="nav-link" href="{{route('comprar')}}">Comprar</a>
				</li>
				@endif
			</ul>
		</div>
	</nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
