@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')

<section class="space-y-6">
    <h1 class="text-black-primary-200 font-bold">ANALYTICS OVERVIEW</h1>
    <div class="grid grid-cols-4 gap-10 mb-10"> 
        <div class="px-3 py-5 bg-[#FFEFE2] flex flex-col items-center rounded-md gap-2 justify-center">
            <p class="text-3xl font-semibold text-center">{{$alumnos}}</p>
            <h1 class="text-center text-sm">Total de Estudiantes</h1>
        </div>
        <div class="px-3 py-5 bg-[#EFFCEF] flex flex-col items-center rounded-md gap-2">
            <p class="text-3xl font-semibold text-center">{{$profesores}}</p>
            <h1 class="text-center text-sm">Total de Profesores</h1>
        </div>
        <div class="px-3 py-5 bg-[#E6F5F9] flex flex-col items-center rounded-md gap-2">
            <p class="text-3xl font-semibold text-center">{{$asignaturas}}</p>
            <h1 class="text-center text-sm">Total de Asignaturas</h1>
        </div>
        <div class="px-3 py-5 bg-[#F4F6FA] flex flex-col items-center rounded-md gap-2">
            <p class="text-3xl font-semibold text-center">{{$aulas}}</p>
            <h1 class="text-center text-sm">Total de Aulas</h1>
        </div>
    </div>
    
    <div class="grid grid-cols-1 text-center lg:grid-cols-5 gap-10">
        <div class="col-span-3">
            <canvas id="myLineChart" class="" height="200px"></canvas>
        </div>
        <div class="">
            
        </div>
        <div class="col-span-3">
            <canvas id="myBarChart" height="200px"></canvas>
        </div>
        <div>
            
        </div>
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


        const ctx2 = document.getElementById('myBarChart').getContext('2d');
        const myBarChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: @json($labelsMeses),
                datasets: [{
                    label: 'Alumnos Matriculados este Año',
                    data: @json($dataAlumnos),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
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
            }
        });
      </script>
</section>
@endsection