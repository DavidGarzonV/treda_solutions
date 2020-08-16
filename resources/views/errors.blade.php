@extends('template')

@section('content')

<div class="content-page">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger">
                {{$msg}}
            </div>
        </div>
    </div>
</div>

@endsection