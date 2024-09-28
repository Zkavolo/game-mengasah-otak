<?php
session_start();
$conn = new mysqli("localhost", "root", "", "asah_otak");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getRandomWord($conn) {
    $sql = "SELECT * FROM master_kata ORDER BY RAND() LIMIT 1";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

if (!isset($_SESSION['current_word']) || isset($_POST['retry'])) {
    $word_data = getRandomWord($conn);
    $_SESSION['current_word'] = strtoupper($word_data['kata']);
    $_SESSION['current_clue'] = $word_data['clue'];
}

$kata = $_SESSION['current_word'];
$clue = $_SESSION['current_clue'];

if (!isset($_SESSION['total_points'])) {
    $_SESSION['total_points'] = 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kata_input'])) {
    $total_points = 0;
    $user_input = array_map('strtoupper', $_POST['kata_input']);
    for ($i = 0; $i < strlen($kata); $i++) {
        if ($i == 2 || $i == 6) {
            continue;
        }
        if (isset($user_input[$i])) {
            if ($user_input[$i] == $kata[$i]) {
                $total_points += 10;
            } else {
                $total_points -= 2;
            }
        } else {
            $total_points -= 2;
        }
    }
    $_SESSION['total_points'] += $total_points;
    echo "<h2>Poin yang Anda dapat: " . $total_points . "</h2>";
    echo "<h2>Total Poin: " . $_SESSION['total_points'] . "</h2>";
    echo '<form method="POST" action="">
            <input type="submit" name="save_points" value="Simpan Poin">
            <input type="submit" name="retry" value="Ulangi">
          </form>';
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_points'])) {
    if (!empty($_POST['nama_user'])) {
        $nama_user = $_POST['nama_user'];
        $stmt = $conn->prepare("INSERT INTO point_game (nama_user, total_point) VALUES (?, ?)");
        $stmt->bind_param("si", $nama_user, $_SESSION['total_points']);
        $stmt->execute();
        $_SESSION['total_points'] = 0;
        unset($_SESSION['current_word'], $_SESSION['current_clue']);
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}

if (isset($_POST['retry'])) {
    $_SESSION['total_points'] = 0;
    unset($_SESSION['current_word'], $_SESSION['current_clue']);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Mengasah Otak</title>
</head>
<body>
<h1>Game Mengasah Otak</h1>
<?php 
if (!isset($_POST['save_points'])) {
    echo "<p>Clue: " . $clue . "</p>";
    echo '<form method="POST" action="">';
    for ($i = 0; $i < strlen($kata); $i++) {
        $letter = ($i == 2 || $i == 6) ? $kata[$i] : "";
        echo '<input type="text" name="kata_input[]" value="' . $letter . '" maxlength="1" style="text-transform: uppercase;"' . ($letter ? ' readonly' : '') . '>';
    }
    echo '<button type="submit">Submit</button>';
    echo '</form>';
    echo "<p>Total Points: " . $_SESSION['total_points'] . "</p>";
} else {
    echo '<h3>Masukkan Nama Anda untuk Simpan Poin:</h3>';
    echo '<form method="POST" action="">';
    echo '<input type="text" name="nama_user" required>';
    echo '<button type="submit" name="save_points">Simpan Poin</button>';
    echo '</form>';
}
?>
</body>
</html>