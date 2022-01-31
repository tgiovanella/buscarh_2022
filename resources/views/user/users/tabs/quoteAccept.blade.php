@if(count($user->quotes) > 0)
    
    <table class="table table-striped table-hover table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Solicitante</th>
                <th>Título da Cotação</th>
                <th>Categoria</th>
                <th>Detalhes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($accepts as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->user_id}}</td>
                    <td>{{$item->comment}}</td>
                    <td>xxxxxxxx</td>
                    <td>xxxxxxxx</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif