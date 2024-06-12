<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM vijesti WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $naslov = $row['naslov'];
        $kratki_sadrzaj = $row['kratki_sadrzaj'];
        $tekst = $row['tekst'];
        $slika = $row['slika'];
        $datum = $row['datum'];
        $kategorija = $row['kategorija'];
    } else {
        echo "No article found with this ID.";
        exit();
    }
} else {
    echo "No ID parameter provided.";
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="hr">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Devil May Cry News">
    <meta name="keywords" content="Devil May Cry, Characters, Weapons">
    <meta name="author" content="Branimir Pučar">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="css/clanak.css">
    <title><?php echo $naslov; ?></title>
</head>
<body>
    <header>
        <div class="header-logo">
            <a href="index.php"><img src="images/DevilMayCryLogo.jpg" alt="Devil May Cry"></a>
        </div>
    </header>
    <main>
        <div class="clanak">
            <h3><?php echo $naslov; ?></h3>
            <p class="kratki-sadrzaj"><?php echo $kratki_sadrzaj; ?></p>
            <img src="<?php echo $slika; ?>" alt="<?php echo $naslov; ?>">
            <p class="datum"><?php echo date('d/m/Y', strtotime($datum)); ?></p>
            <div class="tekst"><?php echo nl2br($tekst); ?></div>
        </div>
    </main>
    <footer>
        <p>Devil May Cry</p>
        <p>2024</p>
        <p>AUTHOR: Branimir Pucar</p>
        <p>CONTACT: bpucar@tvz.hr</p>
    </footer>
</body>
</html>