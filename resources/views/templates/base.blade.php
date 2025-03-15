<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @routes
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/index.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/dataTables/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/dataTables/responsive.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fontawesome/css/all.css') }}">
    @stack('styles')
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    <title>@yield('title')</title>
    <!-- Scripts de SweetAlert2 -->
    <script src="{{ asset('lib/sweetalert/index.js') }}"></script>
    <!-- Estilos de SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('lib/sweetalert/dark.css') }}">
    <meta id='csrf' name='csrf-token' content='{{ csrf_token() }}'>
    <link rel="shortcut icon" href="{{ asset('vitanis-inventory-logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('lib/spinner/spinner.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="stylesheet" href="{{asset('lib/animation/style.css')}}">
    @viteReactRefresh
    {{-- @vite(['resources/css/app.css', 'resources/js/app.jsx']) --}}

</head>

<body class="bg-dark text-light" data-bs-theme="dark">
    <!-- Spinner -->
    {{-- <div id="loading-spinner">
        <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div> --}}
    @yield('body')
    @include('templates.modal')
    <script src="{{ asset('lib/jquery/index.js') }}"></script>
    <script src="{{ asset('lib/bootstrap/index.js') }}"></script>
    <script src="{{ asset('lib/sweetalert/index.js') }}"></script>
    <script src="{{ asset('lib/dataTables/dataTables.min.js') }}"></script>
    <script src="{{ asset('lib/dataTables/responsive.min.js') }}"></script>
    <script>
        const langFile = "{{ asset('lib/dataTables/Spanish.json') }}";
    </script>
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register("{{ asset('sw.js') }}")
                .then(function(registration) {
                    console.log("Service Worker registrado con éxito:", registration);
                })
                .catch(function(error) {
                    console.log("Error al registrar el Service Worker:", error);
                });
        }
    </script>

</body>
<script>
    const setMethodHeaders = (method, body = []) => {
        switch (method) {
            case 'POST':
                return {
                    method,
                    body,
                    headers: {
                        'X-CSRF-TOKEN': $('#csrf').attr('content'),
                        Accept: 'application/json'
                    }
                }
                break;
            case 'PUT':
                return {
                    method,
                    body: JSON.stringify(Object.fromEntries(body)),
                        headers: {
                            'X-CSRF-TOKEN': $('#csrf').attr('content'),
                            Accept: 'application/json',
                            'Content-Type': 'application/json'
                        }
                }
                break;
            case 'DELETE':
                return {
                    method,
                    headers: {
                        'X-CSRF-TOKEN': $('#csrf').attr('content'),
                        Accept: 'application/json'
                    }
                }
        }
    }
</script>

@stack('scripts')
{{-- <script src="{{asset('lib/spinner/spinner.js')}}"></script> --}}

</html>
