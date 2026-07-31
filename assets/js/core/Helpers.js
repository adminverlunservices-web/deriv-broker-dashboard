/**
 * ============================================================
 * Helper Functions
 * ============================================================
 */

class Helpers {

    static update(id, value) {

        const el = document.getElementById(id);

        if (!el) return;

        el.textContent = value ?? "--";

    }

    static badge(id, text, css) {

        const el = document.getElementById(id);

        if (!el) return;

        el.textContent = text;

        el.className = "badge " + css;

    }

    static money(amount, decimals = 2) {

        const number = Number(amount);

        if (isNaN(number)) return "--";

        return number.toLocaleString(undefined, {
            minimumFractionDigits: decimals,
            maximumFractionDigits: decimals
        });

    }

    static time() {

        return new Date().toLocaleTimeString();

    }

}