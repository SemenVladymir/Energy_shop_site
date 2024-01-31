@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                @unless(!$role)
                    <div class="col-sm-2">
                        <a href="/edit?id={{$data->id}}" class="btn btn-primary">Редагувати товар</a>
                    </div>
                    <div class="col-sm-2 ml-n5">
                        <form action="/delete" method="post">
                            @csrf
                            @method('delete')
                            <input type="text" name="id" value="{{$data->id}}" hidden>
                            <button type="submit" class="btn btn-danger">Видалити товар</button>
                        </form>
                    {{--                    <a href="/delete?id={{$data->id}}" class="btn btn-danger">Видалити товар</a>--}}
                    </div>
                @endunless
                <div class="col-sm-8">
                    <h1 class="m-0 text-justify text-primary">{{$data->name}}</h1>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item border-bottom-0">
                        <img src="{{$data->imagesPath}}" width="400" height="400" style="margin-left: 400px;" class="img-fluid rounded-start" alt="Furniture"></li>
                    <li class="list-group-item border-bottom-0">
                        <p>{{$data->description}}</p>
                    </li>
                </ul>
                <div class="card-footer" style="font-size: medium;">
                    Ціна: {{$data->price}} грн
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
