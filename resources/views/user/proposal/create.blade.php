<div class="row mt-3">
    <div class="col-md-12">
        <h2>Propostas</h2>
        <hr>
        <div class="row">
            <div class="col-md-12">
               
                    
                    <div class="row">
                        <!-- Comentários ou questionamentos -->
                        <div class="col-md-12">
                            <label for="message">Comentários</label>
                            <textarea class="form-control" name="comment" id="" rows="4" placeholder="Escreva a sua mensagem" required></textarea>
                        </div>
                        <!-- Campo para enexar uma apresentação -->
                        <div class="col-md-6">
                            <label for="">Arquivos</label>
                            <input type="text" class="form-control" id="" name="" placeholder="" >
                        </div>
                        <!-- Valor do serviço -->
                        <div class="col-md-6">
                                <label for="name">Valor</label>
                                <input type="number" class="form-control" id="" name="price" title="Valor da proposta" required>
                        </div>
                        <!-- Impostos -->
                        <div class="col-md-4">
                            <label for="name">Impostos inclusos ?</label>
                            <select class="form-control" name="taxes" id="" required>
                                <option value="" selected="" disabled="">Selecione</option>
                                <option value="1" >Sim</option>
                                <option value="0" >Não</option>
                            </select>
                        </div>
                        <!-- Despesas de viagem inclusas ou não -->
                        <div class="col-md-4">
                            <label for="name">Despesas inclusas ?</label>
                            <select class="form-control" name="expenditure" id="" >
                                <option value="" selected="" disabled="">Selecione</option>
                                <option value="1" >Sim</option>
                                <option value="0" >Não</option>
                            </select>
                        </div>
                        <!-- Prazo estimado para realizar o serviço -->
                        <div class="col-md-4">
                            <label for="">Prazo</label>
                            <input type="date" class="date-time-picker form-control s-12" id="" name="deadline" value="<?= date('Y-m-d') ?>">
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>