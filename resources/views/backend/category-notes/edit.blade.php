@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Измененить категорию {{$categoryNotes->name}}</div>

                <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif  
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif                                 
                <form enctype="multipart/form-data" id="control-form" action="{{ route('admin.category-notes.update',$categoryNotes->id)}}" method="POST">
                    @method('PUT')
                    <div class="form-group">
                        <label for="category-notes-name">Название</label>
                        <input name="name" type="text" class="form-control" id="category-notes-name" aria-describedby="The name of the category" value="{{$categoryNotes->name}}">
                        <small id="category-notes-name-help" class="form-text text-muted">You can change </small>
                    </div>
                    <div class="form-group">
                        <label for="category-notes-color">Цвет</label>
                        <div id="category-color-select">
                            <select name="color_id" class="form-control" data-container="#category-color-select">
                                <option></option>
                                @foreach($colors as $color)
                                    @if($categoryNotes->color->id == $color->id)
                                        <option selected value="{{$color->id}}">{{$color->name}}</option>
                                    @else
                                        <option value="{{$color->id}}">{{$color->name}}</option>
                                    @endif
                                @endforeach  
                            </select>
                        </div>  
                        <small id="category-notes-color-help" class="form-text text-muted">You can change </small>
                    </div>
                    <div class="form-group mb-2">
                        <label for="category-notes-img">Изображение</label>                      
                        <input type="file" name="image" id="category-notes-img" 
                        aria-describedby="The image of the category" class="form-control mb-2">
                        @if (isset($categoryNotes->img))
                        <img src="{{asset('/storage/' . $categoryNotes->img)}}" class="rounded float-start" alt="avatar">  
                        @endif                          
                        <small id="category-notes-img-help" class="form-text text-muted">You can change </small>
                    </div>

                   
                    @csrf
                    <button type="submit" class="btn btn-primary">Применить</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection