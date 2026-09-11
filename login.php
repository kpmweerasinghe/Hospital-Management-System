<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">
    <title>Viweka Hospital - Login</title>
</head>
<body>

<div class="login-shell">
    <div class="login-hero">
        <img src="images/login-hero.svg" alt="Viweka Hospital building illustration">
        <h1>Viweka Hospitals (Pvt) Ltd.</h1>
        <p>Veyangoda &mdash; Compassionate care, coordinated digitally.</p>
    </div>
    <div class="login-card">
        <img class="logo" src="images/logo.jpeg" alt="Viweka Hospital logo">
        <h2>Viweka Hospital</h2>
        <div class="subtitle">Management System</div>

        <form action="login_process.php" method="POST">

            <label>Username:</label><br>
            <input type="text" name="username" required><br><br>

            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>

            <button type="submit">Login</button>

        </form>
    </div>
</div>

</body>
</html>