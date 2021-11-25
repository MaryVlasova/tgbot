@extends('backend.layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb mb-2">
            <div class="pull-left mb-2">
                <h2>Создание категории записки</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin.category-notes.index') }}"> Назад</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form enctype="multipart/form-data" action="{{ route('admin.category-notes.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Название:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Название">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Цвет:</strong>
                <div id="category-color-select">
                    <select name="color_id" class="form-control" data-container="#category-color-select">
                        <option></option>
                        @foreach($colors as $color)
                            <option value="{{ $color->id }}">
                                {{ $color->name }}
                            </option>
                        @endforeach
                    </select>
                </div>     
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Изображение:</strong>
                <input type="file" name="image" id="category-notes-img" 
                        aria-describedby="The image of the category" class="form-control mb-2">   
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </form>
</div>
@endsection