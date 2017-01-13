@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-sm-4 col-md-2">
        @include('production.sidebar')
    </div>
    <div class="col-sm-8 col-md-10" id="importToday">
        <h3 style="margin: 0;">當日生產資料管理</h3><h6><small>您的IP為{{ request()->ip() }}</small></h6>
        @if (isset($auth))
            <div class="row">
                <div class="">
                    <form class="" id="up" @submit.prevent="submit">
                        <div class="form-group col-lg-5">
                            <input type="file" id="todayFile" name="todayFile" class="form-control" 
                                data-show-upload="false" data-show-preview="false" accept=".xls, .xlsx">
                        </div>
                        <div class="form-group">
                            <button id="BtnUpload" class="btn btn-default" type="submit"
                                data-loading-text="資料上傳中請梢候...">上傳</button>
                        </div>
                    <form>
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
            <p></p>
            <div v-if="glasses.length > 0">
                <h6>今日上傳之資料</h6>
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
            </div>
            <div v-else>
                <h6>今日尚未上傳資料</h6>
            </div>
        @else
            <h3>您現在不在公司範圍內，無法取得資訊!</h3>
        @endif
    </div>
</div>
<script src="{{ url('js/production/importToday.js?v=4') }}"></script>
@endsection