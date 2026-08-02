/**
 * ============================================
 * Deriv Bot Builder API Client
 * File: /assets/js/api.js
 * ============================================
 */

class BotAPI {

    constructor(baseUrl = "/api") {
        this.baseUrl = baseUrl;
        this.timeout = 30000;
    }

    /**
     * Build URL
     */
    url(endpoint) {
        return `${this.baseUrl}/${endpoint}`;
    }

    /**
     * Generic Request
     */
    async request(endpoint, options = {}) {

        const controller = new AbortController();

        const timer = setTimeout(() => {
            controller.abort();
        }, this.timeout);

        try {

            const response = await fetch(this.url(endpoint), {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    ...(options.headers || {})
                },
                credentials: "same-origin",
                signal: controller.signal,
                ...options
            });

            clearTimeout(timer);

            let json = {};

            try {
                json = await response.json();
            } catch (e) {
                throw new Error("Invalid JSON returned by API.");
            }

            if (!response.ok) {
                throw new Error(
                    json.message || "Server returned an error."
                );
            }

            if (json.success === false) {
                throw new Error(
                    json.message || "Request failed."
                );
            }

            return json;

        } catch (error) {

            if (error.name === "AbortError") {
                throw new Error("Request timed out.");
            }

            throw error;
        }
    }

    /**
     * GET Request
     */
    get(endpoint) {

        return this.request(endpoint, {
            method: "GET"
        });

    }

    /**
     * POST Request
     */
    post(endpoint, data = {}) {

        return this.request(endpoint, {
            method: "POST",
            body: JSON.stringify(data)
        });

    }

    /* ==========================================
       MARKETS
    ========================================== */

    getMarkets() {
        return this.get("markets.php");
    }

    getSymbols(market) {
        return this.get(
            `symbols.php?market=${encodeURIComponent(market)}`
        );
    }

    getContracts(symbol) {
        return this.get(
            `contracts.php?symbol=${encodeURIComponent(symbol)}`
        );
    }

    getProposal(payload) {
        return this.post("proposal.php", payload);
    }

    saveBot(payload) {
        return this.post("save-bot.php", payload);
    }

    updateBot(payload) {
        return this.post("update-bot.php", payload);
    }

    runBot(id) {
        return this.post("run-bot.php", {
            id
        });
    }

    stopBot(id) {
        return this.post("stop-bot.php", {
            id
        });
    }

}

/* ==========================================
   GLOBAL INSTANCE
========================================== */

window.BotAPI = new BotAPI();

/* ==========================================
   UI HELPERS
========================================== */

window.APIHelpers = {

    fillSelect(select, items, valueKey = "value", textKey = "display") {

        if (!select) return;

        select.innerHTML = "";

        items.forEach(item => {

            const option = document.createElement("option");

            option.value = item[valueKey];

            option.textContent = item[textKey];

            select.appendChild(option);

        });

    },

    clearSelect(select, text = "Select...") {

        if (!select) return;

        select.innerHTML = "";

        const option = document.createElement("option");

        option.value = "";

        option.textContent = text;

        select.appendChild(option);

    }

};

/* ==========================================
   INITIALIZE MARKET DROPDOWN
========================================== */

document.addEventListener("DOMContentLoaded", async () => {

    const marketSelect = document.getElementById("market");
    const symbolSelect = document.getElementById("symbol");

    if (!marketSelect) return;

    try {

        APIHelpers.clearSelect(
            marketSelect,
            "Loading markets..."
        );

        const response = await BotAPI.getMarkets();

        APIHelpers.fillSelect(
            marketSelect,
            response.markets || []
        );

    } catch (error) {

        console.error(error);

        APIHelpers.clearSelect(
            marketSelect,
            "Unable to load markets"
        );

    }

    marketSelect.addEventListener("change", async function () {

        APIHelpers.clearSelect(
            symbolSelect,
            "Loading symbols..."
        );

        try {

            const response =
                await BotAPI.getSymbols(this.value);

            APIHelpers.fillSelect(
                symbolSelect,
                response.symbols || []
            );

        } catch (error) {

            console.error(error);

            APIHelpers.clearSelect(
                symbolSelect,
                "Unable to load symbols"
            );

        }

    });

});