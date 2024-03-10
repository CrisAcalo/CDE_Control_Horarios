document.addEventListener("DOMContentLoaded", function () {
  cargar();
  extraerDatos();
});

function extraerDatos() {
  let periodo_select = $("#periodo_select");
  let materia_select = $("#materia_select");
  let profesor_select = $("#profesor_select");
  let departamento_select = $("#departamento_select");
  let periodo_select_edit = $("#periodo_select_edit");
  let materia_select_edit = $("#materia_select_edit");
  let profesor_select_edit = $("#profesor_select_edit");
  let departamento_select_edit = $("#departamento_select_edit");

  periodo_select.empty();
  materia_select.empty();
  profesor_select.empty();
  departamento_select.empty();

  periodo_select_edit.empty();
  materia_select_edit.empty();
  profesor_select_edit.empty();
  departamento_select_edit.empty();

  // Agregar el primer option con valor vacío y texto "Seleccionar"
  periodo_select.append(
    '<option value="" disabled selected>Seleccionar</option>'
  );
  materia_select.append(
    '<option value="" disabled selected>Seleccionar</option>'
  );
  profesor_select.append(
    '<option value="" disabled selected>Seleccionar</option>'
  );
  departamento_select.append(
    '<option value="" disabled selected>Seleccionar</option>'
  );

  // Agregar el primer option con valor vacío y texto "Seleccionar"
  periodo_select_edit.append(
    '<option value="" disabled selected>Seleccionar</option>'
  );
  materia_select_edit.append(
    '<option value="" disabled selected>Seleccionar</option>'
  );
  profesor_select_edit.append(
    '<option value="" disabled selected>Seleccionar</option>'
  );
  departamento_select_edit.append(
    '<option value="" disabled selected>Seleccionar</option>'
  );

  $.ajax({
    url: "../Controller/PeriodoController.php?function=getAll",
    method: "POST",
    success: function (response) {
      let parsedResponse = JSON.parse(response);
      parsedResponse.forEach(function (element) {
        periodo_select.append(`
              <option value="${element.id}">${element.nombre}</option>
          `);
      });
      parsedResponse.forEach(function (element) {
        periodo_select_edit.append(`
              <option value="${element.id}">${element.nombre}</option>
          `);
      });
    },
  });

  $.ajax({
    url: "../Controller/MateriaController.php?function=mostrarDatos",
    method: "POST",
    success: function (response) {
      let parsedResponse = JSON.parse(response);
      parsedResponse.forEach(function (element) {
        materia_select.append(`
              <option value="${element.id}">${element.nombre}</option>
          `);
      });

      parsedResponse.forEach(function (element) {
        materia_select_edit.append(`
                <option value="${element.id}">${element.nombre}</option>
            `);
      });
    },
  });

  $.ajax({
    url: "../Controller/ProfesorController.php?function=mostrarDatos",
    method: "POST",
    success: function (response) {
      let parsedResponse = JSON.parse(response);
      parsedResponse.forEach(function (element) {
        profesor_select.append(`
              <option value="${element.id}">${element.nombre}</option>
          `);
      });
      parsedResponse.forEach(function (element) {
        profesor_select_edit.append(`
              <option value="${element.id}">${element.nombre}</option>
          `);
      });
    },
  });

  $.ajax({
    url: "../Controller/DepartamentoController.php?function=getAll",
    method: "POST",
    success: function (response) {
      let parsedResponse = JSON.parse(response);
      parsedResponse.forEach(function (element) {
        departamento_select.append(`
              <option value="${element.id}">${element.nombre}</option>
          `);
      });
      parsedResponse.forEach(function (element) {
        departamento_select_edit.append(`
              <option value="${element.id}">${element.nombre}</option>
          `);
      });
    },
  });
}

function selectCarreras() {
  let carrera_select = $("#carrera_select");
  carrera_select.val("");
  validarFormulario();
  let departamentoSelected = $("#departamento_select").val();

  carrera_select.empty();
  carrera_select.append(
    '<option value="" disabled selected>Seleccionar</option>'
  );

  $.ajax({
    url: `../Controller/DepartamentoController.php?function=getCareersByDepartment&department_id=${departamentoSelected}`,
    method: "GET",
    dataType: "json",
    success: function (response) {
      response.forEach(function (element) {
        carrera_select.append(`
                <option value="${element.id}">${element.nombre}</option>
            `);
      });
    },
  });
}

