@extends('layouts.layout')

@section('title', 'Welcome')

@section('content')
    <h1>Welcome to our website!</h1>
    <p>This is the content of the welcome page.</p>
    <div>
        <h1>PROBANDO LOS IDS DE LAS FICHAS</h1>

        <p>ID FICHA PERIODO 1: {{$ficha1}}</p>
        <p>ID FICHA PERIODO 2: {{$ficha2}}</p>
        <p>ID FICHA PERIODO 3: {{$ficha3}}</p>
    </div>
@endsection