document.addEventListener("DOMContentLoaded", function () {
  cargarProfesores();
});

function validarFormularioProfesor() {
  const nombreValido = validarAlfabeticos(document.getElementById("nombre"));
  const correoValido = validarCorreo(document.getElementById("email"));
  const departamentoValido = validarVacio(
    document.getElementById("departamento")
  );
  const jornadaValida = validarVacio(document.getElementById("jornadaTrabajo"));

  let botonEnviar = $("#ingresarNuevoProfesorButton");

  if (nombreValido && correoValido && departamentoValido && jornadaValida) {
    botonEnviar.prop("disabled", false);
  } else {
    botonEnviar.prop("disabled", true);
  }
}

function validarFormularioEditProfesor2() {
  const nombreValido = validarAlfabeticos(
    document.getElementById(`nombre_editar`)
  );
  const correoValido = validarCorreo(document.getElementById(`email_editar`));
  const departamentoValido = validarVacio(
    document.getElementById(`departamento_editar`)
  );
  const jornadaValida = validarVacio(
    document.getElementById(`jornadaTrabajo_editar`)
  );

  const botonEnviar = document.querySelector(`#editarProfesorButtonTest`);

  if (nombreValido && correoValido && departamentoValido && jornadaValida) {
    botonEnviar.disabled = false;
  } else {
    botonEnviar.disabled = true;
  }
}

function nuevoProfesor() {
  const botonEnviar = $("#ingresarNuevoProfesorButton");
  const resultado_response = $("#resultado_response");

  let nombre = $("#nombre");
  let correo = $("#email");
  let departamento = $("#departamento");
  let jornada = $("#jornadaTrabajo");
  const nombreValido = validarAlfabeticos(nombre[0]);
  const correoValido = validarCorreo(correo[0]);
  const departamentoValido = validarVacio(departamento[0]);
  const jornadaValida = validarVacio(jornada[0]);

  if (nombreValido && correoValido && departamentoValido && jornadaValida) {
    $.ajax({
      url: "../Controller/ProfesorController.php?function=createProfesor",
      method: "POST",
      contentType: "application/json",
      data: JSON.stringify({
        nombre: nombre.val(),
        correo: correo.val(),
        departamento: departamento.val(),
        dedicacion: jornada.val(),
      }),
      success: function (response) {
        response = JSON.parse(response);

        if (response.status === "Success") {
          cargarProfesores();
          resultado_response
            .removeClass("border-danger bg-danger text-danger")
            .addClass("border-success bg-success text-success")
            .html(response.response)
            .css("display", "block");
          // Limpiar valores y clases de validación
          [nombre, correo, departamento, jornada].forEach((element) => {
            element.val("").removeClass("is-valid is-invalid");
          });
        } else if (response.status === "Error") {
          resultado_response
            .removeClass("border-success bg-success text-success")
            .addClass("border-danger bg-danger text-danger")
            .html(response.response)
            .css("display", "block");
        } else {
          resultado_response.html(response.response).css("display", "block");
        }
        $("#modal_nuevo").modal("hide");
      },
      error: function (xhr, textStatus, errorThrown) {
        resultado_response
          .removeClass("border-success bg-success text-success")
          .addClass("border-danger bg-danger text-danger")
          .html(xhr.status + errorThrown + xhr.responseText)
          .css("display", "block");
      },
    });
  } else {
    botonEnviar.prop("disabled", true);
  }
}

