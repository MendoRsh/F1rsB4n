const form = document.querySelector("#loginForm");

form.addEventListener("submit", function(e) {
    e.preventDefault();
    let usuario = document.querySelector("#usuario").value.trim();
    let clave = document.querySelector("#clave").value.trim();


   // Validar campos vacíos
    if (usuario === "" || clave === "") {
        alert("Debes llenar ambos campos");
    return;
    }

    // Validar longitud

    if (usuario.length < 6 || usuario.length > 20) {
        alert("El usuario debe tener entre 6 y 20 caracteres");
    return;
    }

    // Validar caracteres especiales

     if (!/^[A-Za-z0-9]+$/.test(usuario)) {
        alert("El usuario solo puede contener letras y números");
    return;
    }

    // Validar clave solo números

    if (!/^[0-9]+$/.test(clave)) {
        alert("La clave solo puede contener números");
    return;
    }

    // Validar longitud clave

    if (clave.length < 4) {
        alert("La clave debe tener al menos 4 caracteres");
    return;
    }

    document.querySelector("#loaderOverlay").style.display = "flex";
})


