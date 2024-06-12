<?php
include 'connect.php';

$message = '';
$messageClass = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['lozinka'];

    $query = "SELECT id, lozinka, ime, razina_dozvole FROM korisnici WHERE korisnicko_ime = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $korisnicko_ime);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $id, $hashed_password, $ime, $razina_dozvole);
    mysqli_stmt_fetch($stmt);

    if (password_verify($lozinka, $hashed_password)) {
        $_SESSION['korisnicko_ime'] = $korisnicko_ime;
        $_SESSION['ime'] = $ime;
        $_SESSION['razina_dozvole'] = $razina_dozvole;
        if ($razina_dozvole == 'administrator') {
            header("Location: admin.php");
        } elseif ($razina_dozvole == 'korisnik') {
            $message = "Welcome, $ime. You have no power here go back where you came from. <a href='index.php'>Go Home</a>" ;

            $messageClass = 'message-warning';
        
        }
    } else {
        $message = "Do you even know your name or maybe you forgot your password. <a href='registracija.php'>REGISTRATION</a>";
        $messageClass = 'message-error';
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
    <link rel="stylesheet" href="css/prijava.css">
    <title>Sign up</title>
</head>
<body>
    <header>
        <div class="header-logo">
            <a href="index.php"><img src="images/DevilMayCryLogo.jpg" alt="Devil May Cry"></a>
        </div>
        <h1>Devil May Cry</h1>
        <h2>Welcome to the official Devil May Cry news</h2>
        <nav>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="registracija.php">REGISTRATION</a></li>
                <?php if (isset($_SESSION['korisnicko_ime'])): ?>
                    <li><a href="?logout=true">LOGOUT</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <form action="prijava.php" method="post">
            <h2>SIGN UP</h2>
            <div id="message" class="<?php echo isset($messageClass) ? $messageClass : ''; ?>">
            <?php echo isset($message) ? $message : ''; ?>
            <label for="korisnicko_ime">User name:</label>
            <input type="text" id="korisnicko_ime" name="korisnicko_ime" required>
            
            <label for="lozinka">Password:</label>
            <input type="password" id="lozinka" name="lozinka" required>
            
            <button type="submit">Sign in</button>
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