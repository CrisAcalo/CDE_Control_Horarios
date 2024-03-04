document.addEventListener("DOMContentLoaded", function () {
  cargarProfesores();
});
document
  .getElementById("nombre")
  .addEventListener("input", validarFormularioProfesor);
document
  .getElementById("email")
  .addEventListener("input", validarFormularioProfesor);
document
  .getElementById("departamento")
  .addEventListener("input", validarFormularioProfesor);
document
  .getElementById("jornadaTrabajo")
  .addEventListener("input", validarFormularioProfesor);

function validarFormularioProfesor() {
  const nombreValido = validarAlfabeticos(document.getElementById("nombre"));
  const correoValido = validarCorreo(document.getElementById("email"));
  const departamentoValido = validarVacio(
    document.getElementById("departamento")
  );
  const jornadaValida = validarVacio(document.getElementById("jornadaTrabajo"));

  const botonEnviar = document.querySelector("#ingresarNuevoProfesorButton");

  if (nombreValido && correoValido && departamentoValido && jornadaValida) {
    botonEnviar.disabled = false;
  } else {
    botonEnviar.disabled = true;
  }
}

function validarFormularioEditProfesor(user_id) {
  const nombreValido = validarAlfabeticos(
    document.getElementById(`nombre${user_id}`)
  );
  const correoValido = validarCorreo(
    document.getElementById(`email${user_id}`)
  );
  const departamentoValido = validarVacio(
    document.getElementById(`departamento${user_id}`)
  );
  const jornadaValida = validarVacio(
    document.getElementById(`jornadaTrabajo${user_id}`)
  );

  const botonEnviar = document.querySelector(`#editarProfesorButton${user_id}`);

  if (nombreValido && correoValido && departamentoValido && jornadaValida) {
    botonEnviar.disabled = false;
  } else {
    botonEnviar.disabled = true;
  }
}

function nuevoProfesor() {
  const botonEnviar = document.querySelector("#ingresarNuevoProfesorButton");
  const resultado_response = document.getElementById("resultado_response");

  let nombre = document.getElementById("nombre");
  let correo = document.getElementById("email");
  let departamento = document.getElementById("departamento");
  let jornada = document.getElementById("jornadaTrabajo");
  const nombreValido = validarAlfabeticos(nombre);
  const correoValido = validarCorreo(correo);
  const departamentoValido = validarVacio(departamento);
  const jornadaValida = validarVacio(jornada);

  if (nombreValido && correoValido && departamentoValido && jornadaValida) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText.includes("Success")) {
          cargarProfesores();
          resultado_response.classList.remove(
            "border-danger",
            "bg-danger",
            "text-danger"
          );
          resultado_response.classList.add(
            "border-success",
            "bg-success",
            "text-success"
          );
          resultado_response.innerHTML = this.responseText;
          resultado_response.style = "display:block";
          nombre.value = "";
          correo.value = "";
          departamento.value = "";
          jornada.value = "";
        } else if (this.responseText.includes("Error")) {
          resultado_response.classList.remove(
            "border-success",
            "bg-success",
            "text-success"
          );
          resultado_response.classList.add(
            "border-danger",
            "bg-danger",
            "text-danger"
          );

          resultado_response.innerHTML = this.responseText;
          resultado_response.style = "display:block";
        } else {
          resultado_response.innerHTML = this.responseText;
          resultado_response.style = "display:block";
        }
      } else {
        resultado_response.classList.remove(
          "border-success",
          "bg-success",
          "text-success"
        );
        resultado_response.classList.add(
          "border-danger",
          "bg-danger",
          "text-danger"
        );

        resultado_response.innerHTML = this.status;
        resultado_response.style = "display:block";
      }
    };

    // Construir el objeto de datos a enviar
    const data = {
      nombre: nombre.value,
      correo: correo.value,
      departamento: departamento.value,
      dedicacion: jornada.value,
    };

    // Convertir el objeto de datos a una cadena JSON
    const jsonData = JSON.stringify(data);

    // Enviar la solicitud POST con la cadena JSON como datos

    xmlhttp.open(
      "POST",
      "../Controller/ProfesorController.php?function=createProfesor",
      true
    );

    xmlhttp.setRequestHeader("Content-type", "application/json");
    xmlhttp.send(jsonData);
    console.log("Final de funcion");
  } else {
    botonEnviar.disabled = true;
  }
}

