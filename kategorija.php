<?php
include 'connect.php';

$is_logged_in = false;
$is_admin = false;
$username = 'Welcome';

if (isset($_SESSION['korisnicko_ime']) && isset($_SESSION['razina_dozvole'])) {
    $is_logged_in = true;
    $username = $_SESSION['korisnicko_ime'];
    $is_admin = $_SESSION['razina_dozvole'] === 'administrator';
    $username = $is_admin ? 'Welcome home demon' : "Welcome, $username";
}

function format_time($datetime) {
    $date = new DateTime($datetime);
    return $date->format('H:i');
}

function format_date($datetime) {
    $date = new DateTime($datetime);
    return $date->format('Y-m-d');
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: prijava.php");
    exit();
}

$kategorija = isset($_GET['id']) ? $_GET['id'] : '';
?>

<!DOCTYPE html>
<html lang="hr">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Devil May Cry News">
    <meta name="keywords" content="Devil May Cry, Characters, Weapons">
    <meta name="author" content="Branimir Pučar">
    <link rel="shortcut icon" href="images/logo.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/kategorija.css">
    <title>Category - <?php echo htmlspecialchars($kategorija); ?></title>
</head>
<body>
    <header>
        <div class="header-logo">
            <a href="index.php"><img src="images/DevilMayCryLogo.jpg" alt="Devil May Cry"></a>
        </div>
        <h1>Devil May Cry</h1>
        <h2><?php echo $username; ?></h2>
        <nav>
            <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="kategorija.php?id=Local News">Local News</a></li>
            <li><a href="kategorija.php?id=Local City News">Local City News</a></li>
            <li><a href="kategorija.php?id=Arms Dealing">Arms Dealing</a></li>
                <?php if ($is_logged_in && $is_admin): ?>
                    <li><a href="unos.php">INSERT NEWS</a></li>
                <?php elseif ($is_logged_in): ?>
                    <li><a href="javascript:void(0);" onclick="alert('You dont have power!')">INSERT NEWS</a></li>
                <?php endif; ?>
                <?php if ($is_logged_in && $is_admin) : ?>
                    <li><a href="admin.php">ADMIN</a></li>
                <?php endif; ?>
                <li><a href="prijava.php">SIGN UP</a></li>
                <li><a href="registracija.php">REGISTRATION</a></li>
                <?php if ($is_logged_in) : ?>
                    <li><a href="?logout=true">LOGOUT</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <section class="kategorija">
            <div class="section-line"></div>
            <h3><?php echo htmlspecialchars($kategorija); ?></h3>
            <div class="news-container">
                <?php
                $query = "SELECT id, naslov, slika, datum, tekst FROM vijesti WHERE kategorija='$kategorija' AND arhiva=0 ORDER BY datum DESC";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="news-item">';
                        echo '<a href="clanak.php?id=' . $row['id'] . '">';
                        echo '<img src="' . $row['slika'] . '" alt="' . $row['naslov'] . '">';
                        echo '<h4>' . $row['naslov'] . '</h4>';
                        echo '<p>' . format_time($row['datum']) . '</p>';
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>Error while executing: ' . mysqli_error($conn) . '</p>';
                }
                ?>
            </div>
        </section>
    </main>
    <footer>
        <p>Devil May Cry</p>
        <p>2024</p>
        <p>AUTHOR: Branimir Pucar</p>
        <p>CONTACT: bpucar@tvz.hr</p>
    </footer>
</body>
</html>