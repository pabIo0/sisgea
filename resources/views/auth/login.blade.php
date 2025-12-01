<!DOCTYPE html>
<html>
<body>
    <h2>Login - SISGEA</h2>

    @if ($errors->any())
        <div style="color:red">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('login.post') }}" method="POST">
        @csrf
        <label>Email:</label> <input type="email" name="email"><br><br>
        <label>Senha:</label> <input type="password" name="password"><br><br>
        <button type="submit">Entrar</button>
    </form>
    <a href="{{ route('register') }}">Criar conta</a>
</body>
</html>