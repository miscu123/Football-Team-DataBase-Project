<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atacanti</title>
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
        <h1>Editare atacanti</h1>

        <?php
        $conn = mysqli_connect("localhost", "root", "", "echipa de fotbal");

        if (!$conn) {
            die("Conexiunea a esuat: " . mysqli_connect_error());
        }

        if (isset($_POST['delete_id'])) {
            $delete_nume = $_POST['delete_id'];
            $delete_query = "DELETE FROM atacanti WHERE Nume = '$delete_nume'";
            if (mysqli_query($conn, $delete_query)) {
                echo "<p>Jucatorul a fost sters cu succes.</p>";
            } else {
                echo "<p>Eroare la stergerea jucatorului: " . mysqli_error($conn) . "</p>";
            }
        }

        if (isset($_POST['update_nume']) && isset($_POST['update_prenume'])) {
            $update_nume = $_POST['update_nume'];
            $update_prenume = $_POST['update_prenume'];
            $nume = $_POST['nume'];
            $prenume = $_POST['prenume'];
            $varsta = $_POST['varsta'];
            $inaltime = $_POST['inaltime'];
            $goluri = $_POST['goluri'];
            
            $update_query = "UPDATE atacanti SET nume = '$nume', prenume = '$prenume', varsta = $varsta, inaltime = $inaltime, goluri = $goluri 
                             WHERE Nume = '$update_nume' AND Prenume = '$update_prenume'";

            if (mysqli_query($conn, $update_query)) {
                echo "<p>Jucatorul a fost actualizat cu succes.</p>";
            } else {
                echo "<p>Eroare la actualizarea jucatorului: " . mysqli_error($conn) . "</p>";
            }
        }

        $query = "SELECT * FROM atacanti";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo '<table>
                    <tr>
                        <th>Nume</th>
                        <th>Prenume</th>
                        <th>Varsta</th>
                        <th>Inaltime</th>
                        <th>Goluri</th>
                        <th>Actiuni</th>
                    </tr>';
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                        <td>' . $row['Nume'] . '</td>
                        <td>' . $row['Prenume'] . '</td>
                        <td>' . $row['Varsta'] . '</td>
                        <td>' . $row['Inaltime'] . ' cm</td>
                        <td>' . $row['Goluri'] . '</td>
                        <td>
                            <form style="display:inline;" method="POST" action="editare_atacanti.php">
                                <input type="hidden" name="update_nume" value="' . $row['Nume'] . '">
                                <input type="hidden" name="update_prenume" value="' . $row['Prenume'] . '">
                                <input type="text" name="nume" value="' . $row['Nume'] . '" required>
                                <input type="text" name="prenume" value="' . $row['Prenume'] . '" required>
                                <input type="number" name="varsta" value="' . $row['Varsta'] . '" required>
                                <input type="number" name="inaltime" value="' . $row['Inaltime'] . '" required>
                                <input type="number" name="goluri" value="' . $row['Goluri'] . '" required>
                                <button type="submit">Actualizeaza</button>
                            </form>
                            <form style="display:inline;" method="POST" action="editare_atacanti.php">
                                <input type="hidden" name="delete_id" value="' . $row['Nume'] . '">
                                <button type="submit" style="background-color: red; color: white;">Sterge</button>
                            </form>
                        </td>
                    </tr>';
            }

            echo '</table>';
        } else {
            echo "<p>Nu exista atacanti in baza de date.</p>";
        }

        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
