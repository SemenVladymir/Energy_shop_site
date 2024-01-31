@extends('layouts.main')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Корегування товару</h3>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('objectoftrade.update', $myobject->id)}}" method="post">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group">
                    <label for="id"></label>
                    <input type="text" class="form-control" name="id" id="id" value="{{$myobject->id}}" hidden>
                </div>
                <div class="form-group">
                    <label for="name">Назва товару</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$myobject->name}}">
                </div>
                <div class="form-group">
                    <label for="type">Тип товару</label>
                    <input type="text" class="form-control" name="type" id="type" value="{{$myobject->type}}">
                </div>
                <div class="form-group">
                    <label for="price">Ціна</label>
                    <input type="text" class="form-control" name="price" id="price" value="{{$myobject->price}}">
                </div>
                <div class="form-group">
                    <label for="imagesPath">URL-адреса фото товару</label>
                    <input type="text" class="form-control" name="imagesPath" id="imagesPath" value="{{$myobject->imagesPath}}">
                </div>
                <div class="form-group">
                    <label for="description">Опис товару</label>
                    <textarea class="form-control" rows="6" name="description" id="description">{{$myobject->description}}</textarea>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary" @if(!$role) disabled @endif>Змінити товар</button>
            </div>
        </form>
    </div>
@endsection
