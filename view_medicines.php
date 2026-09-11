<?php

session_start();
include "session_check.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";
include "role_check.php";

require_roles($conn, ['Administrator', 'Pharmacist']);

$sql = "SELECT * FROM medicines
        ORDER BY medicine_id DESC";

$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | Medicine Inventory</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Medicine Inventory</h1>

<a href="pharmacy.php">
    + Add Medicine
</a>

<br><br>

<table border="1" cellpadding="10">

<tr>

    <th>ID</th>
    <th>Medicine Name</th>
    <th>Category</th>
    <th>Quantity</th>
    <th>Unit Price</th>
    <th>Expiry Date</th>
    <th>Action</th>

</tr>

<?php while ($row = $result->fetch_assoc()) { ?>

<tr>

    <td><?php echo $row['medicine_id']; ?></td>

    <td><?php echo $row['medicine_name']; ?></td>

    <td><?php echo $row['category']; ?></td>

    <td><?php echo $row['quantity']; ?></td>

    <td><?php echo $row['unit_price']; ?></td>

    <td><?php echo $row['expiry_date']; ?></td>

    <td>

        <a href="edit_medicine.php?id=<?php echo $row['medicine_id']; ?>">
            Edit
        </a>

        |

        <a href="delete_medicine.php?id=<?php echo $row['medicine_id']; ?>"
           onclick="return confirm('Are you sure you want to delete this medicine?');">
            Delete
        </a>

    </td>

</tr>

<?php } ?>

</table>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>