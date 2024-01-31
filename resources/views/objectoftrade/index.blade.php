@extends('layouts.main', ['orders'=>$orders])

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-1">
                    <h1 class="m-0">Товари</h1>
                </div>

                    <div class="col-sm-4">
                        @if($role)
                        <a href="{{route('objectoftrade.create')}}" class="btn btn-primary">Додати товар</a>
                        @endif
                    </div>

                <div class="col-sm-7">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Головна</a></li>
                        <li class="breadcrumb-item active">Товари</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

            @foreach($myobjects as $myobject)
                <div class="container-fluid">
                    <div class="card mb-3 ml-1" style="max-width: 1300px; max-height: 150px;">
                        <div class="row g-1">
                            <div class="col-md-2">
                                <img src="{{$myobject->imagesPath}}" width="145" height="145"  class="img-fluid mt-2 ml-4 pl-2 rounded-start" alt="Furniture">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body" style="height: 200px">
                                    <h5 class="card-title"><a href="/show?id={{$myobject->id}}">{{$myobject->name}}</a></h5>
                                    <p class="card-text" ><small class="text-muted">
                                <span class="d-inline-block text-truncate  text-wrap" style="max-width: 100%; max-height: 100px; text-align: justify">
                                {{$myobject->description}}
                                </span></small></p>
                                </div>
                            </div>
                            <div class="col-md-2 mt-5 ml-5">
                                <h4>{{$myobject->price}}  грн</h4>
                            </div>
                            @unless($myorders)
                                <div class="col-md-1 mt-5 ml-5">
                                    <a href="/orders/create?id={{$myobject->id}}&order=true" class="btn rounded-circle btn-outline-success bg-info" aria-label="Добавить товар" data-first-add="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="35" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                                        </svg>
                                    </a>
                                </div>
                            @endunless
                        </div>
                    </div>
                </div>
            @endforeach
    <div class="pagination justify-content-center">
        {{$myobjects->links()}}
    </div>
            @if($myorders)
                <div class="d-inline-flex gap-2 mb-5">
                    <button class="btn btn-outline-primary btn-lg px-4 rounded-pill" type="button">
                        Оформити покупку
                    </button>
                </div>
            @endif


{{--    {{ $myobjects->links() }}--}}
@endsection
