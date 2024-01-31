@extends('layouts.main')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-1">
                    <h1 class="m-0">Закази</h1>
                </div>
                <div class="col-sm-11">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/index">Головна</a></li>
                        <li class="breadcrumb-item active">Закази</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!--Table of orders -->
    <section class="content">
        <div class="row ml-2 mr-2">
            <div class="col-sm-12">
                <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                    <thead>
                        <tr>
                            <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="#">Товар</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="#">Дата заказу</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="#">Статус заказу</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="#">Ціна, грн</th>
                            <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="#">           </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($myobjects as $key => $order)
                            <tr class="{{($key+1)/2==0?"even":"odd"}} bg-secondarys">
                                <td class="dtr-control sorting_1" tabindex="0">{{\App\Models\objectoftrade::all()->where('id',$order->objectid)->first()->name}}</td>
                                <td>{{$order->date}}</td>
                                <td>{{$order->status==0?"Зарезервовано":"Виконано"}}</td>
                                <td>{{number_format(\App\Models\objectoftrade::all()->where('id',$order->objectid)->first()->price, 2, '.', ' ')}}</td>
                                <td>
                                    <form action="{{route('order.delete')}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <input type="text" name="id" value="{{$order->id}}" hidden>
                                        <button type="submit" class="btn {{$order->status==1?"btn-secondary":"btn-danger"}}" {{$order->status==1?"disabled":""}}>Видалити</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                    <tr>
                        <th rowspan="1" colspan="1">Усього до сплати:</th>
                        <th rowspan="1" colspan="1"></th>
                        <th rowspan="1" colspan="1"></th>
                        <th rowspan="1" colspan="1">{{number_format($summa, 2, '.', ' ')}}</th>
                        <th rowspan="1" colspan="1"></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
    <!--Table of orders -->

    <!--Pagination table of orders -->
    <!--
    <div class="row">
        <div class="col-sm-12 col-md-5">
            <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries
            </div>
        </div>
        <div class="col-sm-12 col-md-7">
            <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                <ul class="pagination">
                    <li class="paginate_button page-item previous disabled" id="example2_previous">
                        <a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                    </li>
                    <li class="paginate_button page-item active">
                        <a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                    </li>
                    <li class="paginate_button page-item ">
                        <a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a>
                    </li>
                    <li class="paginate_button page-item ">
                        <a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">3</a>
                    </li>
                    <li class="paginate_button page-item ">
                        <a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0" class="page-link">4</a>
                    </li>
                    <li class="paginate_button page-item ">
                        <a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0" class="page-link">5</a>
                    </li>
                    <li class="paginate_button page-item ">
                        <a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0" class="page-link">6</a>
                    </li>
                    <li class="paginate_button page-item next" id="example2_next">
                        <a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    -->
    <!--Pagination table of orders -->

{{--    @if($myorders)--}}
        <div class="d-inline-flex gap-2 mb-5">
            <a class="btn btn-outline-primary btn-lg px-4 rounded-pill" href="/order/buying">Оформити покупку</a>
        </div>
{{--    @endif--}}


    {{--    {{ $myobjects->links() }}--}}
@endsection
