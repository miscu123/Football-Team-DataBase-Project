<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editare Formatii</title>
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
        <h1>Editare Formatii</h1>

        <?php
        $conn = mysqli_connect("localhost", "root", "", "echipa de fotbal");

        if (!$conn) {
            die("Conexiunea a esuat: " . mysqli_connect_error());
        }

        if (isset($_POST['delete_id'])) {
            $delete_tip = $_POST['delete_id'];
            $delete_query = "DELETE FROM formatii WHERE Tip = $delete_tip";
            if (mysqli_query($conn, $delete_query)) {
                echo "<p>Formatie a fost stearsa cu succes.</p>";
            } else {
                echo "<p>Eroare la stergerea formei: " . mysqli_error($conn) . "</p>";
            }
        }

        if (isset($_POST['update_tip'])) {
            $update_tip = $_POST['update_tip'];
            $tip = $_POST['tip'];
            $stil = $_POST['stil'];

            $update_query = "UPDATE formatii SET Tip = $tip, Stil = '$stil' WHERE Tip = $update_tip";

            if (mysqli_query($conn, $update_query)) {
                echo "<p>Formatie a fost actualizata cu succes.</p>";
            } else {
                echo "<p>Eroare la actualizarea formei: " . mysqli_error($conn) . "</p>";
            }
        }

        $query = "SELECT * FROM formatii";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo '<table>
                    <tr>
                        <th>Tip</th>
                        <th>Stil</th>
                        <th>Actiuni</th>
                    </tr>';
            
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>
                        <td>' . $row['Tip'] . '</td>
                        <td>' . $row['Stil'] . '</td>
                        <td>
                            <form style="display:inline;" method="POST" action="editare_formatii.php">
                                <input type="hidden" name="update_tip" value="' . $row['Tip'] . '">
                                <input type="number" name="tip" value="' . $row['Tip'] . '" required>
                                <input type="text" name="stil" value="' . $row['Stil'] . '" required>
                                <button type="submit">Actualizeaza</button>
                            </form>
                            <form style="display:inline;" method="POST" action="editare_formatii.php">
                                <input type="hidden" name="delete_id" value="' . $row['Tip'] . '">
                                <button type="submit" style="background-color: red; color: white;">Sterge</button>
                            </form>
                        </td>
                    </tr>';
            }

            echo '</table>';
        } else {
            echo "<p>Nu exista formatii in baza de date.</p>";
        }

        mysqli_close($conn);
        ?>
    </div>
</body>
</html>