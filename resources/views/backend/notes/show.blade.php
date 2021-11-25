@extends('backend.layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb mb-2">
            <div class="pull-left">
                <h2> Записка № {{ $note->id }}</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('admin.notes.index') }}"> Назад</a>
            </div>
        </div>
    </div>

    <div class="row">

        @if (isset($note->img))
        <div style="width: 18rem;">
            <div class="form-group">  
            <img src="{{asset('/storage/' . $note->img)}}" class="rounded float-start card-img-top" alt="avatar"> 
            </div>
        </div>  
        @endif   

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Заголовок:</strong>
                {{ $note->title }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Текст:</strong>
                {{ $note->text }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Автор:</strong>
                @isset($note->author->name)
                {{ $note->author->name }}
                @endisset
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Категория:</strong>
                @isset($note->categoryNotes->img)
                <img src="{{asset('/storage/' . $note->categoryNotes->img)}}" class="rounded float-start mr-2" alt="avatar" width="24" height="24">  
                @endisset

                @isset($note->categoryNotes->name)
                {{ $note->categoryNotes->name }}
                @endisset
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Создано:</strong>
                @isset($note->created_at)
                {{ $note->created_at }}
                @endisset
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Последнее изменение:</strong>
                @isset($note->updated_at)
                {{ $note->updated_at }}
                @endisset
            </div>
        </div>
    </div>
</div>
@endsection