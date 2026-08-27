/*====================================================
                SHOP SPORTS
====================================================*/

/*=========================================
        VARIABLES GLOBALES
=========================================*/

let tipoUsuario = "";
let carrito = [];
let totalCompra = 0;


/*=========================================
        MOSTRAR SECCIONES
=========================================*/

function ocultarTodo(){

    const secciones = [
        "login",
        "registro",
        "recuperar",
        "inicio",
        "productos",
        "carrito",
        "pago",
        "perfil",
        "vendedor",
        "inventario",
        "pedidos",
        "historial"
    ];

    secciones.forEach(function(id){

        const seccion = document.getElementById(id);

        if(seccion){

            seccion.style.display = "none";

        }

    });

}

function mostrarSeccion(id){

    ocultarTodo();

    const seccion = document.getElementById(id);

    if(seccion){

        seccion.style.display = "block";

    }

}


/*=========================================
        INICIAR PROYECTO
=========================================*/

document.addEventListener("DOMContentLoaded", function(){

    mostrarSeccion("login");

});


/*=========================================
            REGISTRO
=========================================*/

function registrarUsuario(){

    const tipo = document.getElementById("tipoUsuario").value;

    if(tipo == ""){

        alert("Seleccione un tipo de usuario.");

        return;

    }

    tipoUsuario = tipo;

    alert("Usuario registrado correctamente.");

    mostrarSeccion("login");

}


/*=========================================
            LOGIN
=========================================*/

function iniciarSesion(){

    const usuario = document.getElementById("usuario").value;

    if(usuario == ""){

        alert("Ingrese un usuario.");

        return;

    }

    if(tipoUsuario == "vendedor"){

        mostrarSeccion("vendedor");

    }else{

        mostrarSeccion("inicio");

    }

}
/*=========================================
        RECUPERAR CONTRASEÑA
=========================================*/

function recuperarPassword(){

    alert("Se envió un enlace de recuperación al correo.");

    mostrarSeccion("login");

}


/*=========================================
        CERRAR SESIÓN
=========================================*/

function cerrarSesion(){

    let respuesta = confirm("¿Desea cerrar sesión?");

    if(respuesta){

        tipoUsuario = "";
        carrito = [];
        totalCompra = 0;

        mostrarSeccion("login");

    }

}


/*=========================================
        AGREGAR AL CARRITO
=========================================*/

function agregarCarrito(nombre, precio){

    carrito.push({

        nombre: nombre,
        precio: precio

    });

    totalCompra += precio;

    alert(nombre + " agregado al carrito.");

}


/*=========================================
        VACIAR CARRITO
=========================================*/

function vaciarCarrito(){

    carrito = [];

    totalCompra = 0;

    alert("Carrito vaciado.");

}


/*=========================================
        IR A PAGO
=========================================*/

function irPago(){

    if(carrito.length == 0){

        alert("El carrito está vacío.");

        return;

    }

    mostrarSeccion("pago");

}


/*=========================================
        CONFIRMAR PAGO
=========================================*/

function confirmarPago(){

    alert("¡Compra realizada con éxito!");

    carrito = [];

    totalCompra = 0;

    mostrarSeccion("inicio");

}
/*=========================================
            PERFIL
=========================================*/

function actualizarPerfil(){

    alert("La información del perfil ha sido actualizada correctamente.");

}


/*=========================================
        PANEL DEL VENDEDOR
=========================================*/

function abrirInventario(){

    mostrarSeccion("inventario");

}

function abrirPedidos(){

    mostrarSeccion("pedidos");

}

function abrirHistorial(){

    mostrarSeccion("historial");

}

function volverPanel(){

    mostrarSeccion("vendedor");

}


/*=========================================
        INVENTARIO
=========================================*/

function agregarProducto(){

    alert("Producto agregado correctamente.");

}


/*=========================================
            PEDIDOS
=========================================*/

function actualizarEstado(){

    alert("El estado del pedido fue actualizado.");

}


/*=========================================
        HISTORIAL
=========================================*/

function generarReporte(){

    alert("Reporte generado correctamente.");

}