<?php
/**
 * =====================================================
 * Deriv Dashboard
 * Bot Builder
 * File: /bots/create.php
 * Part 1 - Section 1
 * =====================================================
 */

session_start();

// -----------------------------------------------------
// Authentication Check
// -----------------------------------------------------
if (!isset($_SESSION['access_token'])) {
    header("Location: ../login.php");
    exit;
}

$user = $_SESSION['user'];

$pageTitle = "Create Trading Bot";
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<meta
    name="viewport"
    content="width=device-width, initial-scale=1.0">

<title><?= $pageTitle ?></title>

<!-- Google Fonts -->

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect"
      href="https://fonts.gstatic.com"
      crossorigin>

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<!-- Font Awesome -->

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">

<!-- Bootstrap -->

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css"
rel="stylesheet">

<!-- Dashboard Theme -->

<link
rel="stylesheet"
href="../assets/css/style.css">

<link
rel="stylesheet"
href="../assets/css/dashboard.css">

<link
rel="stylesheet"
href="../assets/css/bot-builder.css">

</head>

<body>

<div id="app">

<!-- =====================================================
     SIDEBAR
====================================================== -->

<aside class="sidebar">

    <div class="logo">

        <img
            src="../assets/images/logo.png"
            alt="Logo">

        <h4>Deriv Dashboard</h4>

    </div>

    <ul class="menu">

        <li>

            <a href="../dashboard.php">

                <i class="fa-solid fa-chart-line"></i>

                Dashboard

            </a>

        </li>

        <li>

            <a href="../markets.php">

                <i class="fa-solid fa-signal"></i>

                Markets

            </a>

        </li>

        <li>

            <a href="../portfolio.php">

                <i class="fa-solid fa-wallet"></i>

                Portfolio

            </a>

        </li>

        <li>

            <a href="../positions.php">

                <i class="fa-solid fa-layer-group"></i>

                Positions

            </a>

        </li>

        <li>

            <a href="../history.php">

                <i class="fa-solid fa-clock-rotate-left"></i>

                Trade History

            </a>

        </li>

        <li class="active">

            <a href="index.php">

                <i class="fa-solid fa-robot"></i>

                Trading Bots

            </a>

        </li>

        <li>

            <a href="../settings.php">

                <i class="fa-solid fa-gear"></i>

                Settings

            </a>

        </li>

        <li>

            <a href="../logout.php">

                <i class="fa-solid fa-right-from-bracket"></i>

                Logout

            </a>

        </li>

    </ul>

</aside>

<!-- =====================================================
     MAIN CONTENT
====================================================== -->

<div class="main-wrapper">

<!-- =====================================================
     TOP NAVBAR
====================================================== -->

<header class="topbar">

    <div class="left">

        <button
            id="sidebarToggle"
            class="btn btn-dark">

            <i class="fa-solid fa-bars"></i>

        </button>

        <div class="page-title">

            <h3>Create Trading Bot</h3>

            <small>
                Build your automated Deriv strategy
            </small>

        </div>

    </div>

    <div class="right">

        <button class="notification-btn">

            <i class="fa-solid fa-bell"></i>

            <span class="badge bg-danger">
                3
            </span>

        </button>

        <div class="user-box">

            <img
                src="../assets/images/avatar.png"
                class="avatar"
                alt="avatar">

            <div>

                <strong>

                    <?= htmlspecialchars($user['name'] ?? 'Trader'); ?>

                </strong>

                <br>

                <small>

                    <?= htmlspecialchars($user['email'] ?? ''); ?>

                </small>

            </div>

        </div>

    </div>

</header>

<!-- =====================================================
     PAGE CONTENT
====================================================== -->

<div class="container-fluid py-4">

<div class="row">

<div class="col-lg-12">

<div class="page-header">

<h2>

<i class="fa-solid fa-robot text-primary"></i>

Create New Trading Bot

</h2>

<p class="text-muted">

Configure a fully automated trading strategy for your
Deriv account. Select your preferred market, strategy,
money management, and risk controls.

</p>

</div>

</div>

</div>

<!-- =====================================================
     SECTION 2 STARTS BELOW
====================================================== -->
    
    <!-- =====================================================
     BOT DETAILS + STRATEGY TEMPLATE
====================================================== -->

