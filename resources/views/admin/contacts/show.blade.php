@extends('admin.layouts.app')

@section('title',__('Contatos'))



@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Contato</h3>

              <div class="box-tools pull-right small">

                  @if($contact->status == App\Contact::STATUS_READ)
                  <strong>Lido por</strong> {{ $contact->admin->name }}
                  <strong>em</strong> {{ convertDateTimeUS2BR($contact->read_at) }}
                  @endif
              </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-user margin-r-5"></i> Nome</strong>

              <p class="text-muted">
                {{ $contact->name }}
              </p>

              <hr>

              <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>

              <p class="text-muted">{{ $contact->email }}</p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Mensagem</strong>
              <p>{!! $contact->message !!}</p>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
    <!-- /.col -->
</div>


@endsection
