<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            echo "<script>alert('Sukses! Jeni kyçur.'); window.location.href='index.html';</script>";
        } else {
            echo "<script>alert('Fjalëkalimi nuk është i saktë'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Përdoruesi nuk ekziston'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
