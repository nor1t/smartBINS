<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (fullname, email, username, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $email, $username, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Regjistrimi u krye me sukses!'); window.location.href='login.html';</script>";
    } else {
        echo "<script>alert('Gabim: Username ose Email ekziston!'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