function selectCarrerasEdit() {
  let carrera_select = $("#carrera_select_edit");
  carrera_select.val("");
  validarFormularioEditar();
  let departamentoSelected = $("#departamento_select_edit").val();

  carrera_select.empty();
  carrera_select.append(
    '<option value="" disabled selected>Seleccionar</option>'
  );

  $.ajax({
    url: `../Controller/DepartamentoController.php?function=getCareersByDepartment&department_id=${departamentoSelected}`,
    method: "GET",
    dataType: "json",
    success: function (response) {
      response.forEach(function (element) {
        carrera_select.append(`
                  <option value="${element.id}">${element.nombre}</option>
              `);
      });
    },
  });
}

function validarFormulario() {
  const materia_select = validarVacio(
    document.getElementById("materia_select")
  );
  const profesor_select = validarVacio(
    document.getElementById("profesor_select")
  );
  const departamento_select = validarVacio(
    document.getElementById("departamento_select")
  );
  const carrera_select = validarVacio(
    document.getElementById("carrera_select")
  );
  const periodo_select = validarVacio(
    document.getElementById("periodo_select")
  );
  const nrc = validarNRC(document.getElementById("nrc"));

  let botonEnviar = $("#ingresarNuevo");

  if (
    materia_select &&
    profesor_select &&
    departamento_select &&
    carrera_select &&
    periodo_select &&
    nrc
  ) {
    botonEnviar.prop("disabled", false);
  } else {
    botonEnviar.prop("disabled", true);
  }
}

function validarFormularioEditar() {
  const materia_select = validarVacio(
    document.getElementById("materia_select_edit")
  );
  const profesor_select = validarVacio(
    document.getElementById("profesor_select_edit")
  );
  const departamento_select = validarVacio(
    document.getElementById("departamento_select_edit")
  );
  const carrera_select = validarVacio(
    document.getElementById("carrera_select_edit")
  );
  const periodo_select = validarVacio(
    document.getElementById("periodo_select_edit")
  );
  const nrc = validarNRC(document.getElementById("nrc_edit"));

  let botonEnviar = $("#editarButton");

  if (
    materia_select &&
    profesor_select &&
    departamento_select &&
    carrera_select &&
    periodo_select &&
    nrc
  ) {
    botonEnviar.prop("disabled", false);
  } else {
    botonEnviar.prop("disabled", true);
  }
}

