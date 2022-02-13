<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Titulo da Cotação</th>
            <th>Empresa Tomadora</th>
            <th>Data</th>
            <th>Categorias</th>
            <th>Cidades</th>
            <th>Total Prestadores</th>
            <th>Total Propostas</th>
            <th>Descrição Cotação</th>
        </tr>
    </thead>
    <tbody>

        @foreach($quotes as $q)
        <tr>
            <td>{{$q->id}}</td>
            <td>{{$q->title}}</td>
            <td>{{$q->company->name}}</td>
            <td>{{date('Y-m-d H:i:s', strtotime($q->created_at))}}</td>
            <td>{{implode(', ',$q->subcategories->pluck('name')->toArray())}}</td>
            <td>{{implode(', ',$q->cities->pluck('title')->toArray())}}</td>
            <td>{{$q->candidates->count()}}</td>
            <td>{{$q->candidates->sum('price')}}</td>
            <td>{{$q->description}}</td>
        </tr>
        @endforeach
    </tbody>
</table>