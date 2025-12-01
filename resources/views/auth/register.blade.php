<!DOCTYPE html>
<html>
<body>
    <h2>Cadastro de Usuário - SISGEA</h2>
    
    @if ($errors->any())
        <div style="color:red">
            <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('register.post') }}" method="POST">
        @csrf
        <label>Nome:</label> <input type="text" name="nome"><br><br>
        <label>Email:</label> <input type="email" name="email"><br><br>
        <label>Senha:</label> <input type="password" name="senha"><br><br>
        <button type="submit">Cadastrar</button>
    </form>
    <a href="{{ route('login') }}">Já tenho conta</a>
</body>
</html>