@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Category</h1>
@stop

@section('content')
    @php
        $heads = [
            'ID',
            'Name',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];

        $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button>';
        $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button>';
        $config = [
            'data' => [
                [22, 'John Bender',  '<nobr>'.$btnEdit.$btnDelete.'</nobr>'],
                [19, 'Sophia Clemens',  '<nobr>'.$btnEdit.$btnDelete.'</nobr>'],
                [3, 'Peter Sousa',  '<nobr>'.$btnEdit.$btnDelete.'</nobr>'],
            ],
            'order' => [[1, 'asc']],
            'columns' => [null, null, ['orderable' => false]],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads">
        @foreach($categories as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->name}}</td>
            </tr>
        @endforeach
    </x-adminlte-datatable>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
