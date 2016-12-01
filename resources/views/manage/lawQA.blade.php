@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-sm-4 col-md-2">
        @include('manage.sidebar')
    </div>
    <div class="col-sm-8 col-md-10">
        <div class="row">
            <div class="col-md-10">
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td>員工下班後順道之行為所生交通意外是否為勞保職業傷害</td>
                            <td class="col-xs-2 col-md-1">
                                <a href=""><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
                            </td>
                        </tr>
                        <tr>
                            <td>若員工被其他共同工作之員工性騷擾，雇主有無法律責任</td>
                            <td class="col-xs-2 col-md-1">
                                <a href=""><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
                            </td>
                        </tr>
                        <tr>
                            <td>關於員工拒絕接受調動可否免職之疑義</td>
                            <td class="col-xs-2 col-md-1">
                                <a href=""><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
                            </td>
                        </tr>
                        <tr>
                            <td>員工在工作場所互歐公司是否可以將互區雙方開除</td>
                            <td class="col-xs-2 col-md-1">
                                <a href=""><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
                            </td>
                        </tr>
                        <tr>
                            <td>員工代刷卡是情節動大之免職事由嗎？</td>
                            <td class="col-xs-2 col-md-1">
                                <a href=""><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
                            </td>
                        </tr>
                        <tr>
                            <td>員工洩露個資時之相關法律責任</td>
                            <td class="col-xs-2 col-md-1">
                                <a href=""><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
                            </td>
                        </tr>
                        <tr>
                            <td>就業服務法新規定雇主不得要求求職人或員工提供隱私資料</td>
                            <td class="col-xs-2 col-md-1">
                                <a href=""><span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection