@extends('layouts.master')
@section('content')
    <div id="test">
        @{{ message }}
    </div>
    <script src="{{ url('js/production/test.js') }}"></script>
@endsection