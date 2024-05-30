@php
    $layout = auth()->user()->rol === 'admin' ? 'layouts.app-admin' : 'layouts.app-user';
@endphp

@extends($layout)

@section('title', 'Historial Devoluciones')

@section('contenido_principal')
    <div class="md:ml-64">
        <div class="p-4">
            <h2 class="text-2xl font-semibold mb-4">Ver Devoluciones del Derecho de Petición {{ $peticion->numero_radicado }}</h2>
            
            @forelse ($peticion->devoluciones as $devolucion)
            <div class="border border-gray-800 p-2 mb-4">
                <h3 class="text-lg font-semibold mb-2">Devolución Número {{ $loop->iteration }}</h3>
                <p>ID Devolución: {{ $devolucion->id }}</p>
                <br>
                <p>Usuario Original: {{ $devolucion->user->name }}</p>
                <p>Correo Electrónico: {{ $devolucion->user->email }}</p>
                <p>Razón: {{ $devolucion->razon }}</p>
                <br>
                <p>
                    @if ($devolucion->nombre_reasignado && $devolucion->email_reasignado)
                        <p>Reasignado a: {{ $devolucion->nombre_reasignado }}</p>
                        <p>Correo Electrónico: {{ $devolucion->email_reasignado }}</p>
                    @else
                        Esta devolución no ha sido reasignada
                    @endif
                </p>
            </div>
        @empty
            <p>No hay devoluciones en esta petición</p>
        @endforelse
            
        </div>
    </div>
@endsection