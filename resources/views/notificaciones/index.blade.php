@extends('templates.base')

@section('titulo', env('APP_NAME') . ' - Inventario')
@extends('templates.nav')
@section('body')
    <div class=" container p-4" data-bs-theme="dark">
        <div class="row">
            <div class="col-md-12 mb-3 text-end">
                <a class="btn btn-primary rounded-3" href="{{ route('dashboard') }}">Volver</a>
            </div>
            <div class="col-md-12 mb-3 ">
                <h4>Notificaciones 🛎️</h4>
            </div>
           
            <div class="col-md-12 mb-3">
                <ul class="list-group">
                    @forelse($notificaciones as $notification)
                        <div
                            class=" alert text-light-emphasis {{ $notification->read_at ? 'alert-light' : 'alert-primary' }}">
                            <strong>{{ $notification->data['title'] }}</strong><br>
                            {{ $notification->data['message'] }} <br>
                            {{-- <a href="{{ $notification->data['url'] }}" class="btn btn-primary btn-sm mt-2">Ver más</a> --}}
                            <br>
                            <!-- Formulario para marcar como leído -->
                             <div class="col-md-12">
                                <form class="col-md-12" action="{{ route('notificaciones.leer', $notification->id) }}"
                                    method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="btn btn-secondary btn-sm {{ $notification->read_at ? 'visually-hidden' : '' }}">Marcar
                                        como leído</button>
                                </form>
                                <p class="text-muted">
                                    @if ($notification->read_at)
                                        Notificación leida {{ $notification->read_at->diffForHumans() }}
                                    @endif
                                </p>
                            </div> 

                     </div>
                    @empty
                        <li class="list-group-item text-center text-muted">No hay notificaciones nuevas.</li>
                    @endforelse
            </div>
        </div>
    </div>
    {{-- <div id="app"></div> --}}


@endsection
@push('scripts')
    {{-- <script src="{{ asset('js/notificaciones.js') }}" defer></script> --}}
@endpush
