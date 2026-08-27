<?php

session_start();

/*====================================================
        COMPROBAR SESIÓN
=====================================================*/

$usuarioLogueado = isset($_SESSION['usuario']);

$nombreUsuario = "";
$tipoUsuario = "";

if ($usuarioLogueado) {

    $nombreUsuario = $_SESSION['nombre'];
    $tipoUsuario = $_SESSION['tipo_usuario'];

}


/*====================================================
        SECCIÓN SOLICITADA
=====================================================*/

$seccion = $_GET['seccion'] ?? "";


/*====================================================
        SECCIÓN INICIAL
=====================================================*/

if ($usuarioLogueado) {

    if ($tipoUsuario === "vendedor") {

        $seccionInicial = "vendedor";

    } else {

        $seccionInicial = "inicio";

    }

} else {

    $seccionInicial = "login";

}


/*====================================================
        CONTROL DE ACCESO
=====================================================*/

if (!$usuarioLogueado) {

    /*
     * Un usuario que no ha iniciado sesión
     * solamente puede ver estas secciones.
     */

    $seccionesPermitidas = [
        "login",
        "registro",
        "recuperar"
    ];

} elseif ($tipoUsuario === "vendedor") {

    /*
     * Secciones disponibles para vendedor.
     */

    $seccionesPermitidas = [
        "vendedor",
        "productos",
        "inventario",
        "pedidos",
        "historial"
    ];

} else {

    /*
     * Secciones disponibles para cliente.
     */

    $seccionesPermitidas = [
        "inicio",
        "productos",
        "carrito",
        "pago",
        "perfil"
    ];

}


/*====================================================
        DETERMINAR SECCIÓN A MOSTRAR
=====================================================*/

if ($seccion === "" || !in_array($seccion, $seccionesPermitidas)) {

    $seccion = $seccionInicial;

}

?>

<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Shop Sports</title>

    <link rel="stylesheet" href="estilo.css">

</head>

<body>


<!-- ==================================================
                    LOGIN
=================================================== -->

<section id="login"
style="<?php echo $seccion === 'login' ? 'display:block;' : 'display:none;'; ?>">

    <img src="img/logo.png" class="logo" alt="Logo Shop Sports">

    <h1>Shop Sports</h1>

    <h2>Iniciar Sesión</h2>

    <form action="login.php" method="POST">

        <label for="usuario">Nombre de usuario</label>

        <input
            type="text"
            id="usuario"
            name="usuario"
            placeholder="Ingrese su usuario"
            required>

        <label for="password">Contraseña</label>

        <input
            type="password"
            id="password"
            name="password"
            placeholder="Ingrese su contraseña"
            required>

        <a
            href="index.php?seccion=recuperar"
            class="olvide">

            ¿Olvidó su contraseña?

        </a>

        <button
            type="submit"
            class="ingresar">

            Ingresar

        </button>

    </form>

    <a
        href="index.php?seccion=registro"
        class="registrarse">

        Registrarse

    </a>

</section>


<!-- ==================================================
                    REGISTRO
=================================================== -->

<section id="registro"
style="<?php echo $seccion === 'registro' ? 'display:block;' : 'display:none;'; ?>">

    <div class="registro">

        <img src="img/logo.png" class="logo" alt="Logo Shop Sports">

        <h1>Shop Sports</h1>

        <h2>Registro de Usuario</h2>

        <form action="registro.php" method="POST">

            <label for="nombre">Nombre</label>

            <input
                type="text"
                id="nombre"
                name="nombre"
                placeholder="Ingrese su nombre"
                required>

            <label for="apellido">Apellido</label>

            <input
                type="text"
                id="apellido"
                name="apellido"
                placeholder="Ingrese su apellido"
                required>

            <label for="correo">Correo electrónico</label>

            <input
                type="email"
                id="correo"
                name="correo"
                placeholder="Ingrese su correo electrónico"
                required>

            <label for="usuarioRegistro">Nombre de usuario</label>

            <input
                type="text"
                id="usuarioRegistro"
                name="usuario"
                placeholder="Ingrese su usuario"
                required>

            <label for="passwordRegistro">Contraseña</label>

            <input
                type="password"
                id="passwordRegistro"
                name="password"
                placeholder="Ingrese su contraseña"
                required>

            <label for="confirmar_password">Confirmar contraseña</label>

            <input
                type="password"
                id="confirmar_password"
                name="confirmar_password"
                placeholder="Confirme su contraseña"
                required>

            <label for="tipo_usuario">Tipo de usuario</label>

            <select
                id="tipo_usuario"
                name="tipo_usuario"
                required>

                <option value="">Seleccione...</option>

                <option value="cliente">
                    Cliente
                </option>

                <option value="administrador">
                    Administrador
                </option>

            </select>

            <button
                type="submit"
                class="btnRegistro">

                Registrarse

            </button>

        </form>

        <a
            href="index.php?seccion=login"
            class="volver">

            Volver al Login

        </a>

    </div>

