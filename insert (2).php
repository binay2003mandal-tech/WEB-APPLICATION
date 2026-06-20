<?php

$servername = "localhost";
$username = "a30110476_Binay";
$password = "9828896617-Bm-2003@";
$database = "a30110476_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO scp_subjects
(scp_number, item_name, object_class, description, containment_procedures, threat_level, image)

VALUES

('SCP-002','The Living Room','Euclid',
'An anomalous living room that assimilates organic matter.',
'Contained in a secure research facility.',
'Medium',
'images/scp002.jpg'),

('SCP-049','Plague Doctor','Euclid',
'Humanoid entity claiming to cure a pestilence.',
'Kept in a standard humanoid containment cell.',
'High',
'images/scp049.jpg'),

('SCP-096','The Shy Guy','Euclid',
'Hostile humanoid that reacts when its face is viewed.',
'Images and recordings of its face are prohibited.',
'High',
'images/scp096.jpg'),

('SCP-106','The Old Man','Keter',
'Hostile entity capable of passing through solid matter.',
'Specialized containment procedures required.',
'Extreme',
'images/scp106.jpg'),

('SCP-173','The Sculpture','Euclid',
'Animate concrete sculpture that moves when unobserved.',
'Must remain under direct observation.',
'High',
'images/scp173.jpg'),

('SCP-500','Panacea','Safe',
'Pills capable of curing nearly all diseases.',
'Stored in a secure medical locker.',
'Low',
'images/scp500.jpg'),

('SCP-682','Hard-to-Destroy Reptile','Keter',
'Large reptilian creature with extreme regenerative abilities.',
'Contained in a reinforced acid-filled chamber.',
'Extreme',
'images/scp682.jpg'),

('SCP-999','The Tickle Monster','Safe',
'Friendly gelatinous organism that induces happiness.',
'Standard containment procedures.',
'Low',
'images/scp999.jpg'),

('SCP-1048','Builder Bear','Euclid',
'Small teddy bear capable of creating anomalous replicas.',
'Monitored continuously.',
'Medium',
'images/scp1048.jpg'),

('SCP-3008','Infinite IKEA','Euclid',
'Retail store with an infinite interior space.',
'Public access restricted and monitored.',
'High',
'images/scp3008.jpg')
";

if ($conn->query($sql) === TRUE)
{
    echo "<h2>Success!</h2>";
    echo "<p>10 SCP records inserted successfully.</p>";
}
else
{
    echo "<h2>Error</h2>";
    echo "<p>" . $conn->error . "</p>";
}

$conn->close();

?>