<div class="row g-4">

    <!-- ==========================================
         BOT DETAILS
    =========================================== -->
    <div class="col-xl-8">

        <div class="card shadow-sm border-0 bot-card">

            <div class="card-header bg-white">

                <h5 class="mb-0">

                    <i class="fa-solid fa-robot text-primary me-2"></i>

                    Bot Details

                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <!-- Bot Name -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Bot Name

                        </label>

                        <input
                            type="text"
                            id="bot_name"
                            name="bot_name"
                            class="form-control"
                            placeholder="Example: V75 Hunter">

                    </div>

                    <!-- Bot Version -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Version

                        </label>

                        <input
                            type="text"
                            id="version"
                            name="version"
                            class="form-control"
                            value="1.0.0">

                    </div>

                    <!-- Description -->
                    <div class="col-12 mb-3">

                        <label class="form-label">

                            Description

                        </label>

                        <textarea
                            rows="4"
                            id="description"
                            name="description"
                            class="form-control"
                            placeholder="Describe how this bot should trade..."></textarea>

                    </div>

                    <!-- Category -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Category

                        </label>

                        <select
                            id="category"
                            class="form-select">

                            <option>Forex</option>
                            <option>Synthetic Indices</option>
                            <option>Commodities</option>
                            <option>Stocks</option>
                            <option>Derived Indices</option>

                        </select>

                    </div>

                    <!-- Risk -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">

                            Risk Profile

                        </label>

                        <select
                            id="risk_profile"
                            class="form-select">

                            <option>Low</option>
                            <option selected>Medium</option>
                            <option>High</option>

                        </select>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- ==========================================
         QUICK TEMPLATE
    =========================================== -->

    <div class="col-xl-4">

        <div class="card shadow-sm border-0 bot-card">

            <div class="card-header bg-white">

                <h5 class="mb-0">

                    <i class="fa-solid fa-layer-group text-success me-2"></i>

                    Strategy Template

                </h5>

            </div>

            <div class="card-body">

                <div class="d-grid gap-2">

                    <button
                        type="button"
                        class="btn btn-outline-primary strategy-template"
                        data-template="martingale">

                        Martingale

                    </button>

                    <button
                        type="button"
                        class="btn btn-outline-primary strategy-template"
                        data-template="anti_martingale">

                        Anti-Martingale

                    </button>

                    <button
                        type="button"
                        class="btn btn-outline-primary strategy-template"
                        data-template="fibonacci">

                        Fibonacci

                    </button>

                    <button
                        type="button"
                        class="btn btn-outline-primary strategy-template"
                        data-template="dalembert">

                        D'Alembert

                    </button>

                    <button
                        type="button"
                        class="btn btn-outline-primary strategy-template"
                        data-template="digit_even">

                        Last Digit Even

                    </button>

                    <button
                        type="button"
                        class="btn btn-outline-primary strategy-template"
                        data-template="digit_odd">

                        Last Digit Odd

                    </button>

                    <button
                        type="button"
                        class="btn btn-outline-primary strategy-template"
                        data-template="rise_fall">

                        Rise / Fall

                    </button>

                    <button
                        type="button"
                        class="btn btn-outline-primary strategy-template"
                        data-template="over_under">

                        Over / Under

                    </button>

                </div>

                <hr>

                <div class="small text-muted">

                    Clicking a template will automatically pre-fill the
                    strategy configuration in the next section.

                </div>

            </div>

        </div>

    </div>

</div>

<!-- ==========================================
     BOT STATUS CARD
========================================== -->

<div class="row mt-4">

    <div class="col-lg-12">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="row text-center">

                    <div class="col-md-3">

                        <h6 class="text-muted">

                            Status

                        </h6>

                        <span
                            class="badge bg-secondary"
                            id="botStatus">

                            Draft

                        </span>

                    </div>

                    <div class="col-md-3">

                        <h6 class="text-muted">

                            Strategy

                        </h6>

                        <span id="selectedStrategy">

                            None Selected

                        </span>

                    </div>

                    <div class="col-md-3">

                        <h6 class="text-muted">

                            Risk

                        </h6>

                        <span id="selectedRisk">

                            Medium

                        </span>

                    </div>

                    <div class="col-md-3">

                        <h6 class="text-muted">

                            Validation

                        </h6>

                        <span
                            class="badge bg-warning"
                            id="validationBadge">

                            Waiting...

                        </span>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- =====================================================
     SECTION 2B STARTS BELOW
====================================================== -->
    
    <!-- =====================================================
     SECTION 2B.1
     MARKET & SYMBOL SELECTION
====================================================== -->

<div class="row mt-4">

    <div class="col-lg-12">

        <div class="card shadow-sm border-0 bot-card">

            <div class="card-header bg-white">

                <h5 class="mb-0">
                    <i class="fa-solid fa-chart-line text-success me-2"></i>
                    Market Selection
                </h5>

            </div>

            <div class="card-body">

                <div class="row">

                    <!-- Market Category -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Market
                        </label>

                        <select
                            id="market"
                            class="form-select">

                            <option value="">
                                Loading markets...
                            </option>

                        </select>

                        <small class="text-muted">

                            Loaded directly from Deriv.

                        </small>

                    </div>

                    <!-- Symbol -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Symbol

                        </label>

                        <select
                            id="symbol"
                            class="form-select"
                            disabled>

                            <option value="">
                                Select Market First
                            </option>

                        </select>

                    </div>

                    <!-- Trading Instrument -->

                    <div class="col-md-4 mb-3">

                        <label class="form-label">

                            Instrument Name

                        </label>

                        <input
                            type="text"
                            id="instrument_name"
                            class="form-control"
                            readonly
                            placeholder="Waiting for selection">

                    </div>

                </div>

                <hr>

                <div class="row">

                    <div class="col-md-3">

                        <div class="border rounded p-3 text-center">

                            <div class="text-muted small">
                                Symbol Code
                            </div>

                            <strong id="preview_symbol">
                                --
                            </strong>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="border rounded p-3 text-center">

                            <div class="text-muted small">
                                Market
                            </div>

                            <strong id="preview_market">
                                --
                            </strong>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="border rounded p-3 text-center">

                            <div class="text-muted small">
                                Trading Times
                            </div>

                            <strong id="preview_times">
                                Live
                            </strong>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="border rounded p-3 text-center">

                            <div class="text-muted small">
                                Status
                            </div>

                            <span
                                id="market_status"
                                class="badge bg-secondary">

                                Waiting

                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- =====================================================
     Hidden values populated by JavaScript
====================================================== -->

<input type="hidden" id="market_display_name">
<input type="hidden" id="symbol_display_name">
<input type="hidden" id="exchange_name">

<!-- =====================================================
     JavaScript hooks
====================================================== -->

<script>

window.BotBuilder = window.BotBuilder || {};

BotBuilder.marketSelect =
    document.getElementById("market");

BotBuilder.symbolSelect =
    document.getElementById("symbol");

BotBuilder.instrument =
    document.getElementById("instrument_name");

</script>

<!-- =====================================================
     SECTION 2B.2 STARTS BELOW
====================================================== -->