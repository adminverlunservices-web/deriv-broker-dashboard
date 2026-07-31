<?php
session_start();
if(!isset($_SESSION['token'])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Trading Terminal</title>
<link rel="stylesheet" href="assets/css/theme.css">
<link rel="stylesheet" href="assets/css/layout.css">
</head>
<body>
<div class="app">
<?php include 'components/sidebar.php'; ?>
<?php include 'components/navbar.php'; ?>

<main class="main">
<div class="dashboard">

<div class="card col-3">
<h3>Live Account</h3>
<p>Waiting for live connection...</p>
</div>

<div class="card col-3">
<h3>Market Watch</h3>
<p>Coming in Sprint 3</p>
</div>

<div class="card col-6">
<h3>Trading Chart</h3>
<div style="height:420px;display:flex;align-items:center;justify-content:center;">
Chart placeholder
</div>
</div>

<div class="card col-6">
<h3>Trade Ticket</h3>
<p>Ready for Sprint 5</p>
</div>

<div class="card col-6">
<h3>Open Positions</h3>
<p>No open positions.</p>
</div>

</div>
</main>
</div>

<script src="assets/js/app.js"></script>
</body>
</html>
