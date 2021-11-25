@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Все записки</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('admin.notes.create') }}"> Создать новую запись</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered text-center">
        <tr>
            <th>Заголовок</th>
            <th>Описание</th>
            <th>Автор</th>
            <th>Действия</th>
        </tr>
        @foreach ($notes as $note)
        <tr>
            <td>
                <p>
                    @if (isset($note->categoryNotes->img))
                        <span class="mr-2">
                            <img src="{{asset('/storage/' . $note->categoryNotes->img)}}" class="rounded float-start" alt="avatar" width="24" height="24">  
                        </span>
                    @endif 
                    @if (isset($note->categoryNotes->name))
                        <span class="mr-2 text-{{$note->categoryNotes->color->code}}">
                            {{$note->categoryNotes->name}}
                        </span>
                    @endif                      
                </p>
               
                {{ $note->title }}
            </td>
            <td>{{ $note->text }}</td>
            <td>                        
                @if (isset($note->author->name))
                    {{$note->author->name}}
                @endif 
            </td>
            <td>

                <form action="{{ route('admin.notes.destroy',$note->id) }}" method="POST">
    
                    @csrf
                    @method('DELETE')
                    <div class="btn-group-vertical">
                        <a class="btn btn-outline-primary" href="{{ route('admin.notes.show',$note->id) }}">Посмотреть</a>
                        <a class="btn btn-outline-primary" href="{{ route('admin.notes.edit',$note->id) }}">Изменить</a>  
                        <button type="submit" class="btn btn-outline-danger">Удалить</button>
                    </div>   
                </form>     

            </td>
        </tr>
        @endforeach
    </table>
    {{ $notes->links('pagination::bootstrap-4') }}
</div>

@endsection