<?php

$stats = [
    [
        "title" => "Balance",
        "id" => "stat-balance",
        "icon" => "fa-wallet",
        "color" => "primary"
    ],
    [
        "title" => "Equity",
        "id" => "stat-equity",
        "icon" => "fa-chart-line",
        "color" => "success"
    ],
    [
        "title" => "Margin",
        "id" => "stat-margin",
        "icon" => "fa-layer-group",
        "color" => "warning"
    ],
    [
        "title" => "Profit / Loss",
        "id" => "stat-profit",
        "icon" => "fa-arrow-trend-up",
        "color" => "info"
    ]
];

foreach ($stats as $card):
?>

<div class="col-lg-3 col-md-6 mb-4">

    <div class="stat-card">

        <div class="stat-icon bg-<?php echo $card['color']; ?>">

            <i class="fa-solid <?php echo $card['icon']; ?>"></i>

        </div>

        <div class="stat-content">

            <h6><?php echo $card['title']; ?></h6>

            <h3 id="<?php echo $card['id']; ?>">

                --

            </h3>

        </div>

    </div>

</div>

<?php endforeach; ?>