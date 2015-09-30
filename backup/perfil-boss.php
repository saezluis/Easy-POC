<?php
  session_start();

  if(!isset($_SESSION['username'])){
    header("location:login.php");
  }
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <title> </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximun-scale=1">
    <link rel="stylesheet" href="tema/css/estilos.css">
    <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="tema/js/scripts.js"></script>
    <link rel="stylesheet" href="tema/js/source/jquery.fancybox.css?v=2.1.5">
    <script src="tema/js/source/jquery.fancybox.pack.js?v=2.1.5"></script>
  </head>
  <body>
    <header class="grupo">
      <div class="caja base-50 no-padding">
        <h1> <a href="#" class="logo"> <img src="tema/img/logo.jpg" alt="POC"></a></h1>
      </div>
      <div class="caja base-50 no-padding">
        <nav>
          <ul>
            <li> <a href="index.html">Emisor de ódenes de compra</a></li>
            <li> <a href="#" class="active">Perfil</a></li>
          </ul>
        </nav>
        <div class="counter">15</div>
      </div>
      <div class="caja base-100 no-padding">
        <h2>En esta sección podrás encontrar el historial de todas tus órdenes de compra emitidas.</h2>
      </div>
    </header>
    <div id="data--input" class="grupo">
      <h3>Mis órdenes de compra</h3>
    </div>
    <div id="buscar" class="grupo">
      <div class="caja-80">
        <form id="" method="" action="" class="seek"> 
          <input type="search" placeholder="ingresa número de OC">
          <button type="button" value="buscar OC">buscar</button>
        </form>
      </div>
    </div>
    <div id="campana" class="grupo">
      <div class="caja-100">
        <div id="tabla">
          <div id="titulo--orden-1">Nº de OC</div>
          <div id="titulo--orden-2">Fecha</div>
          <div id="titulo--orden-3">Detalle</div>
          <div id="titulo--orden-4">OC SAP</div>
          <div id="titulo--orden-5">OC RECEPCIÓN</div>
          <div id="titulo--orden-6T"> <img src="tema/img/time.gif" alt=""></div>
          <div id="titulo--orden-6S">VºBº</div>
        </div>
        <div id="tabla">
          <div id="orden--1">xxx-xxx-xxx</div>
          <div id="orden--2">xxx-xxx-xxx</div>
          <div id="orden--3"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. </div>
          <div id="orden--4">xxx-xxx-xxx<span class="yes"><img src="tema/img/yes.gif" alt=""></span></div>
          <div id="orden--5">xxx-xxx-xxx<span class="no"><img src="tema/img/no.gif" alt=""></span></div>
          <div id="orden--6T">3 días</div>
          <div id="orden--6S">
            <form class="choose">
              <select name="revision" form="revision" class="select-choose">
                <option value="si">Elija</option>
                <option value="si">Si</option>
                <option value="no">No</option>
              </select>
            </form>
          </div>
        </div>
        <div id="tabla">
          <div id="orden--1">xxx-xxx-xxx</div>
          <div id="orden--2">xxx-xxx-xxx</div>
          <div id="orden--3"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. </div>
          <div id="orden--4">xxx-xxx-xxx<span class="yes"><img src="tema/img/yes.gif" alt=""></span><span class="edit"></span></div>
          <div id="orden--5">xxx-xxx-xxx<span class="no"><img src="tema/img/no.gif" alt=""></span></div>
          <div id="orden--6T">3 días</div>
          <div id="orden--6S">
            <form class="choose">
              <select name="revision" form="revision">
                <option value="si">Elija</option>
                <option value="si">Si</option>
                <option value="no">No</option>
              </select>
            </form>
          </div>
        </div>
        <div id="tabla">
          <div id="orden--1">xxx-xxx-xxx</div>
          <div id="orden--2">xxx-xxx-xxx</div>
          <div id="orden--3"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. </div>
          <div id="orden--4">xxx-xxx-xxx<span class="yes"><img src="tema/img/yes.gif" alt=""></span></div>
          <div id="orden--5">xxx-xxx-xxx<span class="no"><img src="tema/img/no.gif" alt=""></span></div>
          <div id="orden--6T">3 días</div>
          <div id="orden--6S"> 
            <form class="choose">
              <select name="revision" form="revision">
                <option value="si">Elija</option>
                <option value="si">Si</option>
                <option value="no">No</option>
              </select>
            </form>
          </div>
        </div>
        <div id="tabla">
          <div id="orden--1">xxx-xxx-xxx</div>
          <div id="orden--2">xxx-xxx-xxx</div>
          <div id="orden--3"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. </div>
          <div id="orden--4">xxx-xxx-xxx<span class="yes"><img src="tema/img/yes.gif" alt=""></span></div>
          <div id="orden--5">xxx-xxx-xxx<span class="no"><img src="tema/img/no.gif" alt=""></span></div>
          <div id="orden--6T">3 días</div>
          <div id="orden--6S">
            <form class="choose">
              <select name="revision" form="revision">
                <option value="si">Elija</option>
                <option value="si">Si</option>
                <option value="no">No</option>
              </select>
            </form>
          </div>
        </div>
        <div id="tabla">
          <div id="orden--1">xxx-xxx-xxx</div>
          <div id="orden--2">xxx-xxx-xxx</div>
          <div id="orden--3"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. </div>
          <div id="orden--4">xxx-xxx-xxx<span class="yes"><img src="tema/img/yes.gif" alt=""></span></div>
          <div id="orden--5">xxx-xxx-xxx<span class="no"><img src="tema/img/no.gif" alt=""></span></div>
          <div id="orden--6T">3 días</div>
          <div id="orden--6S">
            <form class="choose">
              <select name="revision" form="revision">
                <option value="si">Elija</option>
                <option value="si">Si</option>
                <option value="no">No</option>
              </select>
            </form>
          </div>
        </div>
        <div id="tabla">
          <div id="orden--1">xxx-xxx-xxx</div>
          <div id="orden--2">xxx-xxx-xxx</div>
          <div id="orden--3"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. </div>
          <div id="orden--4">xxx-xxx-xxx<span class="yes"><img src="tema/img/yes.gif" alt=""></span></div>
          <div id="orden--5">xxx-xxx-xxx<span class="no"><img src="tema/img/no.gif" alt=""></span></div>
          <div id="orden--6T">3 días</div>
          <div id="orden--6S">
            <form class="choose">
              <select name="revision" form="revision">
                <option value="si">Elija</option>
                <option value="si">Si</option>
                <option value="no">No</option>
              </select>
            </form>
          </div>
        </div>
        <div id="tabla">
          <div id="orden--1">xxx-xxx-xxx</div>
          <div id="orden--2">xxx-xxx-xxx</div>
          <div id="orden--3"> Lorem ipsum dolor sit amet, consectetur adipisicing elit. </div>
          <div id="orden--4">xxx-xxx-xxx<span class="yes"><img src="tema/img/yes.gif" alt=""></span></div>
          <div id="orden--5">xxx-xxx-xxx<span class="no"><img src="tema/img/no.gif" alt=""></span></div>
          <div id="orden--6T">3 días</div>
          <div id="orden--6S">
            <form class="choose">
              <select name="revision" form="revision">
                <option value="si">Elija</option>
                <option value="si">Si</option>
                <option value="no">No</option>
              </select>
            </form>
          </div>
        </div>
      </div>
    </div>
	
	<a href="logout.php" >Logout</a>
	
    <div id="footer" class="total">
      <div class="grupo">
        <div id="logo-footer" class="caja-50"><img src="tema/img/logo-footer.png" alt=""></div>
        <div id="copy" class="caja-50">
          <p>© 2015 Easy S.A.</p>
        </div>
      </div>
    </div>
  </body>
</html>