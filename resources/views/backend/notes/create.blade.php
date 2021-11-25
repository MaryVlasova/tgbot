@extends('backend.layouts.app')
@section('content')
<div class="container">
    <div class="row mb-2">
        <div class="col-lg-12 margin-tb mb-2">
            <div class="pull-left">
                <h2>Создание записки</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin.notes.index') }}"> Назад</a>
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

    <form enctype="multipart/form-data" action="{{ route('admin.notes.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Заголовок:</strong>
                    <input type="text" name="title" class="form-control" placeholder="Заголовок">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Текст:</strong>
                    <textarea aria-describedby="The text of the note" name="text" id="note-text" class="form-control" rows="10" placeholder="Короткий текст"></textarea>  
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Категория:</strong>
                <div id="category-notes-select">
                    <select name="category_notes_id" class="form-control" data-container="#category-notes-select">
                        <option></option>
                        @foreach($categoriesOfNotes as $categoryNotes)
                            <option value="{{$categoryNotes->id}}">{{$categoryNotes->name}}</option>
                        @endforeach
                    </select>
                </div>

                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Изображение:</strong>
                <div id="category-notes-select">
                    <input type="file" name="image" id="note-img" 
                        aria-describedby="The image of the note" class="form-control">
                </div>

                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </form>
</div>
@endsection