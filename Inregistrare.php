<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inregistrare</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        label {
            display: block;
            text-align: left;
            margin: 8px 0 5px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Inregistrare utilizator</h1>
    <?php if (isset($mesaj)) echo "<p class='message'>$mesaj</p>"; ?>
    <form method="post" action="">
        <label for="nume">Nume:</label>
        <input type="text" name="nume" id="nume" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="parola">Parolă:</label>
        <input type="password" name="parola" id="parola" required><br>

        <button type="submit" name="inregistrare">Inregistrare</button>
    </form>

    <div class="message">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $conn = mysqli_connect("localhost", "root", "", "echipa de fotbal");

            if (!$conn) {
                die("Eroare la conectarea la baza de date: " . mysqli_connect_error());
            }

            $nume = mysqli_real_escape_string($conn, $_POST['nume']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $parola = mysqli_real_escape_string($conn, $_POST['parola']);

            $sql_verificare = "SELECT * FROM utilizatori WHERE email = '$email'";
            $result_verificare = mysqli_query($conn, $sql_verificare);

            if (mysqli_num_rows($result_verificare) > 0) {
                echo "Acest email este deja inregistrat. <a href='Autentificare.php'>Autentifica-te aici</a>";
            } else {
                $parola_hash = password_hash($parola, PASSWORD_BCRYPT);

                $sql_inserare = "INSERT INTO utilizatori (Nume, Email, Parola) 
                                 VALUES ('$nume', '$email', '$parola_hash')";

                if (mysqli_query($conn, $sql_inserare)) {
                    echo "Inregistrare reusita! <a href='Autentificare.php'>Autentifica-te aici</a>";
                } else {
                    echo "Eroare la inserarea in baza de date: " . mysqli_error($conn);
                }
            }
            mysqli_close($conn);
        }
        ?>
    </div>
</div>

</body>
</html>
