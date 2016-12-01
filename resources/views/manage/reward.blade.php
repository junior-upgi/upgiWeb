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
                            <td>2016年度獎懲名單</td>
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