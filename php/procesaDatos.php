<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>.:: Confirmación ::.</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
  <link rel="stylesheet" href="../Styles/global.css">
  <link rel="stylesheet" type="text/css" href="../styles/styles_form.css">
  <script src="../JavaScript/form.js"></script>
</head>

<body>
  <!--Navar-->
  <header >
        <nav class="navbar fixed-top navbar-bg  nav-masthead navbar-expand-lg navbar-dark p-md-3">
          <div class="container">
              <a href="#" class="navbar-brand">LU 2</a>
              <button
                  class="navbar-toggler"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#navbarNav"
                  aria-controls="navbarNav"
                  aria-expanded="false"
                  aria-label="Toggle navigation"
              >
              <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarNav">
                  <div class="mx-auto"></div>
                  <ul class="navbar-nav">
                      <li class="nav-item">
                          <a class="nav-link fw-bold" aria-current="page" href="../index.html">Home</a>
                      </li>
                      <li  class="nav-item">
                          <a class="nav-link fw-bold" href="../form.html">Contratación</a>
                      </li>
                      <li  class="nav-item">
                          <a class="nav-link fw-bold" href="../comprobante.html">Comprobante</a>
                      </li>
                      <li  class="nav-item">
                          <a class="nav-link fw-bold" href="../admin_login.html">Admin</a>
                      </li>

                  </ul>
              </div>
          </div>
          </nav>
    </header>

    <?php
        session_start();
        require 'conexionBD.php';

        function generarFolio($rfc, $fechaEvento) {
        $fechaSinGuiones = str_replace("-", "", $fechaEvento);
        
        $folio = $rfc . $fechaSinGuiones;
        
        return $folio;
        }  

        // Obtener los datos de sesión
        $nombre = $_SESSION['nombre'];
        $patern = $_SESSION['paterno'];
        $matern = $_SESSION['materno'];
        $telefono = $_SESSION['telefono'];
        $correo = $_SESSION['correo'];
        $calle = $_SESSION['calle'];
        $numeroDomicilio = $_SESSION['numero'];
        $colonia = $_SESSION['colonia'];
        $codigoPostal = $_SESSION['codigoPostal'];
        $entidad = $_SESSION['entidad'];
        $municipio = $_SESSION['municipio'];
        $nacimiento = $_SESSION['fechaNacimiento'];
        $rfc = $_SESSION['rfc'];
        $tipo = $_SESSION['tipo'];
        $salon = $_SESSION["salon"];
        $menu = $_SESSION["menu"];
        $numeroPersonas = $_SESSION["numPersonas"];
        $fecha = $_SESSION["fechaEvento"];
        $hora = $_SESSION["horaEvento"];
        $folio = generarFolio($rfc, $fecha);
        $botonConfirmacion = '<button type="submit">Generar PDF</button>';
        $botonModificar = '<button type="submit" onclick="window.history.back()">Modificar dato</button>';

        $registroCliente="INSERT INTO Cliente (RFC, Nombre, ApellidoPaterno, ApellidoMaterno, Calle, NumeroCasa, Colonia, CodigoPostal, EntidadFederativa, AlcaldiaMunicipio, Telefono, CorreoElectronico, FechaNacimiento) VALUES ('$rfc','$nombre','$patern','$matern','$calle','$numeroDomicilio','$colonia','$codigoPostal','$entidad','$municipio','$telefono','$correo','$nacimiento')";

        if($conexion->query($registroCliente)===TRUE){
            echo "Cliente registrado registroCliente";
        } else{
            echo "Error en la inserción: ".$conexion->error;
        }
        $registroContratacion="INSERT INTO Contratacion(Folio, RFCCliente, FechaEvento, Horario, TipoEvento, NumeroPersonas, SalonSeleccionado, MenuSeleccionado) VALUES ('$folio','$rfc','$fecha','$hora','$tipo','$numeroPersonas','$salon','$menu')";

        if($conexion->query($registroContratacion)===TRUE){
            echo "Contratación registrado correctamente";
        } else{
            echo "Error en la inserción: ".$conexion->error;
        }
        $conexion->close();
    ?>

