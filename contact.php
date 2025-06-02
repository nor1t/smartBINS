<?php
$host = "localhost";
$dbname = "smartbins"; // Replace this with your actual DB name
$username = "root";
$password = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars(trim($_POST["name"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $message = htmlspecialchars(trim($_POST["message"]));

    if ($name && $email && $message) {
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->prepare("INSERT INTO contact (name, email, message) VALUES (:name, :email, :message)");
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':message' => $message
            ]);

            // ✅ Redirect to Thank You page
            header("Location: thankyou.html");
            exit();

        } catch (PDOException $e) {
            echo "Gabim në lidhje me bazën e të dhënave: " . $e->getMessage();
        }
    } else {
        echo "Ju lutem plotësoni të gjitha fushat.";
    }
} else {
    echo "Kërkesa nuk është e vlefshme.";
}
?>
