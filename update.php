<?php

include "connection.php";

/* Check ID */

if(!isset($_GET['update']) || !is_numeric($_GET['update']))
{
    die("<div class='alert alert-danger'>Invalid SCP Record.</div>");
}

$id = $_GET['update'];

/* Get Existing Record */

$stmt = $connection->prepare(
"SELECT * FROM scp_subjects WHERE id = ?"
);

$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows == 0)
{
    die("<div class='alert alert-warning'>Record Not Found.</div>");
}

$scp = $result->fetch_assoc();

/* Update Record */

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

    $update = $connection->prepare(
    "UPDATE scp_subjects
    SET
    scp_number=?,
    item_name=?,
    object_class=?,
    description=?,
    containment_procedures=?,
    threat_level=?,
    image=?
    WHERE id=?"
    );

    $update->bind_param(
    "sssssssi",
    $scp_number,
    $item_name,
    $object_class,
    $description,
    $containment_procedures,
    $threat_level,
    $image,
    $id
    );

    if($update->execute())
    {
        header("Location: index.php?updated=1");
        exit;
    }
    else
    {
        $message =
        "<div class='alert alert-danger'>
        Error Updating Record.
        </div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">

<meta name="viewport"
      content="width=device-width, initial-scale=1">

<title>Update SCP Record</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet">

</head>

<body class="container">

<div class="mt-4 mb-3">

    <a href="index.php" class="btn btn-secondary">
        ← Return to Home Page
    </a>

</div>

<div class="card shadow">

    <div class="card-body">

        <h1 class="mb-4">
            Update SCP Record
        </h1>

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
                value="<?php echo htmlspecialchars($scp['scp_number']); ?>"
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
                value="<?php echo htmlspecialchars($scp['item_name']); ?>"
                required>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Object Class
                </label>

                <select
                name="object_class"
                class="form-control">

                    <option value="Safe"
                    <?php if($scp['object_class']=="Safe") echo "selected"; ?>>
                    Safe
                    </option>

                    <option value="Euclid"
                    <?php if($scp['object_class']=="Euclid") echo "selected"; ?>>
                    Euclid
                    </option>

                    <option value="Keter"
                    <?php if($scp['object_class']=="Keter") echo "selected"; ?>>
                    Keter
                    </option>

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Description
                </label>

                <textarea
                name="description"
                class="form-control"
                rows="4"
                required><?php echo htmlspecialchars($scp['description']); ?></textarea>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Containment Procedures
                </label>

                <textarea
                name="containment_procedures"
                class="form-control"
                rows="4"
                required><?php echo htmlspecialchars($scp['containment_procedures']); ?></textarea>

            </div>

            <div class="mb-3">

                <label class="form-label">
                    Threat Level
                </label>

                <select
                name="threat_level"
                class="form-control">

                    <option value="Low"
                    <?php if($scp['threat_level']=="Low") echo "selected"; ?>>
                    Low
                    </option>

                    <option value="Medium"
                    <?php if($scp['threat_level']=="Medium") echo "selected"; ?>>
                    Medium
                    </option>

                    <option value="High"
                    <?php if($scp['threat_level']=="High") echo "selected"; ?>>
                    High
                    </option>

                    <option value="Extreme"
                    <?php if($scp['threat_level']=="Extreme") echo "selected"; ?>>
                    Extreme
                    </option>

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
                value="<?php echo htmlspecialchars($scp['image']); ?>">

            </div>

            <button
            type="submit"
            name="submit"
            class="btn btn-success">

                Update Record

            </button>

            <a href="index.php"
               class="btn btn-secondary">

                Cancel

            </a>

        </form>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>


