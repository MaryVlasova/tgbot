@extends('backend.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
           
                <div class="card-header">{{ __('Настройки бота') }}</div>  
                <div class="card-body">
                @foreach($settings as $botSettings)
                @if (isset($botSettings->img))
                <img src="{{asset('/storage/' . $botSettings->img)}}" class="rounded float-start mb-2 mt-2" alt="avatar">  
                @endif     
                    <ol class="list-group list-group-numbered mb-2">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                        <div class="text-uppercase">Название бота</div>
                        {{$botSettings->name}}
                        </div>                       
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                        <div class="text-uppercase">Описание бота</div>
                        {{$botSettings->description}}
                        </div>                        
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                        <div class="text-uppercase">Информация о боте</div>
                        {{$botSettings->info}}
                        </div>                        
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                        <div class="text-uppercase">Токен</div>
                        {{$botSettings->token}}
                        </div>                        
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                        <div class="text-uppercase">Ссылка</div>
                       {{$botSettings->link}}
                        </div>                        
                    </li>
                    </ol>    
                    <a href="{{route('admin.settings.edit', $botSettings->id)}}" class="btn btn-primary ">Редактировать</a>          
                    @endforeach

  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection