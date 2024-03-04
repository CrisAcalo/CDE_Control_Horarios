<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Control de Horarios</title>
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/nav_style.css" />
  <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet" />
</head>

<body>
  <div class="main_container">
    <nav>
      <i class="bi bi-list menu-icon" style="font-size: 2.4rem"></i>

      <div class="navbar-left">
        <img src="../img/dark_large_logo.png" alt="logo" class="logo" />
        <ul>
          <li><a href="../php/View/profesores.php">Profesores</a></li>
          <li><a href="../php/View/materias.php" target="content">Materias</a></li>
          <li><a href="" target="content">Cursos</a></li>
          <li><a href="" target="content">Horarios</a></li>
        </ul>
      </div>

      <div class="navbar-right">
        <ul>
          <li class="navbar-email">
            acalodeveloper@gmail.com
            <img src="../Icons/flechita.svg" alt="arrow" class="flecha-email rotate" />
            <div class="desktop-menu inactive">
              <ul>
                <li>
                  <a href="/" class="title">My orders</a>
                </li>
                <li>
                  <a href="/" class="title">My orders</a>
                </li>
                <li>
                  <a href="/" class="title">Sign out</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
      <div class="mobile-menu_inactive-background inactive-mobile_menu"></div>
      <div class="mobile-menu inactive-mobile_menu">
        <div class="personal-container">
          <ul>
            <li><a href="">CATEGORIES</a></li>
            <li><a href="">All</a></li>
            <li><a href="">Clothes</a></li>
            <li><a href="">Electonics</a></li>
            <li><a href="">Furnitures</a></li>
            <li><a href="">Toys</a></li>
            <li><a href="">Others</a></li>
          </ul>

          <ul>
            <li><a href="">My orders</a></li>
            <li><a href="">My account</a></li>
          </ul>
        </div>

        <ul class="mobile-footer">
          <li><a href="" class="email">acalodeveloper@gmail.com</a></li>
          <li><a href="" class="sign-out">Sign out</a></li>
        </ul>
      </div>
    </nav>

    <main class="iframe_container">
      <!-- <iframe src="" id="iframe_content" name="content" class="p-2"></iframe> -->
      <!-- <div class="sections_content">
          <div class="container_materias container_bordered" id="left">
            <div class="element_draggable" draggable="true">
              <i class="bi bi-grip-horizontal"></i>
              <span>xd</span>
            </div>
            <div class="element_draggable" draggable="true">
              <i class="bi bi-grip-horizontal"></i>
              <span>dx</span>
            </div>
            <div class="element_draggable" draggable="true">
              <i class="bi bi-grip-horizontal"></i>
              <span>xdn't</span>
            </div>
            <div class="element_draggable" draggable="true">
              <i class="bi bi-grip-horizontal"></i>
              <span>dxn't</span>
            </div>
            <div class="element_draggable" draggable="true">
              <i class="bi bi-grip-horizontal"></i>
              <span>a</span>
            </div>
          </div>
          <div class="container_destino container_bordered" id="right"></div>
        </div> -->
    </main>
  </div>
  <script src="../js/nav_script.js"></script>
  <script>
    let elements = document.getElementsByClassName("element_draggable");
    let rightContainer = document.getElementById("right");
    let leftContainer = document.getElementById("left");

    for (element of elements) {
      element.addEventListener("dragstart", function(e) {
        let selected = e.target;
        selected.classList.add("element_dragging"); // Agrega la clase al elemento arrastrado

        rightContainer.addEventListener("dragover", function(e) {
          e.preventDefault();
        });

        rightContainer.addEventListener("drop", function(e) {
          rightContainer.appendChild(selected);
          selected.classList.remove("element_dragging"); // Quita la clase al soltar el elemento
          selected = null;
        });

        leftContainer.addEventListener("dragover", function(e) {
          e.preventDefault();
        });

        leftContainer.addEventListener("drop", function(e) {
          leftContainer.appendChild(selected);
          selected.classList.remove("element_dragging"); // Quita la clase al soltar el elemento
          selected = null;
        });
      });
    }
  </script>
</body>

</html>