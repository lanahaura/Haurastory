<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Petugas</title>
  <style>
    * { box-sizing: border-box; }
    body{font-family:system-ui;margin:0;background:#FFF6B3;min-height:100vh;display:grid;place-items:center;padding: 20px;}
    .card{width:100%;max-width:420px;background:#fff;padding:36px;border-radius:24px;box-shadow: 0 10px 30px rgba(0,0,0,0.08);}
    input{width:100%;padding:12px 14px;border-radius:12px;border:1px solid #ddd;margin-top:6px;font-size:15px;transition: border-color 0.2s}
    input:focus{outline: none; border-color: #FFE07A; ring: 2px solid #FFE07A;}
    button{width:100%;padding:12px;border-radius:12px;border:0;background:#FFE07A;font-weight:700;margin-top:16px;font-size:15px;cursor:pointer;transition: 0.2s}
    button:hover{background:#FFD13B}
    .err{color:#b00020;font-size:13px;margin-top:6px}
    a{color:#333;text-decoration:none;font-weight: 500;}
    a:hover{text-decoration:underline;}
  </style>
</head>
<body>
  <form class="card" method="POST" action="{{ route('petugas.login.submit') }}">
    @csrf
    <h2>🔐 Login Petugas</h2>

    <label>Username</label>
    <input name="username" value="{{ old('username') }}" />
    @error('username') <div class="err">{{ $message }}</div> @enderror

    <label style="display:block;margin-top:10px;">Password</label>
    <input type="password" name="password" />
    @error('password') <div class="err">{{ $message }}</div> @enderror

    <button type="submit">Masuk</button>

  </form>
</body>
</html>
