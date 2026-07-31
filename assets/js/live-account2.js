/*
--------------------------------------------------------
Deriv Live Account Module
Version: 1.0
--------------------------------------------------------
*/

const API = document.getElementById("api-endpoint").value;

let ws = null;
let token = null;

let reconnectAttempts = 0;
let reconnectTimer = null;

const WS_URL = "wss://ws.derivws.com/websockets/v3?app_id=1089";

/*
--------------------------------------------------------
Utility
--------------------------------------------------------
*/

function setStatus(text, color) {

    const badge = document.getElementById("connection-status");

    if (!badge) return;

    badge.innerHTML = text;

    badge.className = "badge";

    badge.classList.add(color);

}

function update(id, value) {

    const el = document.getElementById(id);

    if (el)
        el.innerHTML = value ?? "--";

}

function now() {

    return new Date().toLocaleTimeString();

}

/*
--------------------------------------------------------
Load Session Token
--------------------------------------------------------
*/

async function loadToken() {

    try {

        const response = await fetch(API + "?action=token", {
            credentials: "same-origin"
        });

        const json = await response.json();

        if (!json.success) {

            window.location = "login.php";

            return;

        }

        token = json.token;

        connect();

    }

    catch (e) {

        console.error(e);

    }

}

/*
--------------------------------------------------------
Connect
--------------------------------------------------------
*/

function connect() {

    if (ws)
        ws.close();

    setStatus("Connecting...", "bg-warning");

    ws = new WebSocket(WS_URL);

    ws.onopen = () => {

        reconnectAttempts = 0;

        authorize();

    };

    ws.onmessage = handleMessage;

    ws.onerror = () => {

        setStatus("Connection Error", "bg-danger");

    };

    ws.onclose = () => {

        setStatus("Disconnected", "bg-danger");

        reconnect();

    };

}

/*
--------------------------------------------------------
Reconnect
--------------------------------------------------------
*/

function reconnect() {

    reconnectAttempts++;

    clearTimeout(reconnectTimer);

    reconnectTimer = setTimeout(() => {

        connect();

    }, Math.min(reconnectAttempts * 3000, 15000));

}

/*
--------------------------------------------------------
Authorize
--------------------------------------------------------
*/

function authorize() {

    ws.send(JSON.stringify({

        authorize: token

    }));

}

/*
--------------------------------------------------------
Request Live Data
--------------------------------------------------------
*/

function requestAccount() {

    ws.send(JSON.stringify({

        get_settings: 1

    }));

    ws.send(JSON.stringify({

        balance: 1,

        subscribe: 1

    }));

}

/*
--------------------------------------------------------
Handle WebSocket Messages
--------------------------------------------------------
*/

function handleMessage(event) {

    const msg = JSON.parse(event.data);

    console.log(msg);

    switch (msg.msg_type) {

        /*
        ----------------------------
        Authorized
        ----------------------------
        */

        case "authorize":

            setStatus("Connected", "bg-success");

            fillAuthorize(msg.authorize);

            requestAccount();

            break;

        /*
        ----------------------------
        Balance Updates
        ----------------------------
        */

        case "balance":

            fillBalance(msg.balance);

            break;

        /*
        ----------------------------
        Settings
        ----------------------------
        */

        case "get_settings":

            fillSettings(msg.get_settings);

            break;

        /*
        ----------------------------
        Errors
        ----------------------------
        */

        case "error":

            console.error(msg);

            setStatus("Authorization Failed", "bg-danger");

            break;

    }

}

/*
--------------------------------------------------------
Authorize Data
--------------------------------------------------------
*/

function fillAuthorize(data) {

    update("loginid", data.loginid);

    update("fullname", data.fullname);

    update("currency", data.currency);

    update("currency2", data.currency);

    update("country", data.country);

    update("balance", data.balance);

    update("balance2", data.balance);

    update("updated", now());

}

/*
--------------------------------------------------------
Balance
--------------------------------------------------------
*/

function fillBalance(data) {

    update("balance", data.balance);

    update("balance2", data.balance);

    update("currency", data.currency);

    update("currency2", data.currency);

    update("updated", now());

}

/*
--------------------------------------------------------
Settings
--------------------------------------------------------
*/

function fillSettings(data) {

    update("email", data.email || "--");

    update("landing-company", data.landing_company || "--");

    update("account-type", data.client_tnc_status || "Standard");

}

/*
--------------------------------------------------------
Start
--------------------------------------------------------
*/

document.addEventListener("DOMContentLoaded", () => {

    loadToken();

});