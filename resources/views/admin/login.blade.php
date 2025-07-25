<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="icon" href="{{ asset('asset/img/logo.png') }}" type="image/png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #0a0f57;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      flex-direction: column;
    }
    .login-container {
      background-color: white;
      border-radius: 20px;
      display: flex;
      flex-direction: row;
      overflow: hidden;
      width: 800px;
      max-width: 95%;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }
    .login-left {
      background-color: white;
      padding: 40px;
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
    }
    .login-left img {
      height: 100px;
      margin-bottom: 20px;
    }
    .login-left h2 {
      text-align: center;
      color: #666;
      font-weight: bold;
    }
    .login-right {
      background-color: #eee;
      flex: 1;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      border-radius: 0 20px 20px 0;
      box-shadow: inset 2px 2px 5px rgba(0, 0, 0, 0.1);
    }
    .login-right label {
      font-weight: 600;
      margin-bottom: 5px;
      color: #0a0f57;
    }
    .login-right input[type="text"],
    .login-right input[type="password"] {
      padding: 12px;
      margin-bottom: 20px;
      border: none;
      border-radius: 12px;
      width: 100%;
    }
    .login-right .forgot {
      font-size: 14px;
      margin-bottom: 20px;
      color: #0a0f57;
    }
    .login-right button {
      padding: 12px;
      background-color: #0a0f57;
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 18px;
      font-weight: bold;
      cursor: pointer;
    }
    .login-right button:hover{
        background-color: #1822a8;
        color: white;
    }
    .footer-text {
      margin-top: 20px;
      color: white;
      text-align: center;
      width: 100%;
      font-size: 14px;
      padding: 0 20px;
    }
    @media (max-width: 768px) {
      .login-container {
        width: 90%;
        padding: 0;
        margin: 10px 10px;
        flex-direction: column;
        border-radius: 10px;
      }
    .login-left img {
        height: 60px;
        margin-bottom: 20px;
    }
      .login-left,
      .login-right {
        border-radius: 0;
        padding: 10px 20px;
      }
      .login-right {
        border-radius: 0 0 10px 10px;
        box-shadow: none;
      }
      .login-left h2 {
        font-size: 15px;
      }
    .login-right label {
      font-weight: 500;
      margin-bottom: 5px;
      color: #0a0f57;
      font-size: 14px;
    }
    .login-right input[type="text"],
    .login-right input[type="password"] {
      padding: 6px;
      margin-bottom: 8px;
      border: none;
      border-radius: 10px;
      width: 100%;
    }
     .login-right button {
        padding: 6px;
        background-color: #0a0f57;
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
    }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-left">
      <img src="{{ asset('asset/img/logo-spbe.png') }}" alt="Logo SPBE" />
      <h2>Login to SPBE<br />Pemerintah Kota Bandar Lampung</h2>
    </div>
    <div class="login-right">
      <form method="POST" action="{{ url('/login') }}">
        @csrf
        @if ($errors->any())
        <div class="alert alert-danger p-2 mb-3">
          {{ $errors->first() }}
        </div>
        @endif

        <div class="mb-3">
          <label for="email">Username/Email</label>
          <input type="text" id="email" name="email" class="form-control" required autofocus />
        </div>

        <div class="mb-3">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control" required />
        </div>

        <div class="mb-3">
            <label for="captcha">Kode Captcha</label>
            <div class="d-flex mb-2 align-items-center">
                {!! captcha_img('flat') !!}
                <button type="button" class="btn btn-link ms-2" id="reload" style="color:white; background-color:#faac15;">&#x21bb;</button>
            </div>
            <input id="captcha" type="text" class="form-control" name="captcha" required placeholder="Masukkan captcha">
        </div>

        <button type="submit" class="btn w-100">Login</button>
      </form>
    </div>
  </div>

  <div class="footer-text">
    © 2025. TIM KP Unila Diskominfo Kota Bandar Lampung. All Rights Reserved
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('reload').addEventListener('click', function () {
        fetch('/reload-captcha')
            .then(res => res.json())
            .then(data => {
                document.querySelector('.mb-3 div').innerHTML = data.captcha + '<button type="button" class="btn btn-link ms-2" id="reload" style="color:white; background-color:#faac15;">&#x21bb;</button>';
            });
    });
  </script>


</body>
</html>
