
/**
 * ----------------------------------------------------
 * Live Account Module
 * Compatible with existing Deriv OAuth
 * Requires:
 *      $_SESSION['token']
 * ----------------------------------------------------
 */


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Live Account</title>

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
rel="stylesheet">

<link
href="assets/css/live-account.css"
rel="stylesheet">

</head>

<body>

<div class="wrapper">

    <!-- Sidebar -->

    <?php include "components/sidebar.php"; ?>

    <!-- Main -->

    <main class="content">

        <!-- Top Navigation -->

        <?php include "components/navbar.php"; ?>

        <div class="container-fluid">

            <div class="page-title">

                <h2>

                    <i class="fa-solid fa-wallet"></i>

                    Live Account

                </h2>

                <span id="connection-status"
                class="badge bg-warning">

                    Connecting...

                </span>

            </div>

            <!-- ACCOUNT CARD -->

            <div class="row">

                <div class="col-lg-8">

                    <?php include "components/account-card.php"; ?>

                </div>

                <div class="col-lg-4">

                    <div class="card balance-card">

                        <div class="card-body">

                            <h6>Current Balance</h6>

                            <h1 id="balance">

                               <span id="balance"></span>

                            </h1>

                            <small id="currency">

                                USD

                            </small>

                        </div>

                    </div>

                </div>

            </div>

            <!-- STATS -->

            <div class="row mt-4">

                <?php include "components/stat-card.php"; ?>

            </div>

            <!-- ACCOUNT DETAILS -->

            <div class="card mt-4">

                <div class="card-header">

                    Account Details

                </div>

                <div class="card-body">

                    <table class="table">

                        <tbody>

<tr>

<td>Login ID</td>

<td id="loginid">
    
    <span id="loginid"></span>
    
    </td>

</tr>

<tr>

<td>Email</td>

<td id="email">--</td>

</tr>

<tr>

<td>Full Name</td>

<td id="fullname">--</td>

</tr>

<tr>

<td>Currency</td>

<td id="currency2">--</td>

</tr>

<tr>

<td>Country</td>

<td id="country">--</td>

</tr>

<tr>

<td>Landing Company</td>

<td id="landing-company">--</td>

</tr>

<tr>

<td>Account Type</td>

<td id="account-type">--</td>

</tr>

<tr>

<td>Balance</td>

<td id="balance2">--</td>

</tr>

<tr>

<td>Profit/Loss</td>

<td id="profitloss">--</td>

</tr>

<tr>

<td>Last Updated</td>

<td id="updated">

Never

</td>

</tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </main>

</div>
<input type="hidden" id="api-endpoint" value="api/account.php">


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/live-account.js"></script>

</body>

</html>