function editarProfesor(user_id) {
  const botonEnviar = document.querySelector(`#editarProfesorButton${user_id}`);
  const resultado_response = document.getElementById("resultado_response");

  let nombre = document.getElementById(`nombre${user_id}`);
  let correo = document.getElementById(`email${user_id}`);
  let departamento = document.getElementById(`departamento${user_id}`);
  let jornada = document.getElementById(`jornadaTrabajo${user_id}`);
  const nombreValido = validarAlfabeticos(nombre);
  const correoValido = validarCorreo(correo);
  const departamentoValido = validarVacio(departamento);
  const jornadaValida = validarVacio(jornada);

  if (nombreValido && correoValido && departamentoValido && jornadaValida) {
    let modalEdit = document.getElementById(`modalEditProfesor${user_id}`);
    let modal = bootstrap.Modal.getInstance(modalEdit);
    modal.hide();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        let response = JSON.parse(this.responseText);
        if (response.status == "Success") {
          cargarProfesores();
          resultado_response.classList.remove(
            "border-danger",
            "bg-danger",
            "text-danger"
          );
          resultado_response.classList.add(
            "border-success",
            "bg-success",
            "text-success"
          );
          resultado_response.innerHTML = response.response;
          resultado_response.style = "display:block";
          nombre.value = "";
          correo.value = "";
          departamento.value = "";
          jornada.value = "";
        } else if (response.status == "Error") {
          resultado_response.classList.remove(
            "border-success",
            "bg-success",
            "text-success"
          );
          resultado_response.classList.add(
            "border-danger",
            "bg-danger",
            "text-danger"
          );

          resultado_response.innerHTML = this.responseText;
          resultado_response.style = "display:block";
        } else {
          resultado_response.innerHTML = this.responseText;
          resultado_response.style = "display:block";
        }
      } else {
        resultado_response.classList.remove(
          "border-success",
          "bg-success",
          "text-success"
        );
        resultado_response.classList.add(
          "border-danger",
          "bg-danger",
          "text-danger"
        );

        resultado_response.innerHTML = this.status + this.responseText;
        resultado_response.style = "display:block";
      }
    };

    // Construir el objeto de datos a enviar
    const data = {
      nombre: nombre.value,
      correo: correo.value,
      departamento: departamento.value,
      dedicacion: jornada.value,
    };

    // Convertir el objeto de datos a una cadena JSON
    const jsonData = JSON.stringify(data);

    // Enviar la solicitud POST con la cadena JSON como datos

    xmlhttp.open(
      "POST",
      `../Controller/ProfesorController.php?function=editProfesor&user_id=${user_id}`,
      true
    );

    xmlhttp.setRequestHeader("Content-type", "application/json");
    xmlhttp.send(jsonData);
    console.log("Final de funcion");
  } else {
    botonEnviar.disabled = true;
  }
}

function showInformation(user_id) {
  const botonEnviar = document.querySelector("#ingresarNuevoProfesorButton");

  let nombre = document.getElementById("nombre");
  let correo = document.getElementById("email");
  let departamento = document.getElementById("departamento");
  let jornada = document.getElementById("jornadaTrabajo");

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);
      nombre.value = response.response.nombre;
      correo.value = response.response.correo;
      departamento.value = response.response.departamento;
      jornada.value = response.response.dedicacion;
      botonEnviar.setAttribute(
        "onclick",
        `ingresarNuevoProfesorButton(${user_id})`
      );
      return response;
    }
    return null;
  };
  xhttp.open(
    "GET",
    "../Controller/ProfesorController.php?function=getProfesor&user_id=" +
      Number(user_id),
    true
  );
  xhttp.send();
}

function eliminarProfesor(user_id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText.includes("Success")) {
          cargarProfesores();
          resultado_response.classList.remove(
            "border-danger",
            "bg-danger",
            "text-danger"
          );
          resultado_response.classList.add(
            "border-success",
            "bg-success",
            "text-success"
          );
          resultado_response.innerHTML = this.responseText;
          resultado_response.style = "display:block";
        } else if (this.responseText.includes("Error")) {
          resultado_response.classList.remove(
            "border-success",
            "bg-success",
            "text-success"
          );
          resultado_response.classList.add(
            "border-danger",
            "bg-danger",
            "text-danger"
          );

          resultado_response.innerHTML = this.responseText;
          resultado_response.style = "display:block";
        } else {
          resultado_response.innerHTML = this.responseText;
          resultado_response.style = "display:block";
        }
      } else {
        resultado_response.classList.remove(
          "border-success",
          "bg-success",
          "text-success"
        );
        resultado_response.classList.add(
          "border-danger",
          "bg-danger",
          "text-danger"
        );

        resultado_response.innerHTML = this.status;
        resultado_response.style = "display:block";
      }
    }
  };
  xhttp.open(
    "POST",
    "../Controller/ProfesorController.php?function=deleteProfesor&user_id=" +
      user_id,
    true
  );
  xhttp.send();
}

