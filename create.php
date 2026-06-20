
<?php

include "connection.php";

$message = "";

if(isset($_POST['submit']))
{
    $scp_number = $_POST['scp_number'];
    $item_name = $_POST['item_name'];
    $object_class = $_POST['object_class'];
    $description = $_POST['description'];
    $containment_procedures = $_POST['containment_procedures'];
    $threat_level = $_POST['threat_level'];
    $image = $_POST['image'];

    $stmt = $connection->prepare(
    "INSERT INTO scp_subjects
    (
        scp_number,
        item_name,
        object_class,
        description,
        containment_procedures,
        threat_level,
        image
    )
    VALUES
    (?,?,?,?,?,?,?)"
    );

    $stmt->bind_param(
    "sssssss",
    $scp_number,
    $item_name,
    $object_class,
    $description,
    $containment_procedures,
    $threat_level,
    $image
    );

    if($stmt->execute())
    {
        $message =
        "<div class='alert alert-success'>
        SCP Record Added Successfully.
        </div>";
    }
    else
    {
        $message =
        "<div class='alert alert-danger'>
        Error Adding Record.
        </div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Create SCP Record</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet">

</head>

<body class="container">

<h1 class="mt-4">Create New SCP Record</h1>

<?php echo $message; ?>

<form method="post">

<div class="mb-3">

<label class="form-label">
SCP Number
</label>

<input
type="text"
name="scp_number"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">
Item Name
</label>

<input
type="text"
name="item_name"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">
Object Class
</label>

<select
name="object_class"
class="form-control">

<option>Safe</option>
<option>Euclid</option>
<option>Keter</option>

</select>

</div>

<div class="mb-3">

<label class="form-label">
Description
</label>

<textarea
name="description"
class="form-control"
rows="5"
required></textarea>

</div>

<div class="mb-3">

<label class="form-label">
Containment Procedures
</label>

<textarea
name="containment_procedures"
class="form-control"
rows="5"
required></textarea>

</div>

<div class="mb-3">

<label class="form-label">
Threat Level
</label>

<select
name="threat_level"
class="form-control">

<option>Low</option>
<option>Medium</option>
<option>High</option>
<option>Extreme</option>

</select>

</div>

<div class="mb-3">

<label class="form-label">
Image Path
</label>

<input
type="text"
name="image"
class="form-control"
placeholder="images/scp173.jpg">

</div>

<button
type="submit"
name="submit"
class="btn btn-success">

Create Record

</button>

<a href="index.php"
   class="btn btn-secondary">

Back

</a>

</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
