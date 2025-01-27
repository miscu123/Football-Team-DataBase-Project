<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editare Utilizatori</title>
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
        .block-button {
            background-color: orange;
            color: white;
        }
        .unblock-button {
            background-color: green;
            color: white;
        }
        .delete-button {
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editare Utilizatori</h1>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "echipa de fotbal");

        if (!$conn) {
            die("Conexiunea a esuat: " . mysqli_connect_error());
        }

        $check_column_query = "SHOW COLUMNS FROM `utilizatori` LIKE 'status'";
        $column_result = mysqli_query($conn, $check_column_query);
        if (mysqli_num_rows($column_result) == 0) {
            $add_column_query = "ALTER TABLE `utilizatori` ADD COLUMN `status` VARCHAR(20) DEFAULT 'activ'";
            mysqli_query($conn, $add_column_query);
        }

        if (isset($_POST['delete_id'])) {
            $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);
            $delete_query = "DELETE FROM `utilizatori` WHERE `ID` = '$delete_id' AND `tip-utilizator` != 'administrator'";

            if (mysqli_query($conn, $delete_query)) {
                echo "<p>Utilizatorul a fost sters cu succes.</p>";
            } else {
                echo "<p>Eroare la stergerea utilizatorului: " . mysqli_error($conn) . "</p>";
            }
        }

        if (isset($_POST['block_id'])) {
            $block_id = mysqli_real_escape_string($conn, $_POST['block_id']);
            $block_query = "UPDATE `utilizatori` SET `status` = 'blocat' WHERE `ID` = '$block_id' AND `tip-utilizator` != 'administrator'";

            if (mysqli_query($conn, $block_query)) {
                echo "<p>Utilizatorul a fost blocat cu succes.</p>";
            } else {
                echo "<p>Eroare la blocarea utilizatorului: " . mysqli_error($conn) . "</p>";
            }
        }

        if (isset($_POST['unblock_id'])) {
            $unblock_id = mysqli_real_escape_string($conn, $_POST['unblock_id']);
            $unblock_query = "UPDATE `utilizatori` SET `status` = 'activ' WHERE `ID` = '$unblock_id' AND `tip-utilizator` != 'administrator'";

            if (mysqli_query($conn, $unblock_query)) {
                echo "<p>Utilizatorul a fost deblocat cu succes.</p>";
            } else {
                echo "<p>Eroare la deblocarea utilizatorului: " . mysqli_error($conn) . "</p>";
            }
        }

        $query = "SELECT * FROM `utilizatori` WHERE `tip-utilizator` != 'administrator'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            echo '<table>
                    <tr>
                        <th>ID</th>
                        <th>Nume</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actiuni</th>
                    </tr>';

            while ($row = mysqli_fetch_assoc($result)) {
                $status = $row['status'] == 'blocat' ? 'Blocat' : 'Activ';

                echo '<tr>
                        <td>' . $row['ID'] . '</td>
                        <td>' . $row['Nume'] . '</td>
                        <td>' . $row['Email'] . '</td>
                        <td>' . $status . '</td>
                        <td>
                            <form style="display:inline;" method="POST" action="">
                                <input type="hidden" name="delete_id" value="' . $row['ID'] . '">
                                <button type="submit" class="delete-button">Sterge</button>
                            </form>
                            <form style="display:inline;" method="POST" action="">
                                <input type="hidden" name="block_id" value="' . $row['ID'] . '">
                                <button type="submit" class="block-button">Blocheaza</button>
                            </form>
                            <form style="display:inline;" method="POST" action="">
                                <input type="hidden" name="unblock_id" value="' . $row['ID'] . '">
                                <button type="submit" class="unblock-button">Deblocheaza</button>
                            </form>
                        </td>
                    </tr>';
            }

            echo '</table>';
        } else {
            echo "<p>Nu exista utilizatori in sistem.</p>";
        }

        mysqli_close($conn);
        ?>
    </div>
</body>
</html>