<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrenori</title>
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
        <h1>Editare antrenori</h1>

        <?php
        $conn = mysqli_connect("localhost", "root", "", "echipa de fotbal");

        if (!$conn) {
            die("Conexiunea a esuat: " . mysqli_connect_error());
        }

        if (isset($_POST['delete_id'])) {
            $delete_nume = $_POST['delete_id'];
            $delete_query = "DELETE FROM antrenori WHERE Nume = '$delete_nume'";
            if (mysqli_query($conn, $delete_query)) {
                echo "<p>Antrenorul a fost sters cu succes.</p>";
            } else {
                echo "<p>Eroare la stergerea antrenorului: " . mysqli_error($conn) . "</p>";
            }
        }

        if (isset($_POST['update_nume']) && isset($_POST['update_prenume'])) {
            $update_nume = $_POST['update_nume'];
            $update_prenume = $_POST['update_prenume'];
            $nume = $_POST['nume'];
            $prenume = $_POST['prenume'];
            $ani_experienta = $_POST['ani_experienta'];
            $specializare = $_POST['specializare'];

            $update_query = "UPDATE antrenori SET Nume = '$nume', Prenume = '$prenume', `Ani de experienta` = $ani_experienta, Specializarea = '$specializare' 
                             WHERE Nume = '$update_nume' AND Prenume = '$update_prenume'";

            if (mysqli_query($conn, $update_query)) {
                echo "<p>Antrenorul a fost actualizat cu succes.</p>";
            } else {
                echo "<p>Eroare la actualizarea antrenorului: " . mysqli_error($conn) . "</p>";
            }
        }

        $query = "SELECT * FROM antrenori";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo '<table>
                    <tr>
                        <th>Nume</th>
                        <th>Prenume</th>
                        <th>Ani de experienta</th>
                        <th>Specializarea</th>
                        <th>Actiuni</th>
                    </tr>';
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                        <td>' . $row['Nume'] . '</td>
                        <td>' . $row['Prenume'] . '</td>
                        <td>' . $row['Ani de experienta'] . '</td>
                        <td>' . $row['Specializarea'] . '</td>
                        <td>
                            <form style="display:inline;" method="POST" action="editare_antrenori.php">
                                <input type="hidden" name="update_nume" value="' . $row['Nume'] . '">
                                <input type="hidden" name="update_prenume" value="' . $row['Prenume'] . '">
                                <input type="text" name="nume" value="' . $row['Nume'] . '" required>
                                <input type="text" name="prenume" value="' . $row['Prenume'] . '" required>
                                <input type="number" name="ani_experienta" value="' . $row['Ani de experienta'] . '" required>
                                <input type="text" name="specializare" value="' . $row['Specializarea'] . '" required>
                                <button type="submit">Actualizeaza</button>
                            </form>
                            <form style="display:inline;" method="POST" action="editare_antrenori.php">
                                <input type="hidden" name="delete_id" value="' . $row['Nume'] . '">
                                <button type="submit" style="background-color: red; color: white;">Sterge</button>
                            </form>
                        </td>
                    </tr>';
            }

            echo '</table>';
        } else {
            echo "<p>Nu exista antrenori in baza de date.</p>";
        }

        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
