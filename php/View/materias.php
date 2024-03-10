<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="../../css/nav_style.css" />
    <link href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet" />

    <title>Materiales</title>
</head>

<body>
    <nav>
        <i class="bi bi-list menu-icon" style="font-size: 2.4rem"></i>

        <div class="navbar-left">
            <img src="../../img/dark_large_logo.png" alt="logo" class="logo" />
            <ul>
                <li><a href="./profesores.php">Profesores</a></li>
                <li><a href="./materias.php" class="nav_item_selected">Materias</a></li>
                <li><a href="./cursos.php">Cursos</a></li>
                <li><a href="">Horarios</a></li>
                <li><a href="./periodo_lectivo.php">Periodos</a></li>
            </ul>
        </div>

        <div class="navbar-right">
            <ul>
                <li class="navbar-email">
                    acalodeveloper@gmail.com
                    <i class="bi bi-caret-right flecha-email rotate"></i>
                    <div class="desktop-menu inactive">
                        <ul>
                            <li>
                                <a href="/" class="title">Perfil</a>
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
                    <li><a href="./profesores.php">Profesores</a></li>
                    <li><a href="">Toys</a></li>
                    <li><a href="">Others</a></li>
                </ul>

                <ul>
                    <li><a href="">Perfil</a></li>
                </ul>
            </div>

            <ul class="mobile-footer">
                <li><a href="" class="email">acalodeveloper@gmail.com</a></li>
                <li><a href="" class="sign-out">Sign out</a></li>
            </ul>
        </div>
    </nav>
    <div class="principal_container">
        <div class="mt-6">
            <div id="resultado_response" class="border p-2 bg-opacity-25 fw-bold rounded display_none"></div>

            <div class="mx-auto mt-3 p-0" style="width: 90%;max-width:700px;">
                <div class="bg-primary p-3 rounded d-flex flex-wrap justify-content-center align-items-center w-100">
                    <div class="bg-light py-1 px-4 rounded text-center max-width-max-content m-auto">
                        <h2 class="max-width-max-content">Administración de Materias</h2>
                    </div>
                </div>
                <div class="card mb-3 w-100">
                    <div class="card-body">
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-light">
                                <h5>Nueva Materia</h5>
                            </div>
                            <div class="card-body">
                                <form onsubmit="event.preventDefault()" method="post">
                                    <div class="input-group">
                                        <label for="nombre" class="input-group-text bg-primary text-light fw-bold">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Métodos numéricos">
                                        <button type="button" class="btn btn-primary" id="ingresarNuevaMateriaButton" onclick="nuevaMateria()" disabled>
                                            Ingresar
                                        </button>
                                        <div class="valid-feedback">
                                            <!-- Looks good! -->
                                        </div>
                                        <div class="invalid-feedback">
                                            Este campo es obigatorio.<br>
                                            Solo se aceptan caracteres alfabéticos.
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="overflow-auto materias_table">
                            <table class="table-primary">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Nombre</th>
                                        <th>OP</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_profesores">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../js/nav_script.js"></script>
    <script src="../../js/validations.js"></script>
    <script src="../../js/materias.js"></script>

</body>

</html>