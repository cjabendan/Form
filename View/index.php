<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT'] . "/Form/Database/database.php";
    include $_SERVER['DOCUMENT_ROOT'] . "/Form/Model/TableModel.php";

    $model = new TableModel($conn);
    $forms = $model->tableForms();

    if (isset($_GET['delete_id'])) {
        $id = intval($_GET['delete_id']);
        if ($model->delForm($id)) {  
            header("Location: index.php"); 
            exit();
        } else {
            die("Error deleting record: " . $conn->error);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Form/Styling/style.css">
    <link rel="stylesheet" href="/Form/Styling/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>PHP Forms Data</title>
</head>

<body>
    <video autoplay muted loop id="bg-video">
        <source src="/Form/files/bgv.mp4" type="video/mp4">
    </video>

    <div class="wrapper">
        <div class="header">
            <h1>All Forms Data</h1>
            <div class="button-container">
                <a href="/Form/View/form.php" class="btn">Add Form</a>
            </div>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th class="hidden-column">ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th class="actions">Form Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($forms->num_rows > 0) {
                        while ($row = $forms->fetch_assoc()) {
                            $age = date_diff(date_create($row['dob']), date_create('today'))->y;

                            echo "<tr>";
                            echo "<td class='hidden-column'>" . htmlspecialchars($row['id']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['ln']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['fn']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['mn']) . "</td>";
                            echo "<td>" . $age . "</td>";
                            echo "<td>" . htmlspecialchars($row['sex']) . "</td>";
                            echo "<td class='action-buttons'>";
                            echo "<a href='/Form/Controller/ViewController.php?id=" . htmlspecialchars($row['id']) . "' title='View Form'><i class='fas fa-eye'></i></a>";
                            echo "<a href='/Form/Controller/EditController.php?id=" . htmlspecialchars($row['id']) . "' title='Edit Form'><i class='fas fa-edit'></i></a>";
                            echo "<a href='javascript:void(0);' onclick='confirmDelete(" . htmlspecialchars($row['id']) . ")' title='Delete Form'><i class='fas fa-trash'></i></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' style='text-align: center;'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this record?")) {
                window.location.href = "index.php?delete_id=" + id;
            }
        }
    </script>
</body>
</html>