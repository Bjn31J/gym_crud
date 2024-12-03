<?php require_once('views/header.php'); ?>
<?php
// Conexión a la base de datos
$entrenadores = [];
try {
    $pdo = new PDO('mysql:host=localhost;dbname=fitnessplus', 'fitnessplus', '123');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta a la base de datos
    $stmt = $pdo->prepare("SELECT nombre, apellido, especialidad, fotografia FROM entrenadores");
    $stmt->execute();
    $entrenadores = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/fitnessplus/css/estilo.css">
    <title>FITNESS PLUS</title>
</head>

<body>
    <!-- MENÚ -->
    <div class="contenedor-header">
        <header>
            <h1><span class="txtRojo">FITNESS PLUS</span></h1>
            <nav id="nav">
                <a href="#inicio" onclick="seleccionar()">Inicio</a>
                <a href="#nosotros" onclick="seleccionar()">Nosotros</a>
                <a href="#servicios" onclick="seleccionar()">Servicios</a>
                <a href="#comodidades" onclick="seleccionar()">Comodidades</a>
                <a href="#galeria" onclick="seleccionar()">Galería</a>
                <a href="#equipo" onclick="seleccionar()">Equipo</a>
                <a href="#contacto" onclick="seleccionar()">Contacto</a>
                <a href="#iniciar-sesion" onclick="seleccionar()">Iniciar sesión</a>
            </nav>
            <!-- Ícono del menú responsive -->
            <div id="icono-nav" class="nav-responsive" onclick="mostrarOcultarMenu()">
                <i class="fa-solid fa-bars"></i>
            </div>
        </header>
    </div>

    <!-- SECCIÓN INICIO -->
    <section id="inicio" class="inicio">
        <div class="contenido-seccion">
            <div class="info">
                <h2>HAZ QUE <span class="txtRojo">OCURRA</span></h2>
                <p>El esfuerzo es la raíz del éxito.</p>
                <a href="#nosotros" class="btn-mas">
                    <i class="fa-solid fa-circle-chevron-down"></i>
                </a>
            </div>
            <div class="opciones">
                <div class="opcion">01. PLAN PERSONALIZADO</div>
                <div class="opcion">02. PLAN ESTÁNDAR</div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN NOSOTROS -->
    <section id="nosotros" class="nosotros hidden">
        <div class="fila">
            <div class="col">
                <img src="/fitnessplus/images/nosotros.png" alt="Nosotros">
            </div>
            <div class="col">
                <div class="contenedor-titulo">
                    <div class="numero">01</div>
                    <div class="info">
                        <span class="frase">LA MEJOR EXPERIENCIA</span>
                        <h2>NOSOTROS</h2>
                    </div>
                </div>
                <p class="p-especial">
                    En nuestro gimnasio nos enfocamos en brindarte una experiencia de entrenamiento integral y de alta calidad.
                </p>
                <p>
                    Contamos con instalaciones de primer nivel y un equipo de profesionales apasionados y comprometidos con tu progreso.
                </p>
            </div>
        </div>
        <hr>
    </section>

    <!-- SECCIÓN SERVICIOS -->
    <section id="servicios" class="servicios hidden">
        <div class="contenido-seccion">
            <div class="fila">
                <div class="col">
                    <div class="contenedor-titulo">
                        <div class="numero">02</div>
                        <div class="info">
                            <span class="frase">LA MEJOR EXPERIENCIA</span>
                            <h2>SERVICIOS</h2>
                        </div>
                    </div>
                    <p class="p-especial">Conoce nuestros planes.</p>
                    <p>Elige el plan que mejor se adapte a tus objetivos.</p>
                </div>
                <div class="col">
                    <img src="/fitnessplus/images/servicios.png" alt="Servicios">
                </div>
            </div>
        </div>
        <div class="info-servicios">
            <table>
                <tr>
                    <td>
                        <i class="fa-solid fa-person-walking"></i>
                        <h3><span class="txtRojo">Clase</span> Personalizada</h3>
                        <p>Clase totalmente guiada por uno de nuestros entrenadores.</p>
                    </td>
                    <td>
                        <i class="fa-solid fa-dumbbell"></i>
                        <h3><span class="txtRojo">Clase</span> Estándar</h3>
                        <p>Obtén una rutina diseñada por nuestros entrenadores.</p>
                    </td>
                </tr>
            </table>
        </div>
    </section>

    <!-- SECCIÓN COMODIDADES -->
    <section id="comodidades" class="comodidades hidden">
        <div class="fila">
            <div class="col">
                <img src="/fitnessplus/images/nosotros.png" alt="Comodidades">
            </div>
            <div class="col">
                <div class="contenedor-titulo">
                    <div class="numero">03</div>
                    <div class="info">
                        <span class="frase">LA MEJOR EXPERIENCIA</span>
                        <h2>COMODIDADES</h2>
                    </div>
                </div>
                <p class="p-especial">Para mejorar tu experiencia, te ofrecemos:</p>
                <ul>
                    <li><span>Regaderas:</span> baños completamente equipados con agua caliente.</li>
                    <li><span>WiFi gratis:</span> conexión estable en todo el gimnasio.</li>
                    <li><span>Estacionamiento:</span> espacios limitados disponibles para nuestros clientes.</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- SECCIÓN GALERÍA -->
    <section id="galeria" class="galeria hidden">
        <div class="contenido-seccion">
            <div class="contenedor-titulo">
                <div class="numero">04</div>
                <div class="info">
                    <span class="frase">LA MEJOR EXPERIENCIA</span>
                    <h2>GALERÍA</h2>
                </div>
            </div>
            <div class="fila">
                <div class="col"><img src="/fitnessplus/images/f1.jpg" alt="Galería 1"></div>
                <div class="col"><img src="/fitnessplus/images/f2.jpg" alt="Galería 2"></div>
                <div class="col"><img src="/fitnessplus/images/f3.jpg" alt="Galería 3"></div>
            </div>
            <div class="fila">
                <div class="col"><img src="/fitnessplus/images/f4.jpg" alt="Galería 4"></div>
                <div class="col"><img src="/fitnessplus/images/f5.jpg" alt="Galería 5"></div>
                <div class="col"><img src="/fitnessplus/images/f6.jpg" alt="Galería 6"></div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN EQUIPO -->
    <section id="equipo" class="equipo hidden">
        <div class="contenido-seccion">
            <div class="contenedor-titulo">
                <div class="numero">05</div>
                <div class="info">
                    <span class="frase">NUESTRO EQUIPO</span>
                    <h2>ENTRENADORES</h2>
                </div>
            </div>
            <div class="fila">
                <?php foreach ($entrenadores as $entrenador): ?>
                    <div class="col">
                        <img src="/fitnessplus/uploads/<?php echo $entrenador['fotografia']; ?>" alt="Foto de <?php echo $entrenador['nombre']; ?>">
                        <div class="info">
                            <h2><?php echo $entrenador['nombre'] . ' ' . $entrenador['apellido']; ?></h2>
                            <p><?php echo $entrenador['especialidad']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php if (empty($entrenadores)): ?>
                <p>No hay entrenadores registrados.</p>
            <?php endif; ?>
        </div>
    </section>

<!-- SECCIÓN CONTACTO -->
<section id="contacto" class="contacto hidden">
    <div class="contenido-seccion">
        <div class="contenedor-titulo">
            <div class="numero">06</div>
            <div class="info">
                <span class="frase">CONTÁCTANOS</span>
                <h2>Información</h2>
            </div>
        </div>
        <!-- Dirección, Horarios y Correo -->
        <div class="fila">
        <div class="col">
                <h3>Dirección</h3>
                <p>5 de Mayo 108, Col. Centro, 38000 Celaya, Gto.</p>
            </div>
            <div class="col">
                <h3>Horarios</h3>
                <p>Lunes a Viernes: 6am - 10pm</p>
                <p>Sábados: 7am - 12pm</p>
            </div>
            <div class="col">
                <h3>Correo Electrónico</h3>
                <p>fitnessplus002@gmail.com</p>
            </div>
        </div>
        <!-- Mapa de Google Maps -->
        <div class="fila" style="margin-top: 20px;">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3736.544782972987!2d-100.81694262529881!3d20.52487920489534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842cba8effecfe77%3A0xfe25a07558221086!2sFitness%20Plus%20City!5e0!3m2!1ses!2smx!4v1732495911691!5m2!1ses!2smx"
                    width="100%" 
                    height="300" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
        </div>
    </div>
</section>

    <!-- SECCIÓN INICIAR SESIÓN -->
    <section id="iniciar-sesion" class="iniciar-sesion hidden">
        <a href="/fitnessplus/admin/login.php"></a>
    </section>
</body>
<script src="../../../js/app.js"></script>
</html>