@extends('layouts.app')

@section('content')
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Nombre</th>
                    <th>Fecha Publicación</th>
                    <th>Estado</th>
                    <th>Turnos disponibles</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $row)
                    <tr>
                        <td><img src="{{ $row->image_url }}" alt="Imagen de la Película" style="width: 60px"></td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->published_at->toFormattedDateString() }}</td>
                        <td>{{ $row->is_active ? 'Activo' : 'Inactivo' }}</td>
                        <td>{{ $row->turns_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $rows->render() }}
@endsection
