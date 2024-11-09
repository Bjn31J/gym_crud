<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/estilo.css">
    <title>FITNESS PLUS</title>
</head>
<body>
    <!-- MENU -->
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
                <a href="./admin/login.php" onclick="seleccionar()">Iniciar sesión</a>
            </nav>
            <!-- Icono del menu responsive -->
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
                <p>El empeño es la raíz del logro.</p>
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
    <section id="nosotros" class="nosotros">
        <div class="fila">
            <div class="col">
                <img src="./images/nosotros.png" alt="">
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
                    En nuestro gimnasio, nos enfocamos en brindarte una experiencia de entrenamiento integral y de alta calidad. 
                </p>
                <p>
                    Instalaciones de primer nivel y un equipo de profesionales apasionados y comprometidos con tu progreso...
                </p>
            </div>
        </div>
        <hr>
    </section>

    <!-- SECCIÓN SERVICIOS -->
    <section class="servicios" id="servicios">
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
                    <p class="p-especial">Conoce nuestros planes </p>
                    <p>Escoge tu plan de acuerdo a tus objetivos</p>
                </div>
                <div class="col">
                    <img src="./images/fondo-servicios.jpg" alt="">
                </div>
            </div>
        </div>
        <div class="info-servicios">
            <table>
                <tr>
                    <td>
                        <i class="fa-solid fa-person-walking"></i>
                        <h3><span class="txtRojo">Clase </span>Personalizada</h3>
                        <p>Clase totalmente guiada por uno de nuestros entrenadores</p>
                    </td>
                    <td>
                        <i class="fa-solid fa-dumbbell"></i>
                        <h3><span class="txtRojo">Clase </span>Estandar</h3>
                        <p>Uno de nuestros entrenadores te proporcionara rutina</p>
                    </td>
                </tr>
            </table>
        </div>
    </section>

    <!-- SECCIÓN COMODIDADES -->
    <section id="comodidades" class="comodidades">
        <div class="fila">
            <div class="col">
                <img src="./images/nosotros.png" alt="">
            </div>
            <div class="col">
                <div class="contenedor-titulo">
                    <div class="numero">03</div>
                    <div class="info">
                        <span class="frase">LA MEJOR EXPERIENCIA</span>
                        <h2>COMODIDADES</h2>
                    </div>
                </div>
                <p class="p-especial">Para mejorar tu experiencia te ofrecemos: </p>
                <ul>
                    <li><span>REGADERAS</span> Contamos con baños totalmente equipados y limpios así como agua caliente </li>
                    <li><span>WIFI GRATIS</span> Contamos con hotspots en todo el gimnasio para que tu red sea estable </li>
                    <li><span>ESTACIONAMIENTO GRATIS</span> Contamos con lugares de estacionamiento (Cupo limitado)</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- SECCIÓN GALERÍA -->
    <section class="galeria" id="galeria">
        <div class="contenido-seccion">
            <div class="contenedor-titulo">
                <div class="numero">04</div>
                <div class="info">
                    <span class="frase">LA MEJOR EXPERIENCIA</span>
                    <h2>GALERÍA</h2>
                </div>
            </div>
            <div class="fila">
                <div class="col"><img src="./images/f1.jpg" alt=""></div>
                <div class="col"><img src="./images/f2.jpg" alt=""></div>
                <div class="col"><img src="./images/f3.jpg" alt=""></div>
            </div>
            <div class="fila">
                <div class="col"><img src="./images/f4.jpg" alt=""></div>
                <div class="col"><img src="./images/f5.jpg" alt=""></div>
                <div class="col"><img src="./images/f6.jpg" alt=""></div>
            </div>
        </div>
    </section>
    
    <!-- SECCIÓN EQUIPO -->
    <section class="equipo" id="equipo">
        <div class="contenido-seccion">
            <div class="contenedor-titulo">
                <div class="numero">05</div>
                <div class="info">
                    <span class="frase">LA MEJOR EXPERIENCIA</span>
                    <h2>Entrenadores</h2>
                </div>
            </div>
            <div class="fila">
                <div class="col">
                    <img src="./images/e1.png" alt="">
                    <div class="info">
                        <h2>MARCOS</h2>
                        <p>Entrenador-FITNESSPLUSS</p>
                    </div>
                </div>
                <div class="col">
                    <img src="./images/e2.png" alt="">
                    <div class="info">
                        <h2>PATRICIA</h2>
                        <p>Entrenadora-FITNESSPLUSS</p>
                    </div>
                </div>
                <div class="col">
                    <img src="./images/e3.png" alt="">
                    <div class="info">
                        <h2>JUAN</h2>
                        <p>Entrenador-FITNESSPLUSS</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECCIÓN CONTACTO -->
    <section class="contacto" id="contacto">
        <div class="contenido-seccion">
            <div class="contenedor-titulo">
                <div class="numero">06</div>
                <div class="info">
                    <span class="frase">LA MEJOR EXPERIENCIA</span>
                    <h2>CONTACTO</h2>
                </div>
            </div>
            <div class="fila">
                <div class="col"><input type="text" placeholder="Ingrese Email"></div>
                <div class="col"><input type="text" placeholder="Ingrese Nombre"></div>
            </div>
            <div class="mensaje">
                <textarea cols="30" rows="10" placeholder="Ingresa el Mensaje"></textarea>
                <button>Enviar Mensaje</button>
            </div>
            <div class="fila-datos">
                <div class="col"><i class="fa-solid fa-location-dot"></i> Fitness Plus, 5 de Mayo 108, Col. Centro, 38000 Celaya, Gto.</div>
                <div class="col"><i class="fa-regular fa-clock"></i> Lunes a Sábado, 6:00h - 22:00h</div>
            </div>
        </div>
    </section>

    <footer>
        <div class="info">
            <p>2024 - <span class="txtRojo">FITNESS PLUS</span> Todos los derechos reservados</p>
        </div>
    </footer>
    <script src="./js/app.js"></script>
</body>
</html>
