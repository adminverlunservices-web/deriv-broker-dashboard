/**
 * ============================================================
 * DerivClient.js
 * Version: 2.0
 * Shared WebSocket Client
 * ============================================================
 */

class DerivClient {

    constructor(config = {}) {

        this.appId = config.appId || "";
        this.token = config.token || "";
        this.endpoint = config.wsUrl || "wss://ws.derivws.com/websockets/v3";

        this.socket = null;

        this.connected = false;
        this.authorized = false;

        this.reconnectDelay = 3000;
        this.maxReconnectDelay = 30000;
        this.reconnectAttempts = 0;

        this.heartbeatInterval = 30000;
        this.heartbeatTimer = null;

        this.listeners = {};

        this.requestId = 1;

        this.pendingRequests = new Map();

        this.subscriptions = new Map();

        this.autoReconnect = true;
    }

    /**
     * --------------------------------------------------------
     * Connect
     * --------------------------------------------------------
     */

    connect() {

        if (this.socket) {

            this.socket.close();

        }

        const url = `${this.endpoint}?app_id=${this.appId}`;

        this.socket = new WebSocket(url);

        this.bindEvents();

    }

    /**
     * --------------------------------------------------------
     * Socket Events
     * --------------------------------------------------------
     */

    bindEvents() {

        this.socket.onopen = () => {

            this.connected = true;

            this.reconnectAttempts = 0;

            this.emit("connected");

            this.startHeartbeat();

            if (this.token) {

                this.authorize();

            }

        };

        this.socket.onmessage = (event) => {

            this.handleMessage(event);

        };

        this.socket.onerror = (error) => {

            this.emit("error", error);

        };

        this.socket.onclose = () => {

            this.connected = false;

            this.authorized = false;

            this.stopHeartbeat();

            this.emit("disconnected");

            if (this.autoReconnect) {

                this.reconnect();

            }

        };

    }

    /**
     * --------------------------------------------------------
     * Reconnect
     * --------------------------------------------------------
     */

    reconnect() {

        this.reconnectAttempts++;

        const delay = Math.min(

            this.reconnectDelay * this.reconnectAttempts,

            this.maxReconnectDelay

        );

        this.emit("reconnecting", {

            attempt: this.reconnectAttempts,

            delay

        });

        setTimeout(() => {

            this.connect();

        }, delay);

    }

    /**
     * --------------------------------------------------------
     * Disconnect
     * --------------------------------------------------------
     */

    disconnect() {

        this.autoReconnect = false;

        this.stopHeartbeat();

        if (this.socket) {

            this.socket.close();

        }

    }

    /**
     * --------------------------------------------------------
     * Heartbeat
     * --------------------------------------------------------
     */

    startHeartbeat() {

        this.stopHeartbeat();

        this.heartbeatTimer = setInterval(() => {

            if (!this.connected) {

                return;

            }

            this.send({

                ping: 1

            });

        }, this.heartbeatInterval);

    }

    stopHeartbeat() {

        if (this.heartbeatTimer) {

            clearInterval(this.heartbeatTimer);

            this.heartbeatTimer = null;

        }

    }

    /**
     * --------------------------------------------------------
     * Authorize
     * --------------------------------------------------------
     */

    authorize() {

        this.send({

            authorize: this.token

        });

    }

    /**
     * --------------------------------------------------------
     * Send
     * --------------------------------------------------------
     */

    send(payload) {

        if (!this.connected) {

            console.warn("Socket not connected.");

            return false;

        }

        this.socket.send(JSON.stringify(payload));

        return true;

    }

    /**
     * --------------------------------------------------------
     * Event System
     * --------------------------------------------------------
     */

    on(event, callback) {

        if (!this.listeners[event]) {

            this.listeners[event] = [];

        }

        this.listeners[event].push(callback);

    }

    off(event, callback) {

        if (!this.listeners[event]) return;

        this.listeners[event] = this.listeners[event].filter(

            fn => fn !== callback

        );

    }

    emit(event, data = null) {

        if (!this.listeners[event]) return;

        this.listeners[event].forEach(fn => {

            fn(data);

        });

    }

    /**
     * --------------------------------------------------------
     * Placeholder
     * (Implemented in Part 2)
     * --------------------------------------------------------
     */

    handleMessage(event) {

        console.log("Incoming:", event.data);

    }

}