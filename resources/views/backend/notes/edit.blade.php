@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Измененить записку') }}</div>

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
                <form enctype="multipart/form-data" id="control-form" action="{{ route('admin.notes.update',$note->id)}}" method="POST">
                    @method('PUT')
                    <div class="form-group">
                        <label for="note-title">Заголовок</label>
                        <input name="title" type="text" class="form-control" id="note-title" aria-describedby="The title of the note" value="{{$note->title}}">
                        <small id="note-title-help" class="form-text text-muted">You can change </small>
                    </div>
                    <div class="form-group">
                        <label for="note-text">Текст</label>
                        <textarea aria-describedby="The text of the note" name="text" id="note-text" class="form-control" rows="10">{{$note->text}}</textarea>
                        <small id="note-text-help" class="form-text text-muted">You can change </small>
                    </div>
                    <div class="form-group">
                        <label for="note-text">Категория</label>
                        <div id="category-notes-select">
                            <select name="category_notes_id" class="form-control" data-container="#category-notes-select">
                                <option></option>
                                @foreach($categoriesOfNotes as $categoryNotes)
                                    @if($note->categoryNotes->id == $categoryNotes->id)
                                        <option selected value="{{$categoryNotes->id}}">{{$categoryNotes->name}}</option>
                                    @else
                                        <option value="{{$categoryNotes->id}}">{{$categoryNotes->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <small id="note-text-help" class="form-text text-muted">You can change </small>
                    </div>
                    <div class="form-group">
                        <label for="note-img">Изображение</label>                      
                        <input type="file" name="image" id="note-img" 
                        aria-describedby="The image of the note" class="form-control">
                        @if (isset($note->img))
                        <div class="mt-2 mw-100">
                            <div class="form-group">  
                            <img src="{{asset('/storage/' . $note->img)}}" class="rounded float-start mw-100" alt="avatar"> 
                            </div>
                        </div> 
                        @endif                          
                        <small id="note-img-help" class="form-text text-muted">You can change </small>
                    </div>

                   
                    @csrf
                    <button type="submit" class="btn btn-primary mt-2">Применить</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection