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
        <div class="row">
            <div class="col-md-10">
                <h3>您的IP為{{ $ip }}</h3>
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
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection