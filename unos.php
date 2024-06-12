<?php
include 'connect.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naslov = $_POST['naslov'];
    $sadrzaj = $_POST['sadrzaj'];
    $tekst = $_POST['tekst'];
    $kategorija = $_POST['kategorija'];
    $arhiva = isset($_POST['arhiva']) ? 1 : 0;

    $slika = $_FILES['slika']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($slika);

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    if (move_uploaded_file($_FILES['slika']['tmp_name'], $target_file)) {
        $sql = "INSERT INTO vijesti (naslov, kratki_sadrzaj, tekst, slika, kategorija, arhiva) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssssi", $naslov, $sadrzaj, $tekst, $target_file, $kategorija, $arhiva);
            if ($stmt->execute()) {
                $last_id = $stmt->insert_id;
                $message = "Success.";
                echo "<script>alert('$message'); window.location.href='skripta.php?id=$last_id';</script>";
            } else {
                $message = "Error: " . $stmt->error;
                echo "<script>alert('$message');</script>";
            }
            $stmt->close();
        } else {
            $message = "Error while sending SQL: " . $conn->error;
            echo "<script>alert('$message');</script>";
        }
    } else {
        $message = "Error while sending pictures.";
        echo "<script>alert('$message');</script>";
    }
}

$conn->close();
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
    <link rel="stylesheet" href="css/unos.css">
    <title>Insert News</title>
</head>
<body>
    <header>
        <div class="header-logo">
            <a href="index.php"><img src="images/DevilMayCryLogo.jpg" alt="Devil May Cry"></a>
        </div>
        <h1>Devil May Cry</h1>
        <h2>Insert News</h2>
        <nav>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="unos.php">INSERT NEWS</a></li>
                <li><a href="prijava.php">SIGN UP</a></li>
                <li><a href="registracija.php">REGISTRATION</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <form enctype="multipart/form-data" action="unos.php" method="POST" id="newsForm">
            <div class="form-item">
                
                <label for="naslov">Headline:</label>
                <div class="form-field">
                    <input type="text" name="naslov" id="naslov" class="form-field-textual">
                </div>
                <span id="porukaTitle" class="bojaPoruke"></span>
            </div>
            <div class="form-item">
                
                <label for="sadrzaj">Short Info:</label>
                <div class="form-field">
                    <textarea name="sadrzaj" id="sadrzaj" cols="30" rows="10" class="form-field-textual"></textarea>
                </div>
                <span id="porukaAbout" class="bojaPoruke"></span>
            </div>
            <div class="form-item">
                <label for="tekst">Text:</label>
                <div class="form-field">
                    <textarea name="tekst" id="tekst" cols="30" rows="10" class="form-field-textual"></textarea>
                </div>                
                <span id="porukaContent" class="bojaPoruke"></span>

            </div>
            <div class="form-item">
                
                <label for="slika">Picture</label>
                <div class="form-field">
                    <input type="file" class="input-text" id="slika" name="slika">
                </div>
                <span id="porukaSlika" class="bojaPoruke"></span>
            </div>
            <div class="form-item">
                
                <label for="kategorija">News Category</label>
                <div class="form-field">
                    <select name="kategorija" id="kategorija" class="form-field-textual">
                        <option value="" disabled selected>Chose Category</option>
                        <option value="Local News">Local News</option>
                        <option value="Local City News">Local City News</option>
                        <option value="Arms Dealing">Arms Dealing</option>
                    </select>
                </div>
                <span id="porukaKategorija" class="bojaPoruke"></span>
            </div>
            <div class="form-item">
                <label>Save to archives</label>
                <div class="form-field">
                    <input type="checkbox" name="arhiva" id="arhiva">
                </div>
            </div>
            <div class="form-item">
                <button type="reset" value="Poništi">Reset</button>
                <button type="submit" value="Prihvati" id="slanje">Accept</button>
            </div>
        </form>
    </main>
    <footer>
        <p>Devil May Cry</p>
        <p>2024</p>
        <p>AUTHOR: Branimir Pucar</p>
        <p>CONTACT: bpucar@tvz.hr</p>
    </footer>
    <script type="text/javascript">
        document.getElementById("slanje").onclick = function(event) {
            var slanjeForme = true;

            var poljeTitle = document.getElementById("naslov");
            var title = poljeTitle.value;
            if (title.length < 5 || title.length > 30) {
                slanjeForme = false;
                poljeTitle.style.border = "1px dashed red";
                document.getElementById("porukaTitle").innerHTML = "Headline requiers 5 to 30 symbols!<br>";
            } else {
                poljeTitle.style.border = "1px solid green";
                document.getElementById("porukaTitle").innerHTML = "";
            }

            var poljeAbout = document.getElementById("sadrzaj");
            var about = poljeAbout.value;
            if (about.length < 10 || about.length > 100) {
                slanjeForme = false;
                poljeAbout.style.border = "1px dashed red";
                document.getElementById("porukaAbout").innerHTML = "Short info needs to have 10 i 100 runes!<br>";
            } else {
                poljeAbout.style.border = "1px solid green";
                document.getElementById("porukaAbout").innerHTML = "";
            }

            var poljeContent = document.getElementById("tekst");
            var content = poljeContent.value;
            if (content.length == 0) {
                slanjeForme = false;
                poljeContent.style.border = "1px dashed red";
                document.getElementById("porukaContent").innerHTML = "Context must be engraved!<br>";
            } else {
                poljeContent.style.border = "1px solid green";
                document.getElementById("porukaContent").innerHTML = "";
            }

            var poljeSlika = document.getElementById("slika");
            var pphoto = poljeSlika.value;
            if (pphoto.length == 0) {
                slanjeForme = false;
                poljeSlika.style.border = "1px dashed red";
                document.getElementById("porukaSlika").innerHTML = "Picture is a must!<br>";
            } else {
                poljeSlika.style.border = "1px solid green";
                document.getElementById("porukaSlika").innerHTML = "";
            }

            var poljeCategory = document.getElementById("kategorija");
            if (poljeCategory.selectedIndex == 0) {
                slanjeForme = false;
                poljeCategory.style.border = "1px dashed red";
                document.getElementById("porukaKategorija").innerHTML = "Chose the category!<br>";
            } else {
                poljeCategory.style.border = "1px solid green";
                document.getElementById("porukaKategorija").innerHTML = "";
            }

            if (!slanjeForme) {
                event.preventDefault();
            }
        };
    </script>
</body>
</html>