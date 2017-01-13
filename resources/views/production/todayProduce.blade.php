@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-sm-4 col-md-2">
        @include('production.sidebar')
    </div>
    <div class="col-sm-8 col-md-10" id="todayGlass">
        <div class="row">
            <div class="col-md-10">
                <h3 style="margin: 0;">當日生產線一覽</h3>
                <div class="pull-left">
                    <h6><small>您的IP為{{ request()->ip() }} , {{ $ip }}</small></h6>
                </div>
                <div class="pull-right">
                    <h6 v-if="date != null">資料更新日期：@{{ date }}</h6>
                </div>
                @if (isset($auth))
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
                                <td>@{{ glass.nextNumber }}</td>
                                <td>@{{ glass.change }}</td>
                                <td>@{{ glass.testNumber }}</td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <h3>您現在不在公司範圍內，無法取得資訊!</h3>
                @endif
            </div>
        </div>
    </div>
</div>
<script src="{{ url('js/production/todayGlass.js?v=3') }}"></script>
@endsection