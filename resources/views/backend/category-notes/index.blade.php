@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Все категории записок</h2>
            </div>
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="{{ route('admin.category-notes.create') }}">Создать новую категорию</a>
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
            <th>Название</th>
            <th>Цвет</th>
            <th>Значок</th>
            <th>Действия</th>
        </tr>
        @foreach ($categoriesOfNotes as $categoryNotes)
        <tr>
            <td>{{ $categoryNotes->name }}</td>
            <td>
                @if($categoryNotes->color)
                    {{ $categoryNotes->color->name }}
                @endif                
            </td>
            <td>                        
                @if (isset($categoryNotes->img))
                    <img src="{{asset('/storage/' . $categoryNotes->img)}}" class="rounded float-start" alt="avatar" width="24" height="24">  
                @endif 
            </td>
            <td>
            <form action="{{ route('admin.category-notes.destroy',
                    $categoryNotes->id ) }}" method="POST">
   
                @csrf
                @method('DELETE')
                <div class="btn-group-vertical">
                    <a class="btn btn-outline-primary" href="{{ route('admin.category-notes.show', $categoryNotes->id) }}">Посмотреть</a>
                    <a class="btn btn-outline-primary" href="{{ route('admin.category-notes.edit', $categoryNotes->id) }}">Изменить</a>  
                    <button type="submit" class="btn btn-outline-danger">Удалить</button>
                </div>   
            </form>              


            </td>
        </tr>
        @endforeach
    </table>
</div>

@endsection