@extends('template')

@section('content')

<div class="content-page">
    <div class="row">
        <div class="col-12">
            <h1>Listado de tiendas</h1>
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
            <a href="{{url('store/create')}}" class="btn btn-primary">
                <i class="fa fa-plus"></i>
                Crear tienda
            </a>
        </div>
        <div class="col-12 mt-10 contentstore">
            @if (count($tiendas) > 0)
            <table class="table table-striped table-hover table-bordered tablestores">
                <thead>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Fecha de apertura</th>
                    <th class="text-center">Productos</th>
                    <th class="text-center">
                        <i class="fa fa-edit"></i>
                    </th>
                    <th class="text-center">
                        <i class="fa fa-trash"></i>
                    </th>
                </thead>
                <tbody>
                    @foreach ($tiendas as $tienda)
                    <tr>
                        <td>{{$tienda->id}}</td>
                        <td>{{$tienda->nombre}}</td>
                        <td>{{$tienda->fecha_apertura}}</td>
                        <td class="text-center">
                            <span class="badge badge-secondary">{{count($tienda->productos)}}</span>
                            <a href="{{url('product/'.$tienda->id)}}" title="Productos de la tienda" class="vam">
                                <i class="fa fa-list"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{url('store/'.$tienda->id.'/edit')}}" title="Editar tienda">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="{{url('store/'.$tienda->id)}}" class="deletestore" title="Eliminar tienda">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-info">
                No se encontraron tiendas creadas.
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
        $('.deletestore').click(function (e) { 
            e.preventDefault();
            var url = $(this).attr("href");
            var tr = $(this).closest("tr");

            Swal.fire({
                title: '¿Est&aacute;s seguro de eliminar la tienda?',
                text: "Los productos de la tienda tambi\u00E9n ser\u00E1n eliminados. Esta acci\u00F3n no se puede revertir.",
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
                                    'La tienda ha sido eliminada.',
                                    'success'
                                )
                                tr.remove();
                                if ($('.tablestores tbody tr').length == 0) {
                                    $('.contentstore').html(`
                                        <div class="alert alert-info">
                                            No se encontraron tiendas creadas.
                                        </div>
                                    `);
                                }
                            }else{
                                Swal.fire(
                                    'Error!',
                                    'No se pudo eliminar la tienda.',
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