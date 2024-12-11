@extends('layouts.layout')

@section('title', 'Generar Reporte de Notas')
@section('content')
<div>
    <form id="reporteNotasForm" action="{{ route('notas.pdf') }}" method="GET">
        <label for="añoEscolar">Año Escolar:</label>
        <select id="añoEscolar" name="añoEscolar">
            <option value="">Seleccione un año escolar</option>
            @foreach($añosEscolares as $año)
                <option value="{{ $año->añoEscolar }}">{{ $año->añoEscolar }}</option>
            @endforeach
        </select>

        <label for="docentes">Docentes:</label>
        <select id="docentes" name="codigo_docente">
            <option value="">Seleccione un docente</option>
        </select>

        <label for="asignaturas">Asignaturas:</label>
        <select id="asignaturas" name="id_asignatura">
            <option value="">Seleccione una asignatura</option>
        </select>

        <label for="periodo">Periodo:</label>
        <select id="periodo" name="periodo">
            <option value="1">Periodo 1</option>
            <option value="2">Periodo 2</option>
            <option value="3">Periodo 3</option>
        </select>

        <button type="submit">Generar Reporte</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Cambiar el combo de docentes según el año escolar seleccionado
        $('#añoEscolar').change(function() {
            var añoEscolar = $(this).val();
            if (añoEscolar) {
                $.ajax({
                    url: '{{ route("docentesByAñoEscolar", "") }}/' + añoEscolar,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#docentes').empty().append('<option value="">Seleccione un docente</option>');
                        $.each(data.docentes, function(index, docente) {
                            $('#docentes').append('<option value="' + docente.codigo_docente + '">' + docente.nombre + '</option>');
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Error en la solicitud AJAX: ', textStatus, errorThrown);
                    }
                });
            } else {
                $('#docentes').empty().append('<option value="">Seleccione un docente</option>');
                $('#asignaturas').empty().append('<option value="">Seleccione una asignatura</option>');
            }
        });

        // Cambiar el combo de asignaturas según el docente seleccionado
        $('#docentes').change(function() {
            var codigoDocente = $(this).val();
            if (codigoDocente) {
                $.ajax({
                    url: '{{ route("asignaturasByDocente", "") }}/' + codigoDocente,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#asignaturas').empty().append('<option value="">Seleccione una asignatura</option>');
                        $.each(data.asignaturas, function(index, asignatura) {
                            $('#asignaturas').append('<option value="' + asignatura.idAsignatura + '">' + asignatura.nombreAsignatura + '</option>');
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Error en la solicitud AJAX: ', textStatus, errorThrown);
                    }
                });
            } else {
                $('#asignaturas').empty().append('<option value="">Seleccione una asignatura</option>');
            }
        });
    });
</script>
@endsection