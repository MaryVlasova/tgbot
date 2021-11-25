@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Изменение настроек бота') }}</div>

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
                <form enctype="multipart/form-data" id="control-form" action="{{ route('admin.settings.update',$botSettings->id)}}" method="POST">
                    @method('PUT')
                    <div class="form-group">            
                        <label for="bot-name">Название бота</label>
                        <input name="name" type="text" class="form-control" id="bot-name" aria-describedby="Bot name" value="{{$botSettings->name}}">
                        <small id="bot-name-help" class="form-text text-muted">You can change </small>
                    </div>
                    <div class="form-group">
                        <label for="bot-description">Описание бота</label>
                        <input name="description" type="text" class="form-control" id="bot-description" aria-describedby="Bot description" value="{{$botSettings->description}}">
                        <small id="bot-description-help" class="form-text text-muted">You can change </small>
                    </div>
                    <div class="form-group">
                        <label for="bot-info">Информация о боте</label>
                        <input name="info" type="text" class="form-control" id="bot-info" aria-describedby="Bot info" value="{{$botSettings->info}}">
                        <small id="bot-info-help" class="form-text text-muted">You can change </small>
                    </div>
                    <div class="form-group">
                        <label for="bot-token">Токен</label>
                        <input name="token" type="text" class="form-control" id="bot-token" aria-describedby="Bot token" value="{{$botSettings->token}}">
                        <small id="bot-token-help" class="form-text text-muted">You can change </small>
                    </div>
                    <div class="form-group">
                        <label for="bot-link">Ссылка</label>
                        <input name="link" type="text" class="form-control" id="bot-link" aria-describedby="Bot link" value="{{$botSettings->link}}">
                        <small id="bot-link-help" class="form-text text-muted">You can change </small>
                    </div>
                    <div class="form-group">
                        <label for="bot-link">Изображение</label>
                      
                        <input type="file" name="img" class="form-control">
                        @if (isset($botSettings->img))
                        <img src="{{asset('/storage/' . $botSettings->img)}}" class="rounded float-start mb-2 mt-2" alt="avatar">   
                        @endif                          
                        <small id="bot-link-help" class="form-text text-muted">You can change </small>
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