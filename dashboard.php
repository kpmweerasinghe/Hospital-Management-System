<?php

session_start();
include "session_check.php";
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="images/logo.jpeg">
    <link rel="stylesheet" href="css/style.css">
    <title>Viweka Hospital - Dashboard</title>
</head>
<body>
<?php include __DIR__ . '/includes/header.php'; ?>
<main class="page-wrapper">

<h2>Viweka Hospital Management System</h2>

<h3>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h3>

<hr>

<div class="dash-grid">

<div class="dash-card">
<h3><span class="dash-icon">🧑‍🤝‍🧑</span>Patient Management</h3>
<a href="patients.php">Register Patient</a><br>
<a href="view_patients.php">View Patients</a><br>
<a href="search_patient.php">Search Patient</a><br>
</div>

<div class="dash-card">
<h3><span class="dash-icon">🩺</span>Doctor Management</h3>
<a href="doctors.php">Manage Doctors</a><br>
<a href="doctor_schedule.php">Doctor Schedules</a><br>
</div>

<div class="dash-card">
<h3><span class="dash-icon">📅</span>Appointments</h3>
<a href="appointments.php">Book Appointment</a><br>
<a href="view_appointments.php">View Appointments</a><br>
</div>

<div class="dash-card">
<h3><span class="dash-icon">📋</span>Medical Records</h3>
<a href="emr.php">Add Medical Record</a><br>
<a href="view_emr.php">View Medical Records</a><br>
</div>

<div class="dash-card">
<h3><span class="dash-icon">🧪</span>Laboratory</h3>
<a href="laboratory.php">Laboratory</a><br>
<a href="view_lab_tests.php">View Laboratory Tests</a><br>
</div>

<div class="dash-card">
<h3><span class="dash-icon">💊</span>Pharmacy</h3>
<a href="pharmacy.php">Pharmacy Inventory</a><br>
<a href="prescriptions.php">Prescription Processing</a><br>
<a href="expiry_medicines.php">Expiry Monitoring</a><br>
</div>

<div class="dash-card">
<h3><span class="dash-icon">🧾</span>Billing</h3>
<a href="billing.php">Create Bill</a><br>
<a href="view_bills.php">View Bills</a><br>
</div>

<div class="dash-card">
<h3><span class="dash-icon">📊</span>Reports</h3>
<a href="reports.php">Reports</a><br>
</div>

<div class="dash-card">
<h3><span class="dash-icon">⚙️</span>Administration</h3>
<a href="users.php">User Management</a><br>
<a href="view_audit_logs.php">Audit Logs</a><br>
</div>

</div>

<br>

<a href="logout.php">Logout</a></main>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>