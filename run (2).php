<?php

$servername = "localhost";
$username = "a30110476_Binay";
$password = "9828896617-Bm-2003@";
$database = "a30110476_db";

// ✅ Create connection (this was missing)
$conn = new mysqli($servername, $username, $password, $database);

// ✅ Check connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

// ✅ Create table
$sql = "CREATE TABLE IF NOT EXISTS scp_subjects (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    scp_number VARCHAR(20) NOT NULL,
    item_name VARCHAR(100) NOT NULL,
    object_class VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    containment_procedures TEXT NOT NULL,
    threat_level VARCHAR(50) NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "<h2>✅ Success</h2>";
    echo "<p>Table created successfully.</p>";
} else {
    echo "<h2>❌ Error</h2>";
    echo "<p>" . htmlspecialchars($conn->error) . "</p>";
}

$conn->close();

?>