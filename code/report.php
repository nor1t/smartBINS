<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Database connection
    $conn = new mysqli("localhost", "root", "", "smartbins");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check all required fields
    if (
        !empty($_POST["description"]) &&
        isset($_POST["email_preference"]) &&
        isset($_POST["problem_type"]) &&
        isset($_POST["confirm"]) &&
        isset($_FILES["screenshot"]) &&
        $_FILES["screenshot"]["error"] === 0
    ) {
        // Sanitize input
        $description = $conn->real_escape_string($_POST["description"]);
        $email_preference = $conn->real_escape_string($_POST["email_preference"]);
        $problem_type = intval($_POST["problem_type"]);

        // Handle file upload
        $upload_dir = "uploads/";
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_name = basename($_FILES["screenshot"]["name"]);
        $target_file = $upload_dir . uniqid() . "_" . $file_name;

        if (move_uploaded_file($_FILES["screenshot"]["tmp_name"], $target_file)) {
            // Insert into database
            $sql = "INSERT INTO report (description, email_preference, problem_type, image_path)
                    VALUES ('$description', '$email_preference', $problem_type, '$target_file')";

           if ($conn->query($sql) === TRUE) {
    header("Location: thankyou.html");
    exit();
} else {
    echo "Gabim në dërgimin e raportit: " . $conn->error;
}

        } else {
            echo "Ngarkimi i fotos dështoi.";
        }
    } else {
        echo "Ju lutem plotësoni të gjitha fushat.";
    }

    $conn->close();
}
?>
