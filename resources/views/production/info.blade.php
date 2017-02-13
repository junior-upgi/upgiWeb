@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-sm-4 col-md-2">
        @include('production.sidebar')
    </div>
    <div class="col-sm-8 col-md-10" id="glass">
        <h3 style="margin: 0;">瓶號生產資料庫</h3>
        <h6><small>您的IP為{{ request()->ip() }}</small></h6>
        @php
            $date = \Carbon\Carbon::today()->modify('-1 months');
            $year = $date->format('Y');
            $months = $date->format('m');
        @endphp
        <h4>資料庫搜尋範圍：2001年-{{ $year }}年{{ $months }}月</h4>
        @if (isset($auth))
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                    <input type="text" v-model="search" id="search" @keyup.enter="searchGlassInfo()" class="form-control" placeholder="請輸入瓶號">
                    <span class="input-group-btn">
                        <button @click="searchGlassInfo()" class="btn btn-default" type="button">搜尋</button>
                    </span>
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
            <p></p>
            <table v-if="glasses.length > 0" class="table table-bordered .table-condensed">
                <thead>
                    <tr>
                        <td>線別</td>
                        <td>瓶號</td>
                        <td>重量</td>
                        <td>機速</td>
                        <td>生產數量(萬)</td>
                        <td>生產良率(%)</td>
                        <td>下線日期</td>
                        <td>備註</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="glass in glasses">
                        <td>@{{ glass.line }}</td>
                        <td>@{{ glass.glassNumber }}</td>
                        <td>@{{ glass.weight }}</td>
                        <td>@{{ glass.speed }}</td>
                        <td>@{{ glass.quantity }}</td>
                        <td>@{{ glass.yield }}</td>
                        <td>@{{ glass.offline }}</td>
                        <td>@{{ glass.remark }}</td>
                    </tr>
                </tbody>
            </table>
            @{{ searching }}
            <div v-if="search && glasses.length == 0 && searching == ''">目前沒有此瓶號的生產資訊!</div>
        @else
            <h3>您現在不在公司範圍內，無法取得資訊!</h3>
        @endif
    </div>
</div>
<script src="{{ url('js/production/info.js?v=4') }}"></script>
@endsection