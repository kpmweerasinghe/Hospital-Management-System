<?php

session_start();
include "session_check.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "db.php";
include "role_check.php";

require_roles($conn, [
    'Administrator',
    'Doctor',
    'Lab Staff'
]);

$id = $_GET['id'];

$sql = "SELECT *
        FROM laboratory_tests
        WHERE test_id = $id";

$result = $conn->query($sql);

$test = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">

    <title>Viweka Hospital | Enter Laboratory Result</title>

</head>

<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h1>Enter Laboratory Result</h1>

<p>
    <strong>Test:</strong>
    <?php echo $test['test_name']; ?>
</p>

<form action="save_lab_result.php" method="POST">

    <input
        type="hidden"
        name="test_id"
        value="<?php echo $test['test_id']; ?>"
    >

    Result:<br>

    <textarea
        name="result"
        rows="8"
        cols="60"
        required
    ></textarea>

    <br><br>

    <button type="submit">
        Save Result
    </button>

</form>

<br>

<a href="view_lab_tests.php">
    Back to Laboratory Tests
</a>

</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>

</html>