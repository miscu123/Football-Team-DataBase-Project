<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editare Palmares</title>
    <style>
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            text-align: center;
            margin: 0 auto; 
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto; 
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center; 
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
    <div class="container">
        <h1>Editare Palmares</h1>

        <?php
        $conn = mysqli_connect("localhost", "root", "", "echipa de fotbal");

        if (!$conn) {
            die("Conexiunea a esuat: " . mysqli_connect_error());
        }

        // Stergerea unui trofeu
        if (isset($_POST['delete_id'])) {
            $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
            $delete_query = "DELETE FROM `palmares echipa` WHERE `ID` = '$delete_id'";
            if (mysqli_query($conn, $delete_query)) {
                echo "<p>Trofeul a fost sters cu succes.</p>";
            } else {
                echo "<p>Eroare la stergerea trofeului: " . mysqli_error($conn) . "</p>";
            }
        }

        // Actualizarea unui trofeu
        if (isset($_POST['update_id'])) {
            $update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
            $tipul_trofeului = mysqli_real_escape_string($conn, $_POST['tipul_trofeului']);
            $anul_castigator = mysqli_real_escape_string($conn, $_POST['anul_castigator']);

            // Interogarea pentru actualizare
            $update_query = "UPDATE `palmares echipa` SET `Tipul trofeului` = '$tipul_trofeului', `Anul castigator` = '$anul_castigator' WHERE `ID` = '$update_id'";

            if (mysqli_query($conn, $update_query)) {
                echo "<p>Trofeul a fost actualizat cu succes.</p>";
            } else {
                echo "<p>Eroare la actualizarea trofeului: " . mysqli_error($conn) . "</p>";
            }
        }

        // Selectarea datelor din tabelul palmares echipa
        $query = "SELECT * FROM `palmares echipa`";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo '<table>
                    <tr>
                        <th>Tipul trofeului</th>
                        <th>Anul castigator</th>
                        <th>Actiuni</th>
                    </tr>';
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                        <td>' . $row['Tipul trofeului'] . '</td>
                        <td>' . $row['Anul castigator'] . '</td>
                        <td>
                            <form style="display:inline;" method="POST" action="editare_palmares echipa.php">
                                <input type="hidden" name="update_id" value="' . $row['ID'] . '">
                                <input type="text" name="tipul_trofeului" value="' . $row['Tipul trofeului'] . '" required>
                                <input type="number" name="anul_castigator" value="' . $row['Anul castigator'] . '" required>
                                <button type="submit">Actualizeaza</button>
                            </form>
                            <form style="display:inline;" method="POST" action="editare_palmares echipa.php">
                                <input type="hidden" name="delete_id" value="' . $row['ID'] . '">
                                <button type="submit" style="background-color: red; color: white;">Sterge</button>
                            </form>
                        </td>
                    </tr>';
            }

            echo '</table>';
        } else {
            echo "<p>Nu exista trofee in palmares.</p>";
        }

        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
