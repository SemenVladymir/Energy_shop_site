@extends('layouts.main')

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Додавання товару</h3>
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

        <form action="{{route('objectoftrade.store')}}" method="post">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="name">Назва товару</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Введіть назву товару">
                </div>
                <div class="form-group">
                    <label for="type">Тип товару</label>
                    <input type="text" class="form-control" name="type" id="type" placeholder="Введіть тип товару">
                </div>
                <div class="form-group">
                    <label for="price">Ціна</label>
                    <input type="text" class="form-control" name="price" id="price" placeholder="Введіть ціну товару">
                </div>
                <div class="form-group">
                    <label for="imagesPath">URL-адреса фото товару</label>
                    <input type="text" class="form-control" name="imagesPath" id="imagesPath" placeholder="Вставте URL-адресу фотографії товару">
                </div>
                <div class="form-group">
                    <label for="description">Опис товару</label>
                    <textarea class="form-control" rows="6" name="description" id="description" placeholder="Введіть опис товару"></textarea>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Додати товар</button>
            </div>
        </form>
    </div>
@endsection
