document.addEventListener("DOMContentLoaded", function () {
  cargarMaterias();
});
document
  .getElementById("nombre")
  .addEventListener("input", validarFormularioMateria);

function validarFormularioMateria() {
  const nombreValido = validarAlfabeticos(document.getElementById("nombre"));

  const botonEnviar = document.querySelector("#ingresarNuevaMateriaButton");

  if (nombreValido) {
    botonEnviar.disabled = false;
  } else {
    botonEnviar.disabled = true;
  }
}

function validarFormularioEditMateria(user_id) {
  const nombreValido = validarAlfabeticos(
    document.getElementById(`nombre${user_id}`)
  );
  const botonEnviar = document.querySelector(`#editarMateriaButton${user_id}`);

  if (nombreValido) {
    botonEnviar.disabled = false;
  } else {
    botonEnviar.disabled = true;
  }
}

function nuevaMateria() {
  const botonEnviar = document.querySelector("#ingresarNuevaMateriaButton");
  const resultado_response = document.getElementById("resultado_response");

  let nombre = document.getElementById("nombre");
  const nombreValido = validarAlfabeticos(nombre);

  if (nombreValido) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        
        if (this.responseText.includes("Success")) {
          cargarMaterias();
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
          botonEnviar.disabled = true;
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
    };

    // Convertir el objeto de datos a una cadena JSON
    const jsonData = JSON.stringify(data);

    // Enviar la solicitud POST con la cadena JSON como datos

    xmlhttp.open(
      "POST",
      "../Controller/MateriaController.php?function=createMateria",
      true
    );

    xmlhttp.setRequestHeader("Content-type", "application/json");
    xmlhttp.send(jsonData);
  } else {
    botonEnviar.disabled = true;
  }
}

function editarMateria(materia_id) {
  const botonEnviar = document.querySelector(`#editarMateriaButton${materia_id}`);
  const resultado_response = document.getElementById("resultado_response");

  let nombre = document.getElementById(`nombre${materia_id}`);
  const nombreValido = validarAlfabeticos(nombre);

  if (nombreValido) {
    let modalEdit = document.getElementById(`modalEditMateria${materia_id}`);
    let modal = bootstrap.Modal.getInstance(modalEdit);
    modal.hide();

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        
        let response = JSON.parse(this.responseText);
        if (response.status == "Success") {
          cargarMaterias();
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
    };

    // Convertir el objeto de datos a una cadena JSON
    const jsonData = JSON.stringify(data);

    // Enviar la solicitud POST con la cadena JSON como datos

    xmlhttp.open(
      "POST",
      `../Controller/MateriaCOntroller.php?function=editMateria&materia_id=${materia_id}`,
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

function eliminarMateria(user_id) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText.includes("Success")) {
          cargarMaterias();
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
    "../Controller/MateriaController.php?function=deleteMateria&user_id=" +
      user_id,
    true
  );
  xhttp.send();
}

function cargarMaterias() {
  let tbody_profesores = document.getElementById("tbody_profesores");
  tbody_profesores.innerHTML = "";
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(this.responseText);
      response.forEach((element) => {
        tbody_profesores.innerHTML += `
        <tr>
          <td>${element.id}</td>
          <td>${element.nombre}</td>
          <td>
          <button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#modalEditMateria${element.id}'>
              Editar
          </button>
          <button type='button' class='btn btn-danger btn-sm' id='ingresarNuevoProfesorButton' onclick='eliminarMateria(${element.id})'>
              Eliminar
          </button>
          </td>
      </tr>
      <!-- Modal -->
      <div class='modal fade' id='modalEditMateria${element.id}' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
      <div class='modal-dialog'>
          <div class='modal-content'>
          <div class='modal-header'>
              <h1 class='modal-title fs-5' id='staticBackdropLabel'>Editar Materia: ${element.nombre}</h1>
              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
          </div>
          <div class='modal-body'>
          <form onsubmit="event.preventDefault()" id="formProfesor" method="post">
              <div class="mb-3">
                  <label for="nombre${element.id}" class="form-label">Nombre</label>
                  <input value="${element.nombre}" type="text" class="form-control" id="nombre${element.id}" name="nombre${element.id}" placeholder="Ej: Métodos numéricos" oninput="validarFormularioEditMateria(${element.id})">
                  <div class="valid-feedback">
                      <!-- Looks good! -->
                  </div>
                  <div class="invalid-feedback">
                      Este campo es obigatorio.<br>
                      Solo se aceptan caracteres alfabéticos.
                  </div>
              </div>
  
              <div class="modal-footer">
              <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                  <button type="button" class="btn btn-primary" id="editarMateriaButton${element.id}" onclick="editarMateria(${element.id})" disabled>
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
    "../Controller/MateriaController.php?function=mostrarDatos",
    true
  );
  xhttp.send();
}
