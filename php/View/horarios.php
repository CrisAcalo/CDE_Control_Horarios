<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="../../css/nav_style.css" />
    <link href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../../node_modules/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet" />

    <title>Profesores</title>
</head>

<body>
    <nav>
        <i class="bi bi-list menu-icon" style="font-size: 2.4rem"></i>

        <div class="navbar-left">
            <img src="../../img/dark_large_logo.png" alt="logo" class="logo" />
            <ul>
                <li><a href="./profesores.php">Profesores</a></li>
                <li><a href="./materias.php">Materias</a></li>
                <li><a href="./cursos.php">Cursos</a></li>
                <li><a href="./horarios.php" class="nav_item_selected">Horarios</a></li>
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

            <div class="p-0 m-3 mx-auto" style="width: 100%;">
                <div class="bg-primary p-3 rounded d-flex flex-wrap justify-content-center align-items-center">
                    <div class="bg-light py-1 px-4 rounded text-center max-width-max-content m-auto">
                        <h2 class="max-width-max-content">Administración de Horarios</h2>
                    </div>
                    <button type="button" class="btn btn-success me-3 my-1 py-1 px-3 height-max-content fs-4" data-bs-toggle="modal" data-bs-target="#modal_nuevo">
                        <i class="bi bi-plus-square-dotted p-0 m-0"></i>
                    </button>
                </div>
                <div class="card">
                    <div class="card-body table_asignacion_horarios" style="max-height:calc(100vh - 195px)">
                        <div class="card materias_container me-2" id="materias_container">

                            <div class="materia_element mb-2">
                                <div class="materia_element_data">
                                    <div class="materia_element_data_text">
                                        <p class="m-0 fw-bold">Materia: <span class="fw-normal">Matemáticas</span></p>
                                        <p class="m-0 fw-bold">Departamento: <span class="fw-normal">Matemáticas</span></p>
                                        <p class="m-0 fw-bold">Profesor: <span class="fw-normal">Juan Pérez</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="materia_element mb-2">
                                <div class="materia_element_data">
                                    <div class="materia_element_data_text">
                                        <p class="m-0 fw-bold">Materia: <span class="fw-normal">Matemáticas</span></p>
                                        <p class="m-0 fw-bold">Departamento: <span class="fw-normal">Matemáticas</span></p>
                                        <p class="m-0 fw-bold">Profesor: <span class="fw-normal">Juan Pérez</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">

                        </div>
                    </div>
                </div>
            </div>

            <script src="../../js/ajax.js"></script>
            <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
            <script src="../../js/nav_script.js"></script>
            <script src="../../js/validations.js"></script>
            <script src="../../js/horarios.js"></script>

</body>

</html>