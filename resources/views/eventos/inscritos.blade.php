<!DOCTYPE html>
<html>
<body>
    <h1>Inscritos em: {{ $evento->titulo }}</h1>
    <a href="{{ route('eventos.index') }}">Voltar para Lista de Eventos</a>
    <hr>

    <p><strong>Total de Inscritos:</strong> {{ count($inscritos) }} / {{ $evento->limite_vagas }} vagas</p>

    @if(count($inscritos) > 0)
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Nome do Participante</th>
                    <th>Email</th>
                    <th>Data da Inscrição</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inscritos as $inscrito)
                    <tr>
                        <td>{{ $inscrito->nome }}</td>
                        <td>{{ $inscrito->email }}</td>
                        <td>{{ date('d/m/Y H:i', strtotime($inscrito->data_inscricao)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Ainda não há ninguém inscrito neste evento.</p>
    @endif

</body>
</html>