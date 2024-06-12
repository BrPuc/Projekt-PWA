<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = password_hash($_POST['lozinka'], PASSWORD_DEFAULT);
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $razina_dozvole = 'korisnik';

    $query = "INSERT INTO korisnici (korisnicko_ime, lozinka, ime, prezime, razina_dozvole) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssss', $korisnicko_ime, $lozinka, $ime, $prezime, $razina_dozvole);

    if (mysqli_stmt_execute($stmt)) {
        echo "Success!";
    } else {
        echo "ERROR: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: prijava.php");
    exit();}
?>

<!DOCTYPE html>
<html lang="hr">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Devil May Cry News">
    <meta name="keywords" content="Devil May Cry, Characters, Weapons">
    <meta name="author" content="Branimir Pučar">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/unos.css">
    <title>Registration</title>
</head>
<body>
    <header>
        <div class="header-logo">
            <a href="index.php"><img src="images/DevilMayCryLogo.jpg" alt="Devil May Cry"></a>
        </div>
        <h1>Devil May Cry</h1>
        <h2>Welcome to official Devil May Cry Registration</h2>
        <nav>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="prijava.php">SIGN UP</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form action="registracija.php" method="post">
            <h2>CREATE YOUR NEW USER ACCOUNT</h2>
            <label for="ime">Name:</label>
            <input type="text" id="ime" name="ime" required>
            
            <label for="prezime">Surname:</label>
            <input type="text" id="prezime" name="prezime" required>
            
            <label for="korisnicko_ime">Username:</label>
            <input type="text" id="korisnicko_ime" name="korisnicko_ime" required>
            
            <label for="lozinka">Password:</label>
            <input type="password" id="lozinka" name="lozinka" required>
            
            <label for="ponovljena_lozinka">Repeate Password:</label>
            <input type="password" id="ponovljena_lozinka" name="ponovljena_lozinka" required>
            
            <button type="submit">Register</button>
        </form>
    </main>
    <footer>
        <p>Devil May Cry</p>
        <p>2024</p>
        <p>AUTHOR: Branimir Pucar</p>
        <p>CONTACT: bpucar@tvz.hr</p>
    </footer>
</body>
</html>