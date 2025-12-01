<!DOCTYPE html>
<html>
<body>
    <h1>Eventos Disponíveis</h1>

    @if(session('success'))
        <div style="color: green; border: 1px solid green; padding: 10px;">
            {{ session('success') }}
        </div>
    @endif

    <p>
        Olá, {{ auth()->user()->nome }}! 
        @if(auth()->user()->perfil == 'organizador')
            | <a href="{{ route('eventos.create') }}">Criar Novo Evento</a>
        @endif
    </p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf <button type="submit">Sair</button>
    </form>
    <hr>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Título</th>
                <th>Data</th>
                <th>Local</th>
                <th>Vagas</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventos as $evento)
                <tr>
                    <td>{{ $evento->titulo }}</td>
                    <td>{{ date('d/m/Y', strtotime($evento->data)) }}</td>
                    <td>{{ $evento->local }}</td>
                    <td>{{ $evento->limite_vagas }}</td>
                    <td>
                        <form action="{{ route('eventos.inscrever', $evento->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit">Inscrever-se</button>
                        </form>

                        @if(auth()->user()->id == $evento->usuario_id)
                            <a href="{{ route('eventos.inscritos', $evento->id) }}" style="background-color: #e0f7fa; padding: 2px 5px; text-decoration: none;">👥 Ver Inscritos</a>

                            <a href="{{ route('eventos.edit', $evento->id) }}">Editar</a>
                                
                            <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Tem certeza?')">Excluir</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>