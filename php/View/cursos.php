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
                <li><a href="./cursos.php" class="nav_item_selected">Cursos</a></li>
                <li><a href="./horarios.php">Horarios</a></li>
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

            <div class="p-0 m-3 mx-auto" style="width: 100%;max-width:1500px;">
                <div class="bg-primary p-3 rounded d-flex flex-wrap justify-content-center align-items-center">
                    <div class="bg-light py-1 px-4 rounded text-center max-width-max-content m-auto">
                        <h2 class="max-width-max-content">Administración de NRCs</h2>
                    </div>
                    <button type="button" class="btn btn-success me-3 my-1 py-1 px-3 height-max-content fs-4" data-bs-toggle="modal" data-bs-target="#modal_nuevo">
                        <i class="bi bi-plus-square-dotted p-0 m-0"></i>
                    </button>
                </div>
                <div class="card">
                    <div class="card-body table_ingreso_container" style="max-height:calc(100vh - 195px)">
                        <table class="table-primary">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>NRC</th>
                                    <th>Profesor</th>
                                    <th>Materia</th>
                                    <th>Departamento</th>
                                    <th>Carrera</th>
                                    <th>Período</th>
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


    <!-- Modal new profesor -->
    <div class="modal fade" id="modal_nuevo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Nuevo Profesor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form_container m-3">
                        <form onsubmit="event.preventDefault()" id="formProfesor" method="post">
                            <div class="mb-3">
                                <label for="nrc" class="form-label fw-bold">NRC</label>

                                <input type="text" class="form-control" id="nrc" name="nrc" oninput="validarFormulario()">
                                <div class="valid-feedback">
                                    <!-- Looks good! -->
                                </div>
                                <div class="invalid-feedback">
                                    Este campo es obigatorio.<br>
                                    5 caracteres numéricos
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="profesor_select" class="form-label fw-bold">Profesor</label>
                                <select class="form-select" aria-label="Default select example" id="profesor_select" name="profesor_select" oninput="validarFormulario()">
                                </select>
                                <div class="valid-feedback">
                                    <!-- Looks good! -->
                                </div>
                                <div class="invalid-feedback">
                                    Este campo es obigatorio.<br>
                                    Solo se aceptan caracteres alfabéticos.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="materia_select" class="form-label fw-bold">Materia</label>
                                <select class="form-select" aria-label="Default select example" id="materia_select" name="materia_select" oninput="validarFormulario()">
                                </select>
                                <div class="valid-feedback">
                                    <!-- Looks good! -->
                                </div>
                                <div class="invalid-feedback">
                                    Este campo es obigatorio.<br>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="departamento_select" class="form-label fw-bold">Departamento</label>
                                <select class="form-select" aria-label="Default select example" id="departamento_select" name="departamento_select" oninput="validarFormulario()" onchange="selectCarreras()">
                                </select>
                                <div class="valid-feedback">
                                    <!-- Looks good! -->
                                </div>
                                <div class="invalid-feedback">
                                    Este campo es obigatorio.<br>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="carrera_select" class="form-label fw-bold">Carrera</label>
                                <select class="form-select" aria-label="Default select example" id="carrera_select" name="carrera_select" oninput="validarFormulario()">
                                </select>
                                <div class="valid-feedback">
                                    <!-- Looks good! -->
                                </div>
                                <div class="invalid-feedback">
                                    Este campo es obigatorio.<br>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="periodo_select" class="form-label fw-bold">Período Lectivo</label>
                                <select class="form-select" aria-label="Default select example" id="periodo_select" name="periodo_select" oninput="validarFormulario()">
                                    <option selected>Open this select menu</option>
                                </select>

                                <div class="valid-feedback">
                                    <!-- Looks good! -->
                                </div>
                                <div class="invalid-feedback">
                                    Este campo es obigatorio.<br>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="reset" value="Limpiar" class="btn btn-secondary me-3">
                                <button type="button" class="btn btn-primary" id="ingresarNuevo" disabled onclick="nuevo()">
                                    Agregar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal edit profesor -->
    <div class="modal fade" id="modal_editar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-light">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Profesor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form_container m-3">

                        <form onsubmit="event.preventDefault()" id="formProfesor" method="post">
                            <div class="mb-3">
                                <label for="nrc_edit" class="form-label fw-bold">NRC</label>

                                <input type="text" class="form-control" id="nrc_edit" name="nrc_edit" oninput="validarFormularioEditar()">
                                <div class="valid-feedback">
                                    <!-- Looks good! -->
                                </div>
                                <div class="invalid-feedback">
                                    Este campo es obigatorio.<br>
                                    5 caracteres numéricos
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="profesor_select_edit" class="form-label fw-bold">Profesor</label>
                                <select class="form-select" aria-label="Default select example" id="profesor_select_edit" name="profesor_select_edit" oninput="validarFormularioEditar()">
                                </select>
                                <div class="valid-feedback">
                                    <!-- Looks good! -->
                                </div>
                                <div class="invalid-feedback">
                                    Este campo es obigatorio.<br>
                                    Solo se aceptan caracteres alfabéticos.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="materia_select_edit" class="form-label fw-bold">Materia</label>
                                <select class="form-select" aria-label="Default select example" id="materia_select_edit" name="materia_select_edit" oninput="validarFormularioEditar()">
                                </select>
                                <div class="valid-feedback">
                                    <!-- Looks good! -->
                                </div>
                                <div class="invalid-feedback">
                                    Este campo es obigatorio.<br>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="departamento_select_edit" class="form-label fw-bold">Departamento</label>
                                <select class="form-select" aria-label="Default select example" id="departamento_select_edit" name="departamento_select_edit" oninput="validarFormularioEditar()" onchange="selectCarrerasEdit()">
                                </select>
                                <div class="valid-feedback">
                                    <!-- Looks good! -->
                                </div>
                                <div class="invalid-feedback">
                                    Este campo es obigatorio.<br>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="carrera_select_edit" class="form-label fw-bold">Carrera</label>
                                <select class="form-select" aria-label="Default select example" id="carrera_select_edit" name="carrera_select_edit" oninput="validarFormularioEditar()">
                                </select>
                                <div class="valid-feedback">
                                    <!-- Looks good! -->
                                </div>
                                <div class="invalid-feedback">
                                    Este campo es obigatorio.<br>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="periodo_select_edit" class="form-label fw-bold">Período Lectivo</label>
                                <select class="form-select" aria-label="Default select example" id="periodo_select_edit" name="periodo_select_edit" oninput="validarFormularioEditar()">
                                    <option selected>Open this select menu</option>
                                </select>

                                <div class="valid-feedback">
                                    <!-- Looks good! -->
                                </div>
                                <div class="invalid-feedback">
                                    Este campo es obigatorio.<br>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="reset" value="Limpiar" class="btn btn-secondary me-3">
                                <button type="button" class="btn btn-primary" id="editarButton" disabled>
                                    Editar
                                </button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal new profesor -->
    <div class="modal fade" id="modal_eliminar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-light">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Eliminar Profesor</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Está seguro de eliminar al profesor?</p>
                </div>
                <div class="modal-footer">
                    <input type="reset" value="Cancelar" class="btn btn-secondary me-3" data-bs-dismiss="modal" aria-label="Close">
                    <button type="button" class="btn btn-danger" id="eliminarButton">
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="../../js/ajax.js"></script>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../js/nav_script.js"></script>
    <script src="../../js/validations.js"></script>
    <script src="../../js/cursos.js"></script>

</body>

</html>