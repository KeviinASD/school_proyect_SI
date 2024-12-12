<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\Asignatura;
use App\Models\Catedra;
use App\Models\Docente;
use App\Models\EstadoCivil;
use App\Models\Grado;
use App\Models\Nivel;
use App\Models\Seccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\AssignOp\Concat;

class ResumenXController extends Controller
{
    public function index () {
        $niveles = Nivel::where('estado', 1)->get();
        $grados = Grado::where('estado', 1)->get();
        $secciones = Seccion::where('estado', 1)->get();
        

        return view('pages.gradosYSecciones.index', compact('grados', 'niveles', 'secciones'));
    }

    public function welcome() {

         // Recuperar los objetos de la sesión
        $ficha1 = Session::get('ficha1');
        $ficha2 = Session::get('ficha2');
        $ficha3 = Session::get('ficha3');


        return view('welcome', compact('ficha1', 'ficha2', 'ficha3'));
    }

    public function director() {
        $profesores = count(Docente::where('estado', 1)->get());
        $asignaturas = count(Asignatura::where('estado', 1)->get());

        $profesContratados = Catedra::select('añoEscolar', DB::raw('count(distinct codigo_docente) as total'))
            ->groupBy('añoEscolar')
            ->orderBy('añoEscolar', 'asc')
            ->get();
        $labelsAños = $profesContratados->pluck('añoEscolar')->toArray();
        $dataProfesTotal = $profesContratados->pluck('total')->toArray();

        // Datos para el gráfico de asignaturas por nivel
        $asignaturasPorNivel = Asignatura::select('idNivel', DB::raw('count(*) as total'))
        ->where('estado', 1)
        ->groupBy('idNivel')
        ->get();

        $niveles = Nivel::whereIn('idNivel', $asignaturasPorNivel->pluck('idNivel'))->get()->keyBy('idNivel');

        $labelsNiveles = $asignaturasPorNivel->map(function ($item) use ($niveles) {
            return $niveles[$item->idNivel]->nombreNivel ?? 'Desconocido';
        })->toArray();

        $dataAsignaturas = $asignaturasPorNivel->pluck('total')->toArray();

        // Datos para el gráfico de docentes por estado civil
        $docentesPorEstadoCivil = EstadoCivil::withCount('docentes')->get();
        $labelsEstadosCiviles = $docentesPorEstadoCivil->pluck('nombreEstadoCivil')->toArray(); // Ajusta el campo según tu base de datos
        $dataEstadosCiviles = $docentesPorEstadoCivil->pluck('docentes_count')->toArray();

        return view('pages.dashboard.director', [
            'profesores' => $profesores,
            'asignaturas' => $asignaturas,

            'labelsAños' => $labelsAños,
            'dataProfesTotal' => $dataProfesTotal,

            'labelsNiveles' => $labelsNiveles,
            'dataAsignaturas' => $dataAsignaturas,

            'labelsEstadosCiviles' => $labelsEstadosCiviles,
            'dataEstadosCiviles' => $dataEstadosCiviles,
        ]);
    }

    public function dashboard() {

        $alumnos = count(Alumno::where('estado', 1)->get());
        $profesores = count(Docente::where('estado', 1)->get());
        $asignaturas = count(Asignatura::where('estado', 1)->get());
        $aulas = count(Seccion::where('estado', 1)->get());

        //labels: ['2024', '2023', '2022', '2021', '2020', '2019'],
        //data: [12, 19, 3, 5, 2, 3], cantidad de profesores contratados por añoEscolar

        $profesContratados = Catedra::select('añoEscolar', DB::raw('count(distinct codigo_docente) as total'))
            ->groupBy('añoEscolar')
            ->orderBy('añoEscolar', 'asc')
            ->get();

        $labelsAños = $profesContratados->pluck('añoEscolar')->toArray();
        $dataProfesTotal = $profesContratados->pluck('total')->toArray();

        $dataAlumnosTotal = $this->showEnrollmentChart();

        return view('pages.dashboard.index', [
            'alumnos' => $alumnos,
            'profesores' => $profesores,
            'asignaturas' => $asignaturas,
            'aulas' => $aulas,
            'labelsAños' => $labelsAños,
            'dataProfesTotal' => $dataProfesTotal,
            'labelsMeses' => $dataAlumnosTotal['labelsMeses'],
            'dataAlumnos' => $dataAlumnosTotal['dataAlumnos']
        ]);
    }

    public function showEnrollmentChart()
{
    // Obtener el último año escolar
    $ultimoAñoEscolar = DB::table('AÑO_ESCOLAR')
        ->orderBy('añoEscolar', 'desc')
        ->value('añoEscolar');

    // Obtener la cantidad de matriculas por mes en el último año escolar
    $matriculasPorMes = DB::table('FICHA_MATRICULAS')
        ->select(DB::raw('MONTH(fechaMatricula) as mes'), DB::raw('count(*) as total'))
        ->where('añoEscolar', $ultimoAñoEscolar)
        ->groupBy(DB::raw('MONTH(fechaMatricula)'))
        ->orderBy('mes')
        ->get();

    // Crear arrays para las etiquetas y los datos
    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    $labels = [];
    $data = [];

    // Rellenar los arrays con los datos obtenidos
    foreach ($matriculasPorMes as $matricula) {
        $labels[] = $meses[$matricula->mes - 1];
        $data[] = $matricula->total;
    }

    return [
        'labelsMeses' => $labels,
        'dataAlumnos' => $data
    ];
}

    

}