</section>


<!-- ==================================================
            RECUPERAR CONTRASEÑA
=================================================== -->

<section id="recuperar"
style="<?php echo $seccion === 'recuperar' ? 'display:block;' : 'display:none;'; ?>">

    <div class="recuperar">

        <img src="img/logo.png" class="logo" alt="Logo Shop Sports">

        <h1>Shop Sports</h1>

        <h2>Recuperar contraseña</h2>

        <p class="mensaje">

            Ingresa el correo electrónico con el que te registraste.

        </p>

        <form method="POST">

            <label for="correoRecuperar">
                Correo electrónico
            </label>

            <input
                type="email"
                id="correoRecuperar"
                name="correo"
                required>

            <button
                type="submit"
                class="btnEnviar">

                Enviar enlace

            </button>

        </form>

        <a
            href="index.php?seccion=login"
            class="volver">

            Volver al Login

        </a>

    </div>

</section>


<!-- ==================================================
                        INICIO
=================================================== -->

<section id="inicio"
style="<?php echo $seccion === 'inicio' ? 'display:block;' : 'display:none;'; ?>">

    <header>

        <h1>🏆 Shop Sports</h1>

        <nav>

            <ul>

                <li>
                    <a href="index.php?seccion=inicio">
                        Inicio
                    </a>
                </li>

                <li>
                    <a href="index.php?seccion=productos">
                        Productos
                    </a>
                </li>

                <li>
                    <a href="index.php?seccion=carrito">
                        Carrito
                    </a>
                </li>

                <li>
                    <a href="index.php?seccion=perfil">
                        Mi Perfil
                    </a>
                </li>

                <li>
                    <a href="cerrar_sesion.php">
                        Cerrar sesión
                    </a>
                </li>

            </ul>

        </nav>

    </header>


    <div class="banner">

        <h2>¡Bienvenido a Shop Sports!</h2>

        <p>
            Encuentra los mejores artículos deportivos al mejor precio.
        </p>

    </div>


    <div class="busqueda">

        <input
            type="text"
            placeholder="Buscar productos...">

        <button>
            Buscar
        </button>

    </div>


    <div class="categorias">

        <div class="categoria">
            Fútbol
        </div>

        <div class="categoria">
            Baloncesto
        </div>

        <div class="categoria">
            Running
        </div>

        <div class="categoria">
            Gimnasio
        </div>

    </div>


    <div class="productos">

        <div class="producto">

            <img src="img/balon.jpg" alt="Balón">

            <h3>Balón Profesional</h3>

            <p>$120.000</p>

            <a
                href="index.php?seccion=carrito"
                class="boton">

                Agregar al carrito

            </a>

        </div>


        <div class="producto">

            <img src="img/guayos.jpg" alt="Guayos">

            <h3>Guayos Nike</h3>

            <p>$350.000</p>

            <a
                href="index.php?seccion=carrito"
                class="boton">

                Agregar al carrito

            </a>

        </div>


        <div class="producto">

            <img src="img/mancuernas.jpg" alt="Mancuernas">

            <h3>Mancuernas</h3>

            <p>$180.000</p>

            <a
                href="index.php?seccion=carrito"
                class="boton">

                Agregar al carrito

            </a>

        </div>

    </div>


    <footer>

        <p>
            © 2026 Shop Sports - Todos los derechos reservados.
        </p>

    </footer>

</section>


<!-- ==================================================
                    PRODUCTOS
=================================================== -->