<style>
   #pdf, #modificar{
        margin: 1%;
        width: 47%;
    }

    h1 {
        font-size: 24px;
        margin-top: 24px;
    }

    .contenedor {
        margin-top:20px;
        max-width: 600px;
        margin: 0 auto;
    }

    .button {
        background-color: #663399;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 18px;
        cursor: pointer;
        margin-top: 20px;
    }

    .button:hover {
        background-color: #4b0082;
    }
</style>
<div class="container" style="margin-top: 100px;">
    <div class="contenedor">
        <h1>Bienvenido Sr(a). <?php echo $nombre." ".$patern." ".$matern; ?></h1>
        <p>Verifica que los datos de tu contratación/reservación que ingresaste sean correctos:</p>
        <p>Tus datos son:</p>
        <ul>
            <li>Nombre: <?php echo $nombre; ?></li>
            <li>Apellido Paterno: <?php echo $patern; ?></li>
            <li>Apellido Materno: <?php echo $matern; ?></li>
            <li>Teléfono: <?php echo $telefono; ?></li>
            <li>Correo electrónico: <?php echo $correo; ?></li>
            <li>Domicilio: <?php echo $calle . ' ' . $numeroDomicilio . ', ' . $colonia . ', ' . $municipio . ', C.P. ' . $codigoPostal  . ', ' . $entidad  . ', México'; ?></li>
            <li>Fecha de nacimiento: <?php echo $nacimiento; ?></li>
            <li>Registro Federal de Contribuyente (RFC): <?php echo $rfc; ?></li>
        </ul>
            <p> Acerca del evento: </p>
        <ul>
            <li>Tipo de evento: <?php echo $tipo; ?></li>
            <li>Salón seleccionado: <?php echo $salon; ?></li>
            <li>Menú seleccionado: <?php echo $menu; ?></li>
            <li>Número de asistentes: <?php echo $numeroPersonas; ?></li>
            <li>Fecha en la que se celebrará el evento: <?php echo $fecha; ?></li>
            <li>Hora en la que se celebrará el evento: <?php echo $hora; ?></li>
        </ul>
        <p>Folio generado: <?php echo $folio; ?></p>
        <button type="submit" class="btn btn-outline-light" id="pdf" style="font-weight: bold;" onclick="window.location.href = 'GenerarPDF.html'">Generar PDF</button>
        <button type="submit" class="btn btn-outline-warning" id="modificar" style="font-weight: bold;" onclick="window.history.back()">Modificar datos</button>
    </div>
    <br><br>
    </div>
    <footer class="text-white pt-5 pb-4 ">
    <div class="container text-center text-md-start">
        <div class="row text-center text-md-start">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Nosotros</h5>
                <hr class="mb-4">
                <p>Somos una empresa de eventos sociales que ofrece servicios de DJ, salas de eventos y banquetes. Creamos experiencias memorables, reflejando la personalidad de nuestros clientes. Valoramos la ética, la excelencia y estamos orgullosos de formar parte de momentos especiales en la vida de las personas.</p>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3 ">
                <h5 class="text-uppercase mb-4 font-weight-bold">Dejanos ayudarte</h5>
                <hr class="mb-4">
                <p>
                    <a href="#">Home</a>
                </p>
                <p>
                    <a href="#">Contratación</a>
                </p>
                <p>
                    <a href="#">Tu comprobante</a>
                </p>
                <p>
                    <a href="#">Admin</a>
                </p>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold">Contactanos</h5>
                <hr class="mb-4">
                <p><li class="fas fa-home me-3"></li>Lindavista,G.A.M.,CDMX, México</p>
                <p><li class="fas fa-envelope me-3"></li>djlu2@gmail.com</p>
                <p><li class="fas fa-phone me-3"></li>+55 55 555 555</p>

            </div>
            <hr class="mb-4">
            <div class="text-center mb-2">
                <p>
                    Copyright Todos los derechos reservados
                </p>
            </div>
        </div>
    </div>
</footer>
<script src="Scripts/global.js"></script>  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>
