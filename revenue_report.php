<?php

session_start();
include "session_check.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";

$sql = "SELECT
            SUM(total_amount) AS total_revenue,
            COUNT(*) AS total_bills,
            SUM(
                CASE
                    WHEN payment_status = 'Paid'
                    THEN total_amount
                    ELSE 0
                END
            ) AS paid_revenue

        FROM billing";

$result = $conn->query($sql);

$revenue = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | Revenue Report</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Revenue Report</h1>

<h3>Total Bills</h3>

<p>
    <?php echo $revenue['total_bills']; ?>
</p>

<h3>Total Billing Amount</h3>

<p>
    <?php echo $revenue['total_revenue']; ?>
</p>

<h3>Paid Revenue</h3>

<p>
    <?php echo $revenue['paid_revenue']; ?>
</p>

<br>

<button onclick="window.print()">
    Print Report
</button>

<br><br>

<a href="reports.php">
    Back to Reports
</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>