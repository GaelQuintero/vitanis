<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @routes
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/index.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/dataTables/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/dataTables/responsive.min.css') }}">
    @stack('styles')
    {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}"> --}}
    <title>@yield('title')</title>
    <meta id='csrf' name='csrf-token' content='{{ csrf_token() }}'>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>

<body style="background-color: #eaeded;">
    @yield('body')
    @include('templates.modal')
    <script src="{{ asset('lib/jquery/index.js') }}"></script>
    <script src="{{ asset('lib/bootstrap/index.js') }}"></script>
    <script src="{{ asset('lib/sweetalert/index.js') }}"></script>
    <script src="{{ asset('lib/dataTables/dataTables.min.js') }}"></script>
    <script src="{{ asset('lib/dataTables/responsive.min.js') }}"></script>
    <script src="{{ asset('lib/orgchart/orgchart.js') }}"></script>
    <script>
        const langFile = "{{ asset('lib/dataTables/Spanish.json') }}";
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

</html>
