@extends('adminlte::page')

@section('title', 'Product form')

@section('content_header')
    <h1>PRoduct Form</h1>
@stop


@section('content')
    <form method="POST"  action="{{ isset($product) ? route('product.update', [$product->id]) : route('product.store') }}">
        <div class="row">
            {{ csrf_field() }}
            @if(isset($product))
                <x-adminlte-input type="hidden" name="_method" value="PUT"/>
            @endif

            <x-adminlte-input type="text" name="name" label="product" placeholder="product" value="{{ old('name', $product->name ?? '') }}" required fgroup-class="col-md-6">
            </x-adminlte-input>

            <x-adminlte-select name="category_id" data-placeholder="Category" label="Category" fgroup-class="col-md-6">
                <x-adminlte-options :options="$categories" :selected="[$product->category_id ?? '']"/>
            </x-adminlte-select>

            <x-adminlte-input type="text" name="tags" label="Tags" placeholder="Tags" value="{{ old('tags', $product->tags ?? '') }}"  fgroup-class="col-md-6">
            </x-adminlte-input>


            <x-adminlte-input-file name="photo"  label="Photo:" fgroup-class="col-md-6"  placeholder="Choose a file...">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-lightblue">
                        <i class="fas fa-upload"></i>
                    </div>
                </x-slot>
            </x-adminlte-input-file>
            <x-adminlte-textarea name="description" label="Description" rows=5 label-class="text-warning" value="  {{ old('description', $product->description ?? '') }}"
                                 fgroup-class="col-md-6" placeholder="Insert description...">
                <x-slot name="prependSlot">
                    <div class="input-group-text bg-dark">
                        <i class="fas fa-lg fa-file-alt text-warning"></i>
                    </div>
                </x-slot>
            </x-adminlte-textarea>


            <div class="form-group col-md-12">
                <x-adminlte-button type="submit" label="Submit" theme="success" icon="fas fa-lg fa-save"/>
                &nbsp;&nbsp;
                <x-adminlte-button type="reset" label="Reset" theme="outline-danger" icon="fas fa-lg fa-trash"/>
            </div>
        </div>
    </form>
@stop

