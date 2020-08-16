@extends('template')

@section('content')

<div class="content-page">
    <div class="row">
        <div class="col-12">
            <h1>Listado de productos</h1>
            <h2>Tienda: {{$tienda->nombre}}</h2>
        </div>
        <div class="col-md-12">
            <a href="{{url('store')}}" title="Regresar">
                <i class="fa fa-reply"></i> Regresar a las tiendas
            </a>
        </div>
    </div>
    <hr>
    <div class="row">
        @if(Session::has('message'))
        <div class="col-12">
            <p class="alert alertmessage {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}
            </p>
        </div>
        @endif

        <div class="col-12 text-right">
            <a href="{{url('product/'.$tienda->id.'/create')}}" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                Crear producto
            </a>
        </div>
        <div class="col-12 mt-10 contentproduct">
            @if (count($productos) > 0)
            <table class="table table-striped table-hover table-bordered tableproducts">
                <thead>
                    <th>Id</th>
                    <th class="text-center">
                        <i class="far fa-image"></i>
                    </th>
                    <th>SKU</th>
                    <th>Nombre</th>
                    <th>Descripci&oacute;n</th>
                    <th>Valor</th>
                    <th class="text-center">
                        <i class="fa fa-edit"></i>
                    </th>
                    <th class="text-center">
                        <i class="fa fa-trash"></i>
                    </th>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                    <tr>
                        <td>{{$producto->id}}</td>
                        <td class="text-center">
                            @if (file_exists(public_path('storage/'.$producto->imagen)))
                                <img class="img-responsive" src="{{asset('storage/'.$producto->imagen)}}" alt="{{$producto->nombre}}" style="max-width: 50px;">
                            @else
                                ---
                            @endif
                        </td>
                        <td>{{$producto->sku}}</td>
                        <td>{{$producto->nombre}}</td>
                        <td>{{$producto->descripcion}}</td>
                        <td>${{number_format($producto->valor,2,",",".")}}</td>
                        <td class="text-center">
                            <a href="{{url('product/'.$producto->id.'/edit')}}" title="Editar producto">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{url('product/'.$producto->id)}}" class="deleteproduct"
                                title="Eliminar producto">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-info">
                No se encontraron productos creados para la tienda.
            </div>
            @endif
        </div>
    </div>
</div>
<script>
    setTimeout(() => {
        $('.alertmessage').fadeOut("slow");
    }, 4000);
   
    $(document).ready(function () {
        $('.deleteproduct').click(function (e) { 
            e.preventDefault();
            var url = $(this).attr("href");
            var tr = $(this).closest("tr");

            Swal.fire({
                title: '¿Est&aacute;s seguro de eliminar el producto?',
                text: "Esta acci\u00F3n no se puede revertir.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar',
                cancelButtonText: 'No, cancelar',
            }).then((result) => {
                if (result.value) {

                    $.ajax({
                        type: "DELETE",
                        url,
                        beforeSend:function(){
                            $('.content-page').addClass("loading")
                        },
                        success: function (response) {
                            $('.content-page').removeClass("loading")
                            if (response.success) {     
                                Swal.fire(
                                    'Eliminado!',
                                    'El producto ha sido eliminado.',
                                    'success'
                                )
                                tr.remove();
                                if ($('.tableproducts tbody tr').length == 0) {
                                    $('.contentproduct').html(`
                                        <div class="alert alert-info">
                                            No se encontraron productos creados para la tienda.
                                        </div>
                                    `);
                                }
                            }else{
                                Swal.fire(
                                    'Error!',
                                    'No se pudo eliminar el producto.',
                                    'error'
                                )
                            }
                        }
                    });

                }
            })
        });
    });
</script>
@endsection