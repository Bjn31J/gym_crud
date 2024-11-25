<?php  require('views/header/header_login.php');?>
<div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh; background-color: #f8f9fa;">
    <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%; border-radius: 15px;">
        <div class="card-body">
            <div class="text-center mb-4">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="user-icon" width="80" class="mb-3">
                <h3 class="card-title">Iniciar Sesión en Fitness Plus</h3>
            </div>
            <form method="post" action="login.php?accion=login">
                <!-- Correo Electrónico -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="correo">Correo electrónico</label>
                    <input type="email" name="data[correo]" id="correo" class="form-control" required />
                </div>

                <!-- Contraseña -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="contrasena">Contraseña</label>
                    <input type="password" name="data[contrasena]" id="contrasena" class="form-control" required />
                </div>

                <!-- Recordarme y Recuperar Contraseña -->
                <div class="d-flex justify-content-between mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="recordarme" />
                        <label class="form-check-label" for="recordarme"> Recuérdame </label>
                    </div>
                </div>

                <!-- Botón de Inicio de Sesión -->
                <button type="submit" name="enviar" class="btn btn-primary btn-block mb-4">Iniciar Sesión</button>
            </form>
        </div>
    </div>
</div>
