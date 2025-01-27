<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panoul Administratorului</title>
    <style>
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            text-align: center;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            padding: 5px 10px;
            margin: 2px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Panoul Administratorului</h1>
    
    <?php
    $conn = mysqli_connect("localhost", "root", "", "echipa de fotbal");

    if (!$conn) {
        die("Conexiunea a esuat: " . mysqli_connect_error());
    }

    $categories = [
        "atacanti" => "Atacanti",
        "antrenori" => "Antrenori",
        "palmares echipa" => "Palmares Echipa",
        "formatii" => "Formatii",
        "utilizatori" => "Utilizatori"
    ];

    echo '<table>
            <tr>
                <th>Categorie</th>
                <th>Actiuni</th>
            </tr>';

    foreach ($categories as $table => $label) {
        echo '<tr>
                <td>' . $label . '</td>
                <td>
                    <form style="display:inline;" method="POST" action="editare_' . $table . '.php">
                        <input type="hidden" name="categorie" value="' . $table . '">
                        <button type="submit">Editare</button>
                    </form>
                </td>
            </tr>';
    }

    echo '</table>';

    $sql_bilete = "SELECT SUM(numar_bilete_disponibile) AS bilete_disponibile, SUM(numar_bilete_rezervate) AS bilete_rezervate FROM bilete";
    $result_bilete = mysqli_query($conn, $sql_bilete);

    $bilete_disponibile = 0;
    $bilete_rezervate = 0;

    if ($result_bilete && mysqli_num_rows($result_bilete) > 0) {
        $row = mysqli_fetch_assoc($result_bilete);
        $bilete_disponibile = $row['bilete_disponibile'];
        $bilete_rezervate = $row['bilete_rezervate'];
    }

    echo '<div class="container">';
    echo '<h2>Raport Bilete</h2>';
    echo '<p><strong>Bilete disponibile:</strong> ' . $bilete_disponibile . '</p>';
    echo '<p><strong>Bilete rezervate:</strong> ' . $bilete_rezervate . '</p>';

    $sql_rezervari = "SELECT nume, data_rezervare, numar_bilete FROM rezervari";
    $result_rezervari = mysqli_query($conn, $sql_rezervari);

    if ($result_rezervari && mysqli_num_rows($result_rezervari) > 0) {
        echo '<table>
                <tr>
                    <th>Nume</th>
                    <th>Data Rezervarii</th>
                    <th>Numar Bilete</th>
                </tr>';
        while ($row = mysqli_fetch_assoc($result_rezervari)) {
            echo '<tr>
                    <td>' . htmlspecialchars($row['nume']) . '</td>
                    <td>' . htmlspecialchars($row['data_rezervare']) . '</td>
                    <td>' . htmlspecialchars($row['numar_bilete']) . '</td>
                </tr>';
        }
        echo '</table>';
    } else {
        echo '<p>Nu exista rezervari inregistrate.</p>';
    }

    echo '</div>';

    $conn->close();
    ?>
</body>
</html>