function cargarProfesores() {
  let opcionesJornada = "";
  let opcionesDepartamentos = "";
  let departamentos = [
    "Ciencias de la Computacion",
    "Ciencias Exactas",
    "Ciencias de la Tierra",
    "Ciencias de la Comunicacion",
  ];
  let jornadas = ["Tiempo completo", "Tiempo parcial"];

  let tbody_profesores = document.getElementById("tbody_profesores");
  tbody_profesores.innerHTML = "";
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // tbody_profesores.innerHTML = this.responseText;
      let response = JSON.parse(this.responseText);
      response.forEach((element) => {
        opcionesJornada = "";
        opcionesDepartamentos = "";

        departamentos.forEach(function (dato) {
          if (dato == element.departamento) {
            opcionesDepartamentos += `
              <option selected value="${dato}">${dato}</option>
            `;
          } else {
            opcionesDepartamentos += `
              <option value="${dato}">${dato}</option>
            `;
          }
        });

        jornadas.forEach(function (dato) {
          if (dato == element.dedicacion) {
            opcionesJornada += `
              <option selected value="${dato}">${dato}</option>
            `;
          } else {
            opcionesJornada += `
              <option value="${dato}">${dato}</option>
            `;
          }
        });

        tbody_profesores.innerHTML += `
      <tr>
        <td>${element.id}</td>
        <td>${element.nombre}</td>
        <td>${element.correo}</td>
        <td>${element.departamento}</td>
        <td>${element.dedicacion}</td>
        <td>${element.horas_semanales}</span></td>
        <td>
        <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modalEditProfesor${element.id}'>
            Editar
        </button>
        <button type='button' class='btn btn-danger btn-sm' id='ingresarNuevoProfesorButton' onclick='eliminarProfesor(${element.id})'>
            Eliminar
        </button>
        </td>
    </tr>
    <!-- Modal -->
    <div class='modal fade' id='modalEditProfesor${element.id}' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
        <div class='modal-header'>
            <h1 class='modal-title fs-5' id='staticBackdropLabel'>Editar Profesor: ${element.nombre}</h1>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
        </div>
        <div class='modal-body'>
        <form onsubmit="event.preventDefault()" id="formProfesor" method="post">
            <div class="mb-3">
                <label for="nombre${element.id}" class="form-label">Nombre</label>
                <input value="${element.nombre}" type="text" class="form-control" id="nombre${element.id}" name="nombre${element.id}" placeholder="Ej: Juan Vasquez" oninput="validarFormularioEditProfesor(${element.id})">
                <div class="valid-feedback">
                    <!-- Looks good! -->
                </div>
                <div class="invalid-feedback">
                    Este campo es obigatorio.<br>
                    Solo se aceptan caracteres alfabéticos.
                </div>
            </div>
            <div class="mb-3">
                <label for="email${element.id}" class="form-label">Correo</label>
                <input value="${element.correo}" type="email" class="form-control" id="email${element.id}" name="email${element.id}" placeholder="Ej: nombre@example.com" oninput="validarFormularioEditProfesor(${element.id})">
                <div class="valid-feedback">
                    <!-- Looks good! -->
                </div>
                <div class="invalid-feedback">
                    Este campo es obligatorio<br>
                    Ingrese un correo válido.
                </div>
            </div>

            <div class="mb-3">
                <label for="departamento${element.id}" class="form-label">Departamento</label>
                <select class="form-select" id="departamento${element.id}" name="departamento${element.id}" oninput="validarFormularioEditProfesor(${element.id})">
                    <option value="" selected>--Seleccione--</option>
                    ${opcionesDepartamentos}
                </select>
                <div class="valid-feedback">
                    <!-- Looks good! -->
                </div>
                <div class="invalid-feedback">
                    Este campo es obligatorio. Elija una opción.
                </div>
            </div>

            <div class="mb-3">
                <label for="jornadaTrabajo${element.id}" class="form-label">Jornada de trabajo</label>
                <select class="form-select" id="jornadaTrabajo${element.id}" name="jornadaTrabajo${element.id}" oninput="validarFormularioEditProfesor(${element.id})">
                    <option value="" selected>--Seleccione--</option>
                    ${opcionesJornada}
                </select>
                <div class="valid-feedback">
                    <!-- Looks good! -->
                </div>
                <div class="invalid-feedback">
                    Este campo es obligatorio. Elija una opción.
                </div>
            </div>

            <div class="modal-footer">
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                <button type="button" class="btn btn-primary" id="editarProfesorButton${element.id}" onclick="editarProfesor(${element.id})" disabled>
                    Guardar
                </button>
            </div>
        </form>
        </div>
        </div>
    </div>
    </div>`;
      });
    }
  };
  xhttp.open(
    "POST",
    "../Controller/ProfesorController.php?function=mostrarDatos",
    true
  );
  xhttp.send();
}
