<?php
session_start();

if (isset($_SESSION['login']) == false) {
  header("Location: ./login.php");
}

$id = $_SESSION['id'];
$user = $_SESSION['usuario'];
$name = $_SESSION['nombre'];


?>

<form id="datos_usuario">
  <input type="hidden" name="id" value="<?php echo $id; ?>">
  <input type="hidden" name="usuario" value="<?php echo $user; ?>">
  <input type="hidden" name="nombre" value="<?php echo $name; ?>">
</form>

<!doctype html>
<html lang="es">

<head>
  <title>Home - Mail</title>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="resoruces/bootstrap/css/bootstrap-pulse.min.css">
  <link rel="stylesheet" href="fa4/font-awesome.min.css">

  <link rel="stylesheet" href="resoruces/css/style.css">
</head>


<body>
  <div class="menu-usuario">
    <div class="list-group">
      <a href="#" class="list-group-item list-group-item-action">
        <i class="fa fa-user" aria-hidden="true"></i>
        <?php echo $user; ?>
      </a>
      <a href="php/logout.php" class="list-group-item list-group-item-action list-group-item-danger active">
        <div class="fa fa-times"></div>
        Cerrar sesion
      </a>
    </div>
  </div>

  <div class="redactar-msg">
    <div class="header-redactar">
      <div class="titulo">
        Mensaje nuevo
      </div>
      <div class="botones">
        <i class="fa fa-minus"></i>
        <i class="fa fa-times"></i>
      </div>
    </div>
    <div class="body-msg">
      <form id="enviar-mensaje">
        <div class="para">

          <div class="resultado-para">
            Para <input type="text" name="para" id="para" autocomplete="off" autocapitalize="none">
            <div class="resultados">

            </div>
          </div>

        </div>
        <div class="texto">
          <div class="texto-mensaje" contenteditable="true" hidefocus="true" spellcheck="false" aria-placeholder="Texto">
            <!-- TEXTO! -->
          </div>
        </div>
        <div class="botonera">
          <input type="submit" value="Enviar" class="btn btn-primary btn-enviar">
        </div>
      </form>
    </div>
  </div>

  <header>
    <div class="left">
      <div class="name-page">EMAIL</div>
      <i class="fa fa-navicon" aria-hidden="true"></i>
    </div>
    <div class="right">
      <div class="mensajes">
        <div class="cantidad">0</div>
        <i class="fa fa-envelope-o" aria-hidden="true"></i>
      </div>
      <div class="usuario">
        <i class="fa fa-user" aria-hidden="true"></i>
        <?php echo "$name [$id]"?>
      </div>
    </div>
  </header>
  <div class="contenedor">
    <div class="row">
      <div class="col-3">

        <div class="btn-redactar">
          <button type="button" class="btn from-top btn-primary btn-block text-uppercase">
            Redactar
          </button>
        </div>

        <div class="filtro">
          <table class="table table-hover">
            <tr id="mensajeria">
              <td>Mensajería</td>
              <td></td>
            </tr>
            <tr id="no-leidos">
              <td>No leídos</td>
              <td></td>
            </tr>
            <tr id="enviados">
              <td>Enviados</td>
              <td>1</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col contenido" id="contenedor">
        <?php include 'mensajeria.php' ?>
      </div>
    </div>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="resoruces/bootstrap/js/jquery-3.5.1.js">
  </script>
  <script src="resoruces/bootstrap/js/popper.min.js"></script>
  <script src="resoruces/bootstrap/js/bootstrap.min.js"></script>

  <script src="resoruces/js/script.js"></script>
</body>

</html>