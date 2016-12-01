@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-sm-4 col-md-2">
        @include('production.sidebar')
    </div>
    <div class="col-sm-8 col-md-10">
        <div class="row">
            <form action="">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group">
                        <input type="text" class="form-control" placeholder="請輸入瓶號">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">搜尋</button>
                        </span>
                        </div><!-- /input-group -->
                    </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
            </form>
        </div>
    </div>
</div>
@endsection