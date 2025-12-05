<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  @vite(['resources/css/app.css'])
</head>
<body>
  <div class="container">
     <form class="form" method="POST" action="/register">
        @csrf  {{-- Very important for Laravel forms --}}
        <h2>Register</h2>

        <input type="text" name="name" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>

        <p>Already have an account? <a href="/login">Login</a></p>
    </form>
</div>
</body>
</html>