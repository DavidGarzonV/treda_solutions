@extends('template')

@section('content')

<div class="content-page">
    <div class="row">
        <div class="col-12">
            <h1>Crear producto</h1>
        </div>
        <div class="col-md-12">
            <a href="{{url('product/'.$idTienda)}}" title="Regresar">
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

    @if (isset($producto) && $producto != NULL)
    {!! Form::open(["url" => 'product/'.$producto->id.'/edit', "method" => "PUT", "files" =>true]) !!}
    @else
    {!! Form::open(["url" => 'product/create', "files" =>true]) !!}
    @endif

    <div class="row">
        <div class="col-6">
            <label for="nombre">Nombre del producto</label>
            {!! Form::text("nombre", isset($producto) && $producto ? $producto->nombre : null, ["class" =>
            "form-control","aria-describedby" =>
            "helpnombre","required","maxlength" =>255]) !!}
            <small id="helpnombre" class="form-text text-muted">Ingresa el nombre del producto.</small>
        </div>
        <div class="col-6">
            <label for="sku">SKU del producto</label>
            {!! Form::text("sku", isset($producto) && $producto ? $producto->sku : null, ["class" =>
            "form-control","aria-describedby" =>
            "helpsku","required","maxlength" =>255]) !!}
            <small id="helpsku" class="form-text text-muted">Ingresa el sku del producto.</small>
        </div>
        <div class="col-6">
            <label for="descripcion">Descripci&oacute;n del producto</label>
            {!! Form::text("descripcion", isset($producto) && $producto ? $producto->descripcion : null, ["class" =>
            "form-control","aria-describedby" =>
            "helpdescripcion","required","maxlength" =>255]) !!}
            <small id="helpdescripcion" class="form-text text-muted">Ingresa el descripci&oacute;n del producto.</small>
        </div>
        <div class="col-6">
            <label for="valor">Valor del producto</label>
            {!! Form::number("valor", isset($producto) && $producto ? $producto->valor : null, ["class" =>
            "form-control","aria-describedby" =>
            "helpvalor","required","min"=> 0]) !!}
            <small id="helpvalor" class="form-text text-muted">Ingresa el valor del producto.</small>
        </div>
        <div class="col-6">
            <label for="imagen">Imagen del producto</label>
            <br>
            <input type="file" name="imagen" class="inputimagen" accept="image/png, image/jpeg, image/jpg" aria-describedby="helpimagen"
            {{isset($producto) && $producto ? '': 'required'}}>
            <small id="helpimagen" class="form-text text-muted">Selecciona la imagen del producto, s&oacute;lo se
                permiten formatos (jpg,jpeg, png)</small>

            @if (isset($producto) && $producto && file_exists(public_path('storage/' . $producto->imagen)))
            <a href="#" class="text-danger eliminarimagen">
                <i class="fa fa-times"></i> Eliminar la imagen almacenada
            </a>
            @endif
        </div>

        <div class="col-12 mt-10 contsend">
            @if (isset($producto) && $producto)
            {!! Form::hidden("id", $producto->id) !!}
            @endif
            {!! Form::hidden("id_tienda", $idTienda) !!}
            {!! Form::submit("Guardar", ["class" => "btn btn-success"]) !!}
        </div>
    </div>
    {!! Form::close() !!}
</div>

<script>

    $('.inputimagen').change(function (e) { 
        e.preventDefault();
        var files = $(this).get(0).files;

        if (files.length > 0) {
            $(this).siblings(".eliminarimagen").remove();
            $('.contsend').append(`<input type="hidden" name="imagenCambiada" value="1">`);
            $(this).attr("required", true);
        }
    });

    $('.eliminarimagen').click(function (e) { 
        e.preventDefault();
        $('.contsend').append(`<input type="hidden" name="borrarImagen" value="1">`);
        $(this).siblings(".inputimagen").attr("required", true);
        $(this).remove();
    });

</script>
@endsection