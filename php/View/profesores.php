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
                <li><a href="./profesores.php" class="nav_item_selected">Profesores</a></li>
                <li><a href="./materias.php">Materias</a></li>
                <li><a href="">Cursos</a></li>
                <li><a href="">Horarios</a></li>
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
            <div class="profesores_container p-0">
                <div class="card form_container m-3">
                    <div class="card-header bg-primary text-light">
                        <h2>Nuevo Profesor</h2>
                    </div>
                    <div class="card-body" style="height:max-content">
                        <form onsubmit="event.preventDefault()" id="formProfesor" method="post">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Juan Vasquez">
                                <div class="valid-feedback">
                                    <!-- Looks good! -->
                                </div>
                                <div class="invalid-feedback">
                                    Este campo es obigatorio.<br>
                                    Solo se aceptan caracteres alfabéticos.
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Ej: nombre@example.com">
                                <div class="valid-feedback">
                                    <!-- Looks good! -->
                                </div>
                                <div class="invalid-feedback">
                                    Este campo es obligatorio<br>
                                    Ingrese un correo válido.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="departamento" class="form-label">Departamento</label>
                                <select class="form-select" id="departamento" name="departamento">
                                    <option value="" selected>--Seleccione--</option>
                                    <option value="Ciencias de la Computacion">Ciencias de la Computación</option>
                                    <option value="Ciencias Exactas">Ciencias Exactas</option>
                                    <option value="Ciencias de la Tierra">Ciencias de la Tierra</option>
                                    <option value="Ciencias de la Comunicacion">Ciencias de la Comunicacion</option>
                                </select>
                                <div class="valid-feedback">
                                    <!-- Looks good! -->
                                </div>
                                <div class="invalid-feedback">
                                    Este campo es obligatorio. Elija una opción.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="jornadaTrabajo" class="form-label">Jornada de trabajo</label>
                                <select class="form-select" id="jornadaTrabajo" name="jornadaTrabajo">
                                    <option value="" selected>--Seleccione--</option>
                                    <option value="Tiempo completo">Tiempo completo</option>
                                    <option value="Tiempo parcial">Tiempo parcial</option>
                                </select>
                                <div class="valid-feedback">
                                    <!-- Looks good! -->
                                </div>
                                <div class="invalid-feedback">
                                    Este campo es obligatorio. Elija una opción.
                                </div>
                            </div>

                            <div class="modal-footer">
                                <input type="reset" value="Limpiar" class="btn btn-secondary me-3">
                                <button type="button" class="btn btn-primary" id="ingresarNuevoProfesorButton" onclick="nuevoProfesor()" disabled>
                                    Ingresar
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
                <div class="card table_ingreso_container m-3">
                    <div class="card-body" style="max-height:calc(100vh - 110px)">
                        <table class="table-primary">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th>Departamento</th>
                                    <th>Jornada</th>
                                    <th>Horas Semanales</th>
                                    <th>OP</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_profesores">
                                <tr>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="../../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../js/nav_script.js"></script>
    <script src="../../js/validations.js"></script>
    <script src="../../js/profesores.js"></script>

</body>

</html>