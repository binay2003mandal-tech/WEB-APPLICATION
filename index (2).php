<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SCP Foundation CRUD Application</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body class="container">

<?php

include "connection.php";

/* Navigation Menu Records */

$result = $connection->query(
"SELECT id, scp_number FROM scp_subjects ORDER BY scp_number"
);

?>

<div>

<ul class="nav navbar-dark bg-dark p-2 mb-3">

<?php foreach($result as $link): ?>

<li class="nav-item">

<a href="index.php?link=<?php echo $link['scp_number']; ?>"
   class="nav-link text-light">

<?php echo $link['scp_number']; ?>

</a>

</li>

<?php endforeach; ?>

<li class="nav-item">

<a href="create.php"
   class="nav-link text-warning">

Create New SCP Record

</a>

</li>

</ul>

</div>

<h1 class="mb-4">SCP Foundation CRUD Application</h1>

<?php

/* READ RECORD */

if(isset($_GET['link']))
{
    $scp_number = $_GET['link'];

    $stmt = $connection->prepare(
    "SELECT * FROM scp_subjects WHERE scp_number = ?"
    );

    if(!$stmt)
    {
        echo "<div class='alert alert-danger'>
              Error preparing SQL statement.
              </div>";
        exit;
    }

    $stmt->bind_param(
    "s",
    $scp_number
    );

    if($stmt->execute())
    {
        $record = $stmt->get_result();

        if($record->num_rows > 0)
        {
            $array = array_map(
            'htmlspecialchars',
            $record->fetch_assoc()
            );

            $update =
            "update.php?update=" .
            $array['id'];

            $delete =
            "index.php?delete=" .
            $array['id'];

            echo "

            <div class='card shadow mb-3'>

                <div class='card-body'>

                    <h2>
                    {$array['scp_number']}
                    </h2>

                    <h4>
                    Object Class:
                    {$array['object_class']}
                    </h4>

                    <p>
                    <strong>Item Name:</strong>
                    {$array['item_name']}
                    </p>

                    <p>
                    <strong>Description:</strong><br>
                    {$array['description']}
                    </p>

                    <p>
                    <strong>Containment Procedures:</strong><br>
                    {$array['containment_procedures']}
                    </p>

                    <p>
                    <strong>Threat Level:</strong>
                    {$array['threat_level']}
                    </p>

                    <p class='text-center'>
                    <img src='{$array['image']}'
                         alt='{$array['scp_number']}'
                         class='img-fluid'>
                    </p>

                    <a href='{$update}'
                       class='btn btn-info'>
                       Update Record
                    </a>

                    <a href='{$delete}'
                       class='btn btn-danger'
                       onclick='return confirm(\"Delete this SCP Record?\")'>
                       Delete Record
                    </a>

                </div>

            </div>

            ";
        }
        else
        {
            echo "<div class='alert alert-warning'>
                  No SCP record found.
                  </div>";
        }
    }
}

/* DELETE RECORD */

if(isset($_GET['delete']))
{
    $deleteID = $_GET['delete'];

    $delete = $connection->prepare(
    "DELETE FROM scp_subjects WHERE id=?"
    );

    $delete->bind_param(
    "i",
    $deleteID
    );

    if($delete->execute())
    {
        echo "
        <div class='alert alert-warning'>
        SCP Record Deleted Successfully.
        </div>";
    }
    else
    {
        echo "
        <div class='alert alert-danger'>
        Error deleting record.
        </div>";
    }
}

/* HOME PAGE */

if(
!isset($_GET['link']) &&
!isset($_GET['delete'])
)
{
    echo "

    <div class='text-center mt-5'>

        <h2>Welcome to the SCP Foundation Database</h2>

        <p>
        Select an SCP record from the menu above.
        </p>

        <img src='images/scp_logo.png'
             alt='SCP Foundation'
             class='img-fluid'>

    </div>

    ";
}

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