<section id="productos"
style="<?php echo $seccion === 'productos' ? 'display:block;' : 'display:none;'; ?>">

    <header>

        <h1>🏆 Shop Sports</h1>

        <nav>

            <ul>

                <?php if ($tipoUsuario === "vendedor") { ?>

                    <li>
                        <a href="index.php?seccion=vendedor">
                            Panel
                        </a>
                    </li>

                <?php } else { ?>

                    <li>
                        <a href="index.php?seccion=inicio">
                            Inicio
                        </a>
                    </li>

                    <li>
                        <a href="index.php?seccion=carrito">
                            Carrito
                        </a>
                    </li>

                    <li>
                        <a href="index.php?seccion=perfil">
                            Mi Perfil
                        </a>
                    </li>

                <?php } ?>

                <li>
                    <a href="cerrar_sesion.php">
                        Cerrar sesión
                    </a>
                </li>

            </ul>

        </nav>

    </header>


    <h2 class="titulo-catalogo">
        Catálogo de Productos
    </h2>


    <div class="catalogo">

        <div class="producto">

            <img src="img/balon.jpg" alt="Balón">

            <h3>Balón Profesional</h3>

            <p>$120.000</p>

            <a
                href="<?php echo $tipoUsuario === 'vendedor'
                    ? 'index.php?seccion=productos'
                    : 'index.php?seccion=carrito'; ?>"
                class="boton">

                <?php
                echo $tipoUsuario === "vendedor"
                    ? "Gestionar"
                    : "Agregar al carrito";
                ?>

            </a>

        </div>


        <div class="producto">

            <img src="img/guayos.jpg" alt="Guayos">

            <h3>Guayos Nike</h3>

            <p>$350.000</p>

            <a
                href="<?php echo $tipoUsuario === 'vendedor'
                    ? 'index.php?seccion=productos'
                    : 'index.php?seccion=carrito'; ?>"
                class="boton">

                <?php
                echo $tipoUsuario === "vendedor"
                    ? "Gestionar"
                    : "Agregar al carrito";
                ?>

            </a>

        </div>


        <div class="producto">

            <img src="img/mancuernas.jpg" alt="Mancuernas">

            <h3>Mancuernas</h3>

            <p>$180.000</p>

            <a
                href="<?php echo $tipoUsuario === 'vendedor'
                    ? 'index.php?seccion=productos'
                    : 'index.php?seccion=carrito'; ?>"
                class="boton">

                <?php
                echo $tipoUsuario === "vendedor"
                    ? "Gestionar"
                    : "Agregar al carrito";
                ?>

            </a>

        </div>

    </div>


    <footer>

        <p>
            © 2026 Shop Sports - Todos los derechos reservados.
        </p>

    </footer>

</section>


<!-- ==================================================
                    CARRITO
=================================================== -->

<section id="carrito"
style="<?php echo $seccion === 'carrito' ? 'display:block;' : 'display:none;'; ?>">

    <header>

        <h1>🏆 Shop Sports</h1>

        <nav>

            <ul>

                <li>
                    <a href="index.php?seccion=inicio">
                        Inicio
                    </a>
                </li>

                <li>
                    <a href="index.php?seccion=productos">
                        Productos
                    </a>
                </li>

                <li>
                    <a href="index.php?seccion=perfil">
                        Mi Perfil
                    </a>
                </li>

                <li>
                    <a href="cerrar_sesion.php">
                        Cerrar sesión
                    </a>
                </li>

            </ul>

        </nav>

    </header>


    <section class="carrito">

        <h2>Carrito de Compras</h2>

        <table>

            <tr>

                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>

            </tr>

            <tr>

                <td>Balón Profesional</td>
                <td>1</td>
                <td>$120.000</td>

            </tr>

        </table>


        <div class="botones-carrito">

            <a
                href="index.php?seccion=carrito"
                class="vaciar">

                Vaciar carrito

            </a>

            <a
                href="index.php?seccion=pago"
                class="comprar">

                Finalizar compra

            </a>

        </div>

    </section>


    <footer>

        <p>
            © 2026 Shop Sports - Todos los derechos reservados.
        </p>

    </footer>

</section>


<!-- ==================================================
                        PAGO
=================================================== -->

