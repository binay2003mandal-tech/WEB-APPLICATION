<?php
$servername = "localhost";
$username = "a30110476_Binay"; 
$password = "9828896617-Bm-2003@";
$database = "a30110476_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); } echo "<h2>Listing Fields in 'scp_subjects' Table</h2>"; $result = $conn->query("DESCRIBE scp_subjects"); if ($result->num_rows > 0) { echo "<table border='1' cellpadding='10' style='border-collapse:collapse;'>"; echo " <tr> <th>Field</th> <th>Type</th> <th>Null</th> <th>Key</th> <th>Default</th> <th>Extra</th> </tr> "; while($row = $result->fetch_assoc()) { echo "<tr>"; echo "<td>" . $row['Field'] . "</td>"; echo "<td>" . $row['Type'] . "</td>"; echo "<td>" . $row['Null'] . "</td>"; echo "<td>" . $row['Key'] . "</td>"; echo "<td>" . $row['Default'] . "</td>"; echo "<td>" . $row['Extra'] . "</td>"; echo "</tr>"; } echo "</table>"; } else { echo "Table not found."; } $conn->close(); ?>