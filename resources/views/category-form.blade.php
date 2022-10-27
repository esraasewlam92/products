@extends('adminlte::page')

@section('title', 'category form')

@section('content_header')
    <h1>Category Form</h1>
@stop


@section('content')
    <form method="POST"  action="{{ isset($category) ? route('category.update', [$category->id]) : route('category.store') }}">
        <div class="row">
            {{ csrf_field() }}
            @if(isset($category))
                <x-adminlte-input type="hidden" name="_method" value="PUT"/>
            @endif

            <x-adminlte-input type="text" name="name" label="category" placeholder="category" value="{{ old('name', $category->name ?? '') }}" required fgroup-class="col-md-6">
            </x-adminlte-input>

            <x-adminlte-select name="parent_id" data-placeholder="Category" label="Category" fgroup-class="col-md-6">
                <x-adminlte-options :options="$categories" :selected="[$category->parent_id ?? '']"/>
            </x-adminlte-select>
            <x-adminlte-select name="active" data-placeholder="active" label="active:" fgroup-class="col-md-6">
                <x-adminlte-options :options="$active" :selected="[$category->active ?? 0]"/>
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-check-circle text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-select>

            <div class="form-group col-md-12">
                <x-adminlte-button type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save"/>
                &nbsp;&nbsp;
                <x-adminlte-button type="reset" label="Reset" theme="outline-danger" icon="fas fa-lg fa-trash"/>
            </div>
        </div>
    </form>
@stop

