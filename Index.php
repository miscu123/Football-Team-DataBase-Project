<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Principala</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        .container {
            text-align: center;
        }
        .button {
            display: inline-block;
            padding: 15px 30px;
            margin: 20px;
            font-size: 18px;
            text-decoration: none;
            color: black;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Bun venit!</h1>
    <a href="Inregistrare.php" class="button">Inregistrare</a>
    <a href="Autentificare.php" class="button">Autentificare</a>
</div>

</body>
</html>