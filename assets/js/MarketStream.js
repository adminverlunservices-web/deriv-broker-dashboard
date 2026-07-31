/*
----------------------------------------------------
Live Volatility Markets
----------------------------------------------------
*/

const volatilitySymbols = [

    "R_10",
    "R_25",
    "R_50",
    "R_75",
    "R_100"

];

function subscribeVolatilityMarkets() {

    volatilitySymbols.forEach(symbol => {

        deriv.send({

            ticks: symbol,

            subscribe: 1

        });

    });

}

deriv.on("tick", response => {

    const tick = response.tick;

    const row = document.getElementById(tick.symbol);

    if (!row) return;

    const bidCell = row.querySelector(".bid");
    const askCell = row.querySelector(".ask");
    const status = row.querySelector(".market-status");

    const price = Number(tick.quote).toFixed(2);

    bidCell.innerHTML = price;

    /*
      Deriv tick stream provides a quote rather than separate
      bid/ask values for many synthetic indices. For now we
      display the quote in both columns. If you later subscribe
      to endpoints that provide bid/ask separately, we can
      update these independently.
    */

    askCell.innerHTML = price;

    status.className = "market-status text-success";

    status.innerHTML = "Live";

});