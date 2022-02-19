@extends('admin.layouts.app')

@section('title','Configuração das WebMoedas')

@section('content')
<!-- Cards com os totais -->
<div class="row">
    <!-- Card com os totais -->
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>500</h3>
                <p>Pacote de WebMoedas</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <span class="small-box-footer"> Valor do Pacote: <strong>R$ 59,90</strong></span>
        </div>
    </div>    
</div>
<hr>
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Alterações do Pacote</h3>
    </div>
    <div class="box-body">
        <!-- Recarga de moedas -->
        <div class="row">
            <div class="form-group col-md-4">
                <label for="coins">Valor do Pacote</label>
                <input type="number" name="" id="" class="form-control" value="">
            </div>
            <div class="form-group col-md-4">
                <label for="coins">Moedas por Pacote</label>
                <input type="number" name="" id="" class="form-control" value="">
            </div>
            <div class="form-group col-md-4">
                <label for="coins">Moedar por Cotação</label>
                <input type="number" name="" id="" class="form-control" value="">
            </div>
        </div>
        <div class="row float-left">
            <div class="col-md-10"></div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>
            </div>
        </div>
    </div>
</div>

@endsection
