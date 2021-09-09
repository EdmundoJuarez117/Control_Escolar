@extends('layouts.app')

@section('content')

@can('admin.modalidad.index')

<div class="row">
    <div class="col-12">
        <div class="card border border-1 border-light shadow-sm mb-3">
        <div class="card-header bg-primary text-white">{{
                $seccion_titulo}}</div>
                <div class="card-body">
                <modalidad-component 
                v-bind:modalidades="{{json_encode($modalidades)}}"
                v-bind:total="{{json_encode($totalData)}}">
                </modalidad-component>
                </div>
        </div>
    </div>
</div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
@stop
@endcan