function nuevo() {
  const botonEnviar = $("#ingresarNuevo");
  const resultado_response = $("#resultado_response");

  let periodo_select = $("#periodo_select");
  let materia_select = $("#materia_select");
  let profesor_select = $("#profesor_select");
  let departamento_select = $("#departamento_select");
  let carrera_select = $("#carrera_select");
  let nrc = $("#nrc");

  const periodoValido = validarVacio(periodo_select[0]);
  const materiaValida = validarVacio(materia_select[0]);
  const profesorValido = validarVacio(profesor_select[0]);
  const departamentoValido = validarVacio(departamento_select[0]);
  const carreraValida = validarVacio(carrera_select[0]);
  const nrcValido = validarVacio(nrc[0]);

  if (
    periodoValido &&
    materiaValida &&
    profesorValido &&
    departamentoValido &&
    carreraValida &&
    nrcValido
  ) {
    $.ajax({
      url: "../Controller/CursoController.php?function=create",
      method: "POST",
      contentType: "application/json",
      data: JSON.stringify({
        periodo_select: periodo_select.val(),
        materia_select: materia_select.val(),
        profesor_select: profesor_select.val(),
        departamento_select: departamento_select.val(),
        carrera_select: carrera_select.val(),
        nrc: nrc.val(),
      }),
      success: function (response) {
        response = JSON.parse(response);

        if (response.status === "Success") {
          cargar();
          resultado_response
            .removeClass("border-danger bg-danger text-danger")
            .addClass("border-success bg-success text-success")
            .html(response.response)
            .css("display", "block");
          // Limpiar valores y clases de validación
          [
            periodo_select,
            materia_select,
            profesor_select,
            departamento_select,
            carrera_select,
          ].forEach((element) => {
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

function editar(user_id) {
  const botonEnviar = $("#editarButton");
  const resultado_response = $("#resultado_response");

  let periodo_select = $("#periodo_select_edit");
  let materia_select = $("#materia_select_edit");
  let profesor_select = $("#profesor_select_edit");
  let departamento_select = $("#departamento_select_edit");
  let carrera_select = $("#carrera_select_edit");
  let nrc = $("#nrc_edit");

  const periodoValido = validarVacio(periodo_select[0]);
  const materiaValida = validarVacio(materia_select[0]);
  const profesorValido = validarVacio(profesor_select[0]);
  const departamentoValido = validarVacio(departamento_select[0]);
  const carreraValida = validarVacio(carrera_select[0]);
  const nrcValido = validarNRC(nrc[0]);

  if (
    periodoValido &&
    materiaValida &&
    profesorValido &&
    departamentoValido &&
    carreraValida &&
    nrcValido
  ) {
    $("#modal_editar").modal("hide");

    $.ajax({
      url: `../Controller/CursoController.php?function=edit&user_id=${user_id}`,
      method: "POST",
      contentType: "application/json",
      data: JSON.stringify({
        profesor_id: profesor_select.val(),
        materia_id: materia_select.val(),
        departamento_id: departamento_select.val(),
        carrera_id: carrera_select.val(),
        periodo_id: periodo_select.val(),
        nrc: nrc.val(),
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
        [
          periodo_select,
          materia_select,
          profesor_select,
          departamento_select,
          carrera_select,
        ].forEach((element) => {
          element.val("").removeClass("is-valid is-invalid");
        });

        botonEnviar.prop("disabled", true);

        if (response.status === "Success") {
          cargar();
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
  const botonEnviar = $("#editarButton");

  let nrc = $("#nrc_edit");
  let periodo_select = $("#periodo_select_edit");
  let materia_select = $("#materia_select_edit");
  let profesor_select = $("#profesor_select_edit");
  let departamento_select = $("#departamento_select_edit");
  let carrera_select = $("#carrera_select_edit");

  $.ajax({
    url:
      "../Controller/CursoController.php?function=getC&user_id=" +
      Number(user_id),
    method: "GET",
    dataType: "json",
    success: function (response) {
      $("#modal_editar").modal("show");
      nrc.val(response.response.nrc);
      materia_select.val(response.response.materia[0].id);
      profesor_select.val(response.response.profesor[0].id);
      departamento_select.val(response.response.departamento[0].id);
      periodo_select.val(response.response.periodo[0].id);
      selectCarrerasEdit();
      //carrera_select.val(response.response.carrera[0].id);

      botonEnviar.attr("onclick", `editar(${user_id})`);
    },
    error: function (xhr, textStatus, errorThrown) {
      console.error(xhr.status + errorThrown + xhr.responseText);
    },
  });
}

function eliminar(user_id) {
  const resultado_response = $("#resultado_response");
  $.ajax({
    url: `../Controller/CursoController.php?function=deleteC&user_id=${user_id}`,
    method: "POST",
    success: function (response) {
      response = JSON.parse(response);

      if (response.status === "Success") {
        cargar();
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

function cargar() {
  let tbody_profesores = $("#tbody_profesores");

  tbody_profesores.empty();

  $.ajax({
    url: "../Controller/CursoController.php?function=getAll",
    method: "POST",
    success: function (response) {
      let parsedResponse = JSON.parse(response);
      parsedResponse.forEach(function (element) {
        tbody_profesores.append(`
                <tr>
                <td>${element.id}</td>
                <td>${element.nrc}</td>
                <td>${element.data.profesor[0].nombre}</td>
                <td>${element.data.materia[0].nombre}</td>
                <td>${element.data.departamento[0].nombre}</td>
                <td>${element.data.carrera[0].nombre}</td>
                <td>${element.data.periodo[0].nombre}</td>
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

  botonEliminar.attr("onclick", `eliminar(${id})`);
}
