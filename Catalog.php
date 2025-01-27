<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogul echipei</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        h1 {
            text-align: center;
        }
        form {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
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
        .rezerva-bilet {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .rezerva-bilet:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1> Cauta jucatori: </h1>
    <form method="get" action="" class="container">
        <label for="nume">Nume:</label>
        <input type="text" name="nume" id="nume" placeholder="Cauta dupa nume"><br><br>

        <label for="varsta">Varsta:</label>
        <input type="text" name="varsta" id="varsta" placeholder="Cauta dupa varsta"><br><br>

        <label for="inaltime">Inaltime:</label>
        <input type="number" name="inaltime" id="inaltime" placeholder="Cauta dupa inaltime"><br><br>

        <label for="goluri">Goluri:</label>
        <input type="number" name="goluri" id="goluri" placeholder="Cauta dupa goluri"><br><br>

        <button type="submit" name="filtrare">Filtreaza</button>
        <button type="submit" name="toate">Vizualizeaza toate</button>
    </form>

<?php

$conn = mysqli_connect("localhost", "root", "", "echipa de fotbal");

if (!$conn) {
    die("Eroare la conectarea la baza de date: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

$sql = "SELECT nume, prenume, varsta, inaltime, goluri FROM `atacanti`";

if (isset($_GET['filtrare'])) {
    $nume = isset($_GET['nume']) ? mysqli_real_escape_string($conn, $_GET['nume']) : '';
    $prenume = isset($_GET['prenume']) ? mysqli_real_escape_string($conn, $_GET['prenume']) : '';
    $varsta = isset($_GET['varsta']) ? mysqli_real_escape_string($conn, $_GET['varsta']) : '';
    $inaltime = isset($_GET['inaltime']) ? mysqli_real_escape_string($conn, $_GET['inaltime']) : '';
    $goluri = isset($_GET['goluri']) ? mysqli_real_escape_string($conn, $_GET['goluri']) : '';

    $sql .= " WHERE 1";  

    if (!empty($nume)) {
        $sql .= " AND nume LIKE '%$nume%'";
    }
    if (!empty($varsta)) {
        $sql .= " AND varsta LIKE '%$varsta%'";
    }
    if (!empty($inaltime)) {
        $sql .= " AND inaltime = $inaltime";
    }
    if (!empty($goluri)) {
        $sql .= " AND goluri = $goluri";
    }

} elseif (isset($_GET['toate'])) {

}

$result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr>";
        echo "<th>Nume</th>";
        echo "<th>Prenume</th>";
        echo "<th>Varsta</th>";
        echo "<th>Inaltime</th>";
        echo "<th>Goluri</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nume']) . "</td>";
            echo "<td>" . htmlspecialchars($row['prenume']) . "</td>";
            echo "<td>" . htmlspecialchars($row['varsta']) . "</td>";
            echo "<td>" . htmlspecialchars($row['inaltime']) . "</td>";
            echo "<td>" . htmlspecialchars($row['goluri']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Nu exista jucatori care sa corespunda criteriilor de cautare.";
    }
} else {
    echo "Eroare la interogare: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

<h1> Cauta antrenori: </h1>
<form method="get" action="" class="container">
    <label for="Nume">Nume:</label>
    <input type="text" name="Nume" id="Nume" placeholder="Cauta dupa nume"><br><br>

    <label for="Prenume">Prenume:</label>
    <input type="text" name="Prenume" id="Prenume" placeholder="Cauta dupa prenume"><br><br>

    <label for="ani_experienta">Ani de experienta:</label>
    <input type="number" name="ani_experienta" id="ani_experienta" placeholder="Cauta dupa ani de experienta"><br><br>

    <label for="Specializarea">Specializarea:</label>
    <input type="text" name="Specializarea" id="Specializarea" placeholder="Cauta dupa specializare"><br><br>

    <button type="submit" name="filtrare">Filtreaza</button>
    <button type="submit" name="toate">Vizualizeaza toate</button>
</form>

<?php

$conn = mysqli_connect("localhost", "root", "", "echipa de fotbal");

if (!$conn) {
    die("Eroare la conectarea la baza de date: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

$sql = "SELECT Nume, Prenume, `Ani de experienta`, Specializarea FROM `antrenori`";

if (isset($_GET['filtrare'])) {
    $nume = isset($_GET['Nume']) ? mysqli_real_escape_string($conn, $_GET['Nume']) : '';
    $prenume = isset($_GET['Prenume']) ? mysqli_real_escape_string($conn, $_GET['Prenume']) : '';
    $ani_experienta = isset($_GET['ani_experienta']) ? mysqli_real_escape_string($conn, $_GET['ani_experienta']) : '';
    $specializarea = isset($_GET['Specializarea']) ? mysqli_real_escape_string($conn, $_GET['Specializarea']) : '';

    $sql .= " WHERE 1";  

    if (!empty($nume)) {
        $sql .= " AND Nume LIKE '%$nume%'";
    }
    if (!empty($prenume)) {
        $sql .= " AND Prenume LIKE '%$prenume%'";
    }
    if (!empty($ani_experienta)) {
        $sql .= " AND `Ani de experienta` = $ani_experienta";
    }
    if (!empty($specializarea)) {
        $sql .= " AND Specializarea LIKE '%$specializarea%'";
    }

} elseif (isset($_GET['toate'])) {
   
}

$result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr>";
        echo "<th>Nume</th>";
        echo "<th>Prenume</th>";
        echo "<th>Ani de experienta</th>";
        echo "<th>Specializarea</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Nume']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Prenume']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Ani de experienta']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Specializarea']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Nu exista antrenori care sa corespunda criteriilor de cautare.";
    }
} else {
    echo "Eroare la interogare: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

<h1> Cauta formatii: </h1>
<form method="get" action="" class="container">
    <label for="Tip">Tip:</label>
    <input type="number" name="Tip" id="Tip" placeholder="Cauta dupa tip"><br><br>

    <label for="Stil">Stil:</label>
    <input type="text" name="Stil" id="Stil" placeholder="Cauta dupa stil"><br><br>

    <button type="submit" name="filtrare">Filtreaza</button>
    <button type="submit" name="toate">Vizualizeaza toate</button>
</form>

<?php

$conn = mysqli_connect("localhost", "root", "", "echipa de fotbal");

if (!$conn) {
    die("Eroare la conectarea la baza de date: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

$sql = "SELECT Tip, Stil FROM `formatii`";

if (isset($_GET['filtrare'])) {
    $tip = isset($_GET['Tip']) ? mysqli_real_escape_string($conn, $_GET['Tip']) : '';
    $stil = isset($_GET['Stil']) ? mysqli_real_escape_string($conn, $_GET['Stil']) : '';

    $sql .= " WHERE 1";  

    if (!empty($tip)) {
        $sql .= " AND Tip = $tip";
    }
    if (!empty($stil)) {
        $sql .= " AND Stil LIKE '%$stil%'";
    }

} elseif (isset($_GET['toate'])) {
    // Afiseaza toate inregistrarile daca nu exista filtrare
    $sql = "SELECT Tip, Stil FROM `formatii`";
}

$result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr>";
        echo "<th>Tip</th>";
        echo "<th>Stil</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Tip']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Stil']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Nu exista formatii care sa corespunda criteriilor de cautare.";
    }
} else {
    echo "Eroare la interogare: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

<h1> Cauta palmares echipa: </h1>
<form method="get" action="" class="container">
    <label for="Tipul_trofeului">Tipul trofeului:</label>
    <input type="text" name="Tipul_trofeului" id="Tipul_trofeului" placeholder="Cauta dupa tipul trofeului"><br><br>

    <label for="Anul_castigator">Anul castigator:</label>
    <input type="number" name="Anul_castigator" id="Anul_castigator" placeholder="Cauta dupa anul castigator"><br><br>

    <button type="submit" name="filtrare">Filtreaza</button>
    <button type="submit" name="toate">Vizualizeaza toate</button>
</form>

<?php

$conn = mysqli_connect("localhost", "root", "", "echipa de fotbal");

if (!$conn) {
    die("Eroare la conectarea la baza de date: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

$sql = "SELECT `Tipul trofeului`, `Anul castigator` FROM `palmares echipa`";

if (isset($_GET['filtrare'])) {
    $tipul_trofeului = isset($_GET['Tipul_trofeului']) ? mysqli_real_escape_string($conn, $_GET['Tipul_trofeului']) : '';
    $anul_castigator = isset($_GET['Anul_castigator']) ? mysqli_real_escape_string($conn, $_GET['Anul_castigator']) : '';

    $sql .= " WHERE 1";  

    if (!empty($tipul_trofeului)) {
        $sql .= " AND `Tipul trofeului` LIKE '%$tipul_trofeului%'";
    }
    if (!empty($anul_castigator)) {
        $sql .= " AND `Anul castigator` = $anul_castigator";
    }

} elseif (isset($_GET['toate'])) {
    $sql = "SELECT `Tipul trofeului`, `Anul castigator` FROM `palmares echipa`";
}

$result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1' cellpadding='10' cellspacing='0'>";
        echo "<tr>";
        echo "<th>Tipul trofeului</th>";
        echo "<th>Anul castigator</th>";
        echo "</tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['Tipul trofeului']) . "</td>";
            echo "<td>" . htmlspecialchars($row['Anul castigator']) . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "Nu exista trofee care sa corespunda criteriilor de cautare.";
    }
} else {
    echo "Eroare la interogare: " . mysqli_error($conn);
}
mysqli_close($conn);
?>

<div class="container">
<h2>Rezerva bilete!</h2>
<form method="post" action="">
    <label for="nume_persoana">Nume:</label>
    <input type="text" name="nume_persoana" id="nume_persoana" required><br><br>

    <label for="bilete">Numar bilete:</label>
    <input type="number" name="bilete" id="bilete" min="1" required><br><br>

    <button type="submit" name="rezerva_bilet">Rezerva bilet!</button>
</form>
</div>  

<?php
$conn = mysqli_connect("localhost", "root", "", "echipa de fotbal");

if (!$conn) {
    die("Eroare la conectarea la baza de date: " . mysqli_connect_error());
}

if (isset($_POST['rezerva_bilet'])) {
    $numar_bilete_dorite = isset($_POST['bilete']) ? (int)$_POST['bilete'] : 0;
    $nume_persoana = isset($_POST['nume_persoana']) ? $_POST['nume_persoana'] : '';

    if ($numar_bilete_dorite > 0 && !empty($nume_persoana)) {
        $sql = "SELECT numar_bilete_disponibile, numar_bilete_rezervate FROM bilete WHERE id = 1";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $numar_bilete_disponibile = $row['numar_bilete_disponibile'];

            if ($numar_bilete_disponibile >= $numar_bilete_dorite) {
                $sql_update = "UPDATE bilete 
                               SET numar_bilete_disponibile = numar_bilete_disponibile - $numar_bilete_dorite,
                                   numar_bilete_rezervate = numar_bilete_rezervate + $numar_bilete_dorite
                               WHERE id = 1";

                if (mysqli_query($conn, $sql_update)) {
                    // Inregistreaza rezervarea in tabelul 'rezervari'
                    $data_rezervare = date('Y-m-d H:i:s'); 
                    $sql_insert_rezervare = "INSERT INTO rezervari (nume, data_rezervare, numar_bilete) 
                                             VALUES ('$nume_persoana', '$data_rezervare', $numar_bilete_dorite)";
                    if (mysqli_query($conn, $sql_insert_rezervare)) {
                        echo "<p>Biletele au fost rezervate cu succes!</p>";
                    } else {
                        echo "<p>Eroare la salvarea rezervarii: " . mysqli_error($conn) . "</p>";
                    }
                } else {
                    echo "<p>Eroare la rezervare: " . mysqli_error($conn) . "</p>";
                }
            } else {
                echo "<p>Nu sunt suficiente bilete disponibile. Mai sunt doar $numar_bilete_disponibile bilete disponibile.</p>";
            }
        } else {
            echo "<p>Eroare la obtinerea informatiilor despre bilete: " . mysqli_error($conn) . "</p>";
        }
    } else {
        echo "<p>Te rog sa introduci un numar valid de bilete si un nume.</p>";
    }
}

mysqli_close($conn);
?>

</body>
</html>