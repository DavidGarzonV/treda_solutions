@extends('template')

@section('content')

<div class="content-page">
    <div class="row">
        <div class="col-12">
            <h1>Crear tienda</h1>
        </div>
        <div class="col-md-12">
            <a href="{{url('store')}}" title="Regresar">
                <i class="fa fa-reply"></i> Regresar
            </a>
        </div>
    </div>
    <hr>

    @if ($errors->any())
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{!! $error !!}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <hr>
    @endif

    @if (isset($tienda) && $tienda != NULL)
    {!! Form::open(["url" => 'store/'.$tienda->id.'/', "method" => "PUT"]) !!}
    @else
    {!! Form::open(["url" => 'store']) !!}
    @endif

    <div class="row">
        <div class="col">
            <label for="nombre">Nombre de la tienda</label>
            {!! Form::text("nombre", isset($tienda) && $tienda ? $tienda->nombre : null, ["class" =>
            "form-control","aria-describedby" =>
            "helpnombre","required","maxlength" =>255]) !!}
            <small id="helpnombre" class="form-text text-muted">Ingresa el nombre de la tienda.</small>
        </div>

        <div class="col">
            <label for="fecha_apertura">Fecha de apertura</label>
            {!! Form::text("fecha_apertura", isset($tienda) && $tienda ? $tienda->fecha_apertura : null, ["class" =>
            "form-control","aria-describedby" => "helpfecha_apertura","required","maxlength" =>255]) !!}
            <small id="helpfecha_apertura" class="form-text text-muted">Ingresa la fecha de apertura de la tienda en el
                formato (dd-mm-YYYY)</small>
        </div>
        <div class="col-12 mt-10">
            @if (isset($tienda) && $tienda)
            {!! Form::hidden("id", $tienda->id) !!}
            @endif
            {!! Form::submit("Guardar", ["class" => "btn btn-success"]) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection