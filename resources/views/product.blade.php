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
            'Category',
            'tags',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];
    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    <x-adminlte-datatable id="table1" :heads="$heads">
        @foreach($products as $row)
            <tr>
                <td>{{$row->id}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->category->name?? '--'}}</td>
                <td>{{$row->tags}}</td>
                <td>
                    <a class="btn btn-xs btn-default text-primary mx-1 shadow" title="Details" href="{{route('product.edit', [$row->id])}}"><i class="fa fa-lg fa-fw fa-pen"></i></a>

                    <a class="btn btn-xs btn-default text-danger mx-1 shadow" title="Details" href="{{route('product.delete', [$row->id])}}">
                        <i class="fa fa-lg fa-fw fa-trash"></i></a>
                </td>
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
