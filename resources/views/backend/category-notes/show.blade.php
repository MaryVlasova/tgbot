@extends('backend.layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb mb-2">
            <div class="pull-left">
                <h2> Категория {{ $categoryNotes->name }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin.category-notes.index') }}"> Назад</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Название:</strong>
                {{ $categoryNotes->name }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Цвет:</strong>
                {{ $categoryNotes->color->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Изображение:</strong>
                @isset($categoryNotes->img)
                <div class="mb-2 mt-2">
                    <img src="{{asset('/storage/' . $categoryNotes->img)}}" class="rounded float-start " alt="avatar" width="24" height="24">  
                </div>
                @endisset
            </div>
        </div>

    </div>
</div>
@endsection