function editarProfesor2(user_id) {
  const botonEnviar = $("#editarProfesorButtonTest");
  const resultado_response = $("#resultado_response");

  let nombre = $("#nombre_editar");
  let correo = $("#email_editar");
  let departamento = $("#departamento_editar");
  let jornada = $("#jornadaTrabajo_editar");

  const nombreValido = validarAlfabeticos(nombre[0]);
  const correoValido = validarCorreo(correo[0]);
  const departamentoValido = validarVacio(departamento[0]);
  const jornadaValida = validarVacio(jornada[0]);

  if (nombreValido && correoValido && departamentoValido && jornadaValida) {
    $("#modal_editar").modal("hide");

    $.ajax({
      url: `../Controller/ProfesorController.php?function=editProfesor&user_id=${user_id}`,
      method: "POST",
      contentType: "application/json",
      data: JSON.stringify({
        nombre: nombre.val(),
        correo: correo.val(),
        departamento: departamento.val(),
        dedicacion: jornada.val(),
      }),
      success: function (response) {
        response = JSON.parse(response);

        resultado_response
          .removeClass("border-danger bg-danger text-danger")
          .removeClass("border-success bg-success text-success")
          .addClass(
            response.status === "Success"
              ? "border-success bg-success text-success"
              : "border-danger bg-danger text-danger"
          )
          .html(response.response)
          .css("display", "block");

        // Limpiar valores y clases de validación
        [nombre, correo, departamento, jornada].forEach((element) => {
          element.val("").removeClass("is-valid is-invalid");
        });

        botonEnviar.prop("disabled", true);

        if (response.status === "Success") {
          cargarProfesores();
        }
      },
      error: function (xhr, textStatus, errorThrown) {
        resultado_response
          .removeClass("border-success bg-success text-success")
          .addClass("border-danger bg-danger text-danger")
          .html(xhr.status + errorThrown + xhr.responseText)
          .css("display", "block");
      },
    });
  } else {
    botonEnviar.prop("disabled", true);
  }
}

function showInformation(user_id) {
  const botonEnviar = $("#editarProfesorButtonTest");

  let nombre = $("#nombre_editar");
  let correo = $("#email_editar");
  let departamento = $("#departamento_editar");
  let jornada = $("#jornadaTrabajo_editar");

  $.ajax({
    url:
      "../Controller/ProfesorController.php?function=getProfesor&user_id=" +
      Number(user_id),
    method: "GET",
    dataType: "json",
    success: function (response) {
      $("#modal_editar").modal("show");
      nombre.val(response.response.nombre);
      correo.val(response.response.correo);
      departamento.val(response.response.departamento);
      jornada.val(response.response.dedicacion);
      botonEnviar.attr("onclick", `editarProfesor2(${user_id})`);
    },
    error: function () {
      // Manejar el error si es necesario
    },
  });
}

function eliminarProfesor(user_id) {
  const resultado_response = $("#resultado_response");
  $.ajax({
    url: `../Controller/ProfesorController.php?function=deleteProfesor&user_id=${user_id}`,
    method: "POST",
    success: function (response) {
      response = JSON.parse(response);

      if (response.status === "Success") {
        cargarProfesores();
        resultado_response
          .removeClass("border-danger bg-danger text-danger")
          .addClass("border-success bg-success text-success")
          .html(response.response)
          .css("display", "block");
      } else if (response.status === "Error") {
        resultado_response
          .removeClass("border-success bg-success text-success")
          .addClass("border-danger bg-danger text-danger")
          .html(response.response)
          .css("display", "block");
      } else {
        resultado_response.html(response.response).css("display", "block");
      }

      $("#modal_eliminar").modal("hide");
    },
    error: function (xhr, textStatus, errorThrown) {
      resultado_response
        .removeClass("border-success bg-success text-success")
        .addClass("border-danger bg-danger text-danger")
        .html(xhr.status + errorThrown + xhr.responseText)
        .css("display", "block");
      $("#modal_eliminar").modal("hide");
    },
  });
}

function cargarProfesores() {
  let tbody_profesores = $("#tbody_profesores");

  tbody_profesores.empty();

  $.ajax({
    url: "../Controller/ProfesorController.php?function=mostrarDatos",
    method: "POST",
    success: function (response) {
      let parsedResponse = JSON.parse(response);
      parsedResponse.forEach(function (element) {
        tbody_profesores.append(`
            <tr>
            <td>${element.id}</td>
            <td>${element.nombre}</td>
            <td>${element.correo}</td>
            <td>${element.departamento}</td>
            <td>${element.dedicacion}</td>
            <td>${element.horas_semanales}</td>
              <td>
                <button type='button' class='btn btn-primary btn-sm' onclick="showInformation(${element.id})">
                  Editar
                </button>
                <button type='button' class='btn btn-danger btn-sm' onclick='mostrarModalEliminar(${element.id})'>
                  Eliminar
                </button>
              </td>
            </tr>
          `);
      });
    },
    error: function (xhr, textStatus, errorThrown) {
      console.error(xhr.status + errorThrown + xhr.responseText);
    },
  });
}

function mostrarModalEliminar(id) {
  $("#modal_eliminar").modal("show");

  let botonEliminar = $("#eliminarButton");

  botonEliminar.attr("onclick", `eliminarProfesor(${id})`);
}
