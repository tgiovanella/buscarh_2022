@extends('admin.layouts.app')

@section('title',__('messages.title_festivals'))

@push('scripts')
    <script>
        $(document).ready(function () {





            $('#btnDeleteFile').click(function () {


                var data = {
                    id : $('#id').val(),
                    banner_id : $('#imgBanner').data('id'),
                    _token : $('[name=_token]').val(),
                };

                console.log(data);

                $.ajax({
                    type: 'POST',
                    url: '/admin/festivals/remove-file',
                    data: data,
                    dataType: 'json'
                }).done(function (status) {
                    console.log(status);

                    if(!status.error) {
                        $('#rowImgBanner').hide();
                        $('#rowBanner').show();
                        $('#banner').prop('required',true);
                    }


                }).fail(function( jqXHR, textStatus ) {
                    alert( "Request failed: " + textStatus );
                });

            });
        })

    </script>
@endpush

@section('content')
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">@yield('title','Dashboard')</h3>

            <div class="box-tools pull-right">

            </div>
        </div>
        <div class="box-body">
            @includeIf('admin.festivals.form')
        </div>
        <!-- /.box-body -->
        <div class="box-footer">

        </div>
        <!-- /.box-footer-->
    </div>
    <!-- /.box -->
@endsection