<section id="pago"
style="<?php echo $seccion === 'pago' ? 'display:block;' : 'display:none;'; ?>">

    <header>

        <h1>🏆 Shop Sports</h1>

        <nav>

            <ul>

                <li>
                    <a href="index.php?seccion=inicio">
                        Inicio
                    </a>
                </li>

                <li>
                    <a href="index.php?seccion=productos">
                        Productos
                    </a>
                </li>

                <li>
                    <a href="index.php?seccion=carrito">
                        Carrito
                    </a>
                </li>

                <li>
                    <a href="index.php?seccion=perfil">
                        Mi Perfil
                    </a>
                </li>

                <li>
                    <a href="cerrar_sesion.php">
                        Cerrar sesión
                    </a>
                </li>

            </ul>

        </nav>

    </header>


    <section class="pago">

        <h2>Finalizar Compra</h2>

        <form method="POST">

            <label>Nombre del titular</label>

            <input
                type="text"
                placeholder="Ingrese el nombre del titular"
                required>


            <label>Número de tarjeta</label>

            <input
                type="text"
                placeholder="1234 5678 9012 3456"
                required>


            <label>Fecha de vencimiento</label>

            <input
                type="month"
                required>


            <label>CVV</label>

            <input
                type="password"
                maxlength="3"
                placeholder="123"
                required>


            <label>Dirección de envío</label>

            <textarea
                rows="4"
                placeholder="Ingrese la dirección de entrega"
                required></textarea>


            <label>Método de pago</label>

            <select required>

                <option value="">
                    Seleccione una opción
                </option>

                <option>
                    Tarjeta Crédito
                </option>

                <option>
                    Tarjeta Débito
                </option>

                <option>
                    PSE
                </option>

                <option>
                    Nequi
                </option>

                <option>
                    Daviplata
                </option>

            </select>


            <button
                type="submit"
                class="btnPagar">

                Confirmar Pago

            </button>

        </form>

    </section>


    <footer>

        <p>
            © 2026 Shop Sports - Todos los derechos reservados.
        </p>

    </footer>

</section>


<!-- ==================================================
                        PERFIL
=================================================== -->

<section id="perfil"
style="<?php echo $seccion === 'perfil' ? 'display:block;' : 'display:none;'; ?>">

    <header>

        <h1>🏆 Shop Sports</h1>

        <nav>

            <ul>

                <li>
                    <a href="index.php?seccion=inicio">
                        Inicio
                    </a>
                </li>

                <li>
                    <a href="index.php?seccion=productos">
                        Productos
                    </a>
                </li>

                <li>
                    <a href="index.php?seccion=carrito">
                        Carrito
                    </a>
                </li>

                <li>
                    <a href="cerrar_sesion.php">
                        Cerrar sesión
                    </a>
                </li>

            </ul>

        </nav>

    </header>


    <section class="perfil">

        <h2>Mi Perfil</h2>

        <img
            src="img/perfil.png"
            class="fotoPerfil"
            alt="Foto de perfil">


        <label>Nombre</label>

        <input
            type="text"
            value="Juan Pérez">


        <label>Correo electrónico</label>

        <input
            type="email"
            value="juan@email.com">


        <label>Contraseña</label>

        <input
            type="password"
            value="123456">


        <button
            class="btnActualizar"
            type="button">

            Actualizar información

        </button>

    </section>


    <footer>

        <p>
            © 2026 Shop Sports - Todos los derechos reservados.
        </p>

    </footer>

</section>


<!-- ==================================================
                PANEL DEL VENDEDOR
=================================================== -->

<section id="vendedor"
style="<?php echo $seccion === 'vendedor' ? 'display:block;' : 'display:none;'; ?>">

    <header>

        <h1>🏆 Shop Sports</h1>

        <nav>

            <ul>

                <li>
                    <a href="index.php?seccion=vendedor">
                        Panel
                    </a>
                </li>

                <li>
                    <a href="cerrar_sesion.php">
                        Cerrar sesión
                    </a>
                </li>

            </ul>

        </nav>

    </header>


    <section class="panel-vendedor">

        <h2>Panel del Vendedor</h2>

        <p>
            Bienvenido.
            Selecciona una opción para administrar la tienda.
        </p>


        <div class="opciones-vendedor">

            <div class="opcion">

                <h3>📦 Productos</h3>

                <p>
                    Agregar, editar y eliminar productos.
                </p>

                <a
                    href="index.php?seccion=productos"
                    class="boton">

                    Gestionar

                </a>

            </div>


            <div class="opcion">

                <h3>📋 Inventario</h3>

                <p>
                    Consultar existencias disponibles.
                </p>

                <a
                    href="index.php?seccion=inventario"
                    class="boton">

                    Abrir

                </a>

            </div>


            <div class="opcion">

                <h3>🛒 Pedidos</h3>

                <p>
                    Consultar pedidos realizados.
                </p>

                <a
                    href="index.php?seccion=pedidos"
                    class="boton">

                    Ver pedidos

                </a>

            </div>


            <div class="opcion">

                <h3>📈 Historial</h3>

                <p>
                    Consultar ventas realizadas.
                </p>

                <a
                    href="index.php?seccion=historial"
                    class="boton">

                    Ver historial

                </a>

            </div>

        </div>

    </section>


    <footer>

        <p>
            © 2026 Shop Sports - Todos los derechos reservados.
        </p>

    </footer>

