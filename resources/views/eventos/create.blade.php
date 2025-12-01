<!DOCTYPE html>
<html>
<body>
    <h1>Criar Novo Evento (Teste Back-end)</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('eventos.store') }}" method="POST">
        @csrf <label>Título:</label><br>
        <input type="text" name="titulo"><br><br>

        <label>Descrição:</label><br>
        <textarea name="descricao"></textarea><br><br>

        <label>Data:</label><br>
        <input type="date" name="data"><br><br>
        
        <label>Hora:</label><br>
        <input type="time" name="hora"><br><br>

        <label>Local:</label><br>
        <input type="text" name="local"><br><br>

        <label>Vagas:</label><br>
        <input type="number" name="limite_vagas"><br><br>

        <button type="submit">Salvar Evento</button>
    </form>
</body>
</html>