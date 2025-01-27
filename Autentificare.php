<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentificare</title>
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
    <h1>Autentificare utilizator</h1>
    <form method="post" action="">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="parola">Parola:</label>
        <input type="password" name="parola" id="parola" required><br>

        <button type="submit" name="autentificare">Autentificare</button>
    </form>

    <div class="message">
        <?php
        $conn = mysqli_connect("localhost", "root", "", "echipa de fotbal");

        if (!$conn) {
            die("Eroare la conectarea la baza de date: " . mysqli_connect_error());
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $parola = mysqli_real_escape_string($conn, $_POST['parola']);

            $sql = "SELECT * FROM utilizatori WHERE Email = '$email'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);

                if ($row['status'] === 'blocat') {
                    echo "Usor prietene ca ai contul blocat.";
                } else if (password_verify($parola, $row['Parola'])) {
                    session_start();
                    $_SESSION['user_id'] = $row['ID'];
                    $_SESSION['user_name'] = $row['Nume'];
                    $_SESSION['user_type'] = $row['tip-utilizator'];

                    if ($_SESSION['user_type'] === 'administrator') {
                        echo "Autentificare reusita! Bun venit, " . htmlspecialchars($row['Nume']) . "! <a href='admin_panel.php' class='button'>Panoul Administratorului</a>";
                    } else {
                        echo "Autentificare reusita! Bun venit, " . htmlspecialchars($row['Nume']) . "! <a href='Catalog.php' class='button'>Catalogul echipei</a>";
                    }
                } else {
                    echo "Parola incorecta.";
                }
            } else {
                echo "Utilizatorul nu exista.";
            }
        }

        mysqli_close($conn);
        ?>
    </div>
</div>

</body>
</html>