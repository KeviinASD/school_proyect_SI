@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')

<section class="space-y-6">
    <h1 class="text-black-primary-200 font-bold">ANALYTICS OVERVIEW</h1>
    <div class="grid grid-cols-4 gap-10 mb-10"> 
        <div class="px-3 py-5 bg-[#EFFCEF] flex flex-col items-center rounded-md gap-2">
            <p class="text-3xl font-semibold text-center">{{$profesores}}</p>
            <h1 class="text-center text-sm">Total de Profesores</h1>
        </div>
        <div class="px-3 py-5 bg-[#E6F5F9] flex flex-col items-center rounded-md gap-2">
            <p class="text-3xl font-semibold text-center">{{$asignaturas}}</p>
            <h1 class="text-center text-sm">Total de Asignaturas</h1>
        </div>
    </div>

    <h1 class="font-bold text-2xl">Docentes</h1>
    <div class="m-auto my-10 flex">
        <div class="w-1/2">
            <canvas id="myLineChart" class="" width="300px" height="300px"></canvas>
        </div>
        <div class="w-1/2">
            <canvas id="docentes-estadocivil" class="" width="300px" height="300px"></canvas>
        </div>
    </div>
    <h1 class="font-bold text-2xl">Cursos</h1>
    <div>
        <canvas id="cursos-nivel"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myLineChart').getContext('2d');
        const myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labelsAños),
                datasets: [{
                    label: 'Profesores Contratados',
                    data: @json($dataProfesTotal),
                    fill: false,
                    borderColor: 'rgb(17, 17, 17)',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const ctx2 = document.getElementById('cursos-nivel').getContext('2d');
        const myBarChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: @json($labelsNiveles),
                datasets: [{
                    label: 'Cursos por Nivel',
                    data: @json($dataAsignaturas),
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        })

        const ctx3 = document.getElementById('docentes-estadocivil').getContext('2d');
        const myPieChart = new Chart(ctx3, {
            type: 'doughnut',
            data: {
                labels: @json($labelsEstadosCiviles),
                datasets: [{
                    label: 'Docentes por Estado Civil',
                    data: @json($dataEstadosCiviles),
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        })
    </script>
</section>
@endsection