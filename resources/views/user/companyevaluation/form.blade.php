<form action="{{ route('user.companyevaluation.store') }}" method="post">


    @csrf
    <div class="form-group  @if($errors->has('company_id')) has-error @endif">
        <input type="hidden" class="form-control" id="company_id" name="company_id" value="{{$id}}">
    </div>

    <div class="form-group  @if($errors->has('user_id')) has-error @endif">
        <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{ $user_id }}">
    </div>


    <div class="form-group  @if($errors->has('note')) has-error @endif">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="note" required id="inlineRadio1" value="1">
            <label class="form-check-label" for="inlineRadio1">1</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="note" required id="inlineRadio2" value="2">
            <label class="form-check-label" for="inlineRadio2">2</label>
        </div>
    
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="note" required id="inlineRadio3" value="3">
            <label class="form-check-label" for="inlineRadio3">3</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="note" required id="inlineRadio4" value="4">
            <label class="form-check-label" for="inlineRadio4">4</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="note" required id="inlineRadio5" value="5">
            <label class="form-check-label" for="inlineRadio5">5</label>
        </div>
        
       
    </div>

    <div class="form-group  @if($errors->has('message')) has-error @endif">
        <label for="message">Mensagem</label>
        <textarea class="form-control" name="message" id="message" ows="3" placeholder="Escreva a sua mensagem"
            required></textarea>
        <div class="help-block with-errors">{{ $errors->first('message') }}</div>

    </div>

    <div class="text-right">
        <button type="submit" class="btn btn-primary">Avaliar</button>
    </div>
</form>