</section>


<!-- ==================================================
                    INVENTARIO
=================================================== -->

<section id="inventario"
style="<?php echo $seccion === 'inventario' ? 'display:block;' : 'display:none;'; ?>">

    <header>

        <h1>🏆 Shop Sports</h1>

        <nav>

            <ul>

                <li>
                    <a href="index.php?seccion=vendedor">
                        Panel
                    </a>
                </li>

                <li>
                    <a href="cerrar_sesion.php">
                        Cerrar sesión
                    </a>
                </li>

            </ul>

        </nav>

    </header>


    <section class="inventario">

        <h2>Inventario</h2>

        <table>

            <tr>

                <th>Producto</th>
                <th>Stock</th>
                <th>Precio</th>

            </tr>

            <tr>

                <td>Balón Profesional</td>
                <td>15</td>
                <td>$120.000</td>

            </tr>

            <tr>

                <td>Guayos Nike</td>
                <td>8</td>
                <td>$350.000</td>

            </tr>

        </table>


        <button
            class="agregarProducto"
            type="button">

            Agregar Producto

        </button>

    </section>


    <footer>

        <p>
            © 2026 Shop Sports - Todos los derechos reservados.
        </p>

    </footer>

</section>


<!-- ==================================================
                    PEDIDOS
=================================================== -->

<section id="pedidos"
style="<?php echo $seccion === 'pedidos' ? 'display:block;' : 'display:none;'; ?>">

    <header>

        <h1>🏆 Shop Sports</h1>

        <nav>

            <ul>

                <li>
                    <a href="index.php?seccion=vendedor">
                        Panel
                    </a>
                </li>

                <li>
                    <a href="cerrar_sesion.php">
                        Cerrar sesión
                    </a>
                </li>

            </ul>

        </nav>

    </header>


    <section class="pedidos">

        <h2>Pedidos</h2>

        <table>

            <tr>

                <th>Pedido</th>
                <th>Cliente</th>
                <th>Estado</th>

            </tr>

            <tr>

                <td>#001</td>
                <td>Juan Pérez</td>
                <td>Pendiente</td>

            </tr>

        </table>


        <button
            class="actualizarEstado"
            type="button">

            Actualizar Estado

        </button>

    </section>


    <footer>

        <p>
            © 2026 Shop Sports - Todos los derechos reservados.
        </p>

    </footer>

</section>


<!-- ==================================================
                HISTORIAL DE VENTAS
=================================================== -->

<section id="historial"
style="<?php echo $seccion === 'historial' ? 'display:block;' : 'display:none;'; ?>">

    <header>

        <h1>🏆 Shop Sports</h1>

        <nav>

            <ul>

                <li>
                    <a href="index.php?seccion=vendedor">
                        Panel
                    </a>
                </li>

                <li>
                    <a href="cerrar_sesion.php">
                        Cerrar sesión
                    </a>
                </li>

            </ul>

        </nav>

    </header>


    <section class="historial">

        <h2>Historial de Ventas</h2>

        <table>

            <tr>

                <th>Fecha</th>
                <th>Producto</th>
                <th>Total</th>

            </tr>

            <tr>

                <td>05/07/2026</td>
                <td>Balón Profesional</td>
                <td>$120.000</td>

            </tr>

        </table>


        <button
            class="btnReporte"
            type="button">

            Generar Reporte

        </button>

    </section>


    <footer>

        <p>
            © 2026 Shop Sports - Todos los derechos reservados.
        </p>

    </footer>

</section>


</body>

</html>