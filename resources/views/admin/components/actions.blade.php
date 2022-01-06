{{--

    Para utilizar esse componente, é necessário passar os parametros

    1 - $item == o objeto de ORM do resultado
    2 - $route == rota padrão
    3 - $btns ==  array com os botões e.x ['show','edit','delete']
--}}

@php
$array_btns = explode('|',$btns);
if(isset($user) && $user)
$rbase = '';
else
$rbase = 'admin.';
@endphp



<div class="btn-group">
    @if(in_array('show',$array_btns))
    <a href="{{ route($rbase. $route .'.show',$item) }}" class="btn btn-xs btn-default bg-gray"><i
            class="fa fa-eye"></i></a>
    @endif

    @if(in_array('edit',$array_btns))
    <a href="{{ route($rbase. $route .'.edit',$item) }}" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i></a>
    @endif

    @if(in_array('delete',$array_btns))
    <a onclick="deleteRegister({{$item->id}})" href="{{ route($rbase. $route .'.destroy',$item) }}"
        class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
    @endif
</div>

@if(in_array('delete',$array_btns))
<form id="delete-form{{$item->id}}" action="{{ route($rbase. $route .'.destroy',$item) }}" method="POST"
    style="display: none;">
    @csrf
    {{ method_field('DELETE') }}
</form>
@endif

@push('scripts')
<script>
    function deleteRegister(id) {
            event.preventDefault();

            $.confirm({
                title: 'Excluir registro?',
                content: 'Tem certeza que deseja excluir definitivamente o registro #' + id + '?',
                type: 'red',
                icon: 'fa fa-trash',
                buttons: {
                    cancelar: {
                        text: 'Cancelar',
                        btnClass: 'btn-default',

                    },
                    confirmar: {
                        text: 'Excluir',
                        btnClass: 'btn-red',
                        action: function(){
                            document.getElementById('delete-form' + id).submit();//
                        }
                    }
                }
            });

        //
        }
</script>
@endpush
