@extends('layouts.master')
@section('content')
@php
    $ip = request()->ip();
@endphp

<div class="row">
    <div class="col-sm-4 col-md-2">
        @include('production.sidebar')
    </div>
    <div class="col-sm-8 col-md-10">
        <h3 style="margin: 0;">瓶號生產資料庫</h3><h6><small>您的IP為{{ $ip }}</small></h6>
        
        @if (substr(request()->ip(), 0, '7') == '192.168')
        
            <form action="{{ url('production/glassInfo') }}">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="請輸入瓶號">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">搜尋</button>
                        </span>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
            </form>
            <p></p>
            @if(count($list) > 0)
                <table class="table table-bordered .table-condensed">
                    <thead>
                        <tr>
                            <td>線別</td>
                            <td>瓶號</td>
                            <td>重量</td>
                            <td>機速</td>
                            <td>引出量</td>
                            <td>下支瓶號</td>
                            <td>預計換模時間</td>
                            <td>試模瓶號</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list as $item)
                            <tr>
                                <td>{{ $item->line }}</td>
                                <td>{{ $item->glassNumber }}</td>
                                <td>{{ $item->weight }}</td>
                                <td>{{ $item->speed }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->yield }}</td>
                                <td>{{ $item->offline }}</td>
                                <td>{{ $item->remark }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        @else
            <h3>您現在不在公司範圍內，無法取得資訊!</h3>
        @endif
    </div>
</div>

@endsection