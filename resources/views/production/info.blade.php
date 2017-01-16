@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-sm-4 col-md-2">
        @include('production.sidebar')
    </div>
    <div class="col-sm-8 col-md-10" id="glass">
        <h3 style="margin: 0;">瓶號生產資料庫</h3><h6><small>您的IP為{{ request()->ip() }}</small></h6>
        @if (isset($auth))
            <div class="row">
                <div class="col-lg-6">
                    <div class="input-group">
                    <input type="text" v-model="search" @keyup.enter="searchGlassInfo()" class="form-control" placeholder="請輸入瓶號">
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
                        <td>引出量</td>
                        <td>下支瓶號</td>
                        <td>預計換模時間</td>
                        <td>試模瓶號</td>
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
        @else
            <h3>您現在不在公司範圍內，無法取得資訊!</h3>
        @endif
    </div>
</div>
<script src="{{ url('js/production/info.js?v=2') }}"></script>
@endsection