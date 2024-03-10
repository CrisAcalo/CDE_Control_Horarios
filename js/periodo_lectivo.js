document.addEventListener("DOMContentLoaded", function () {
  cargar();
});

function validarFormulario() {
  const inicioValido = validarVacio(document.getElementById("inicio"));
  const finalValido = validarVacio(document.getElementById("final"));

  let botonEnviar = $("#ingresarNuevoPeriodoButton");

  if (inicioValido && finalValido) {
    botonEnviar.prop("disabled", false);
  } else {
    botonEnviar.prop("disabled", true);
  }
}

function validarFormularioEditar() {
  const inicioValido = validarVacio(document.getElementById("inicio_editar"));
  const finalValido = validarVacio(document.getElementById("final_editar"));

  let botonEnviar = $("#editarPeriodoButton");

  if (inicioValido && finalValido) {
    botonEnviar.prop("disabled", false);
  } else {
    botonEnviar.prop("disabled", true);
  }
}

function nuevo() {
  const botonEnviar = $("#ingresarNuevoPeriodoButton");
  const resultado_response = $("#resultado_response");

  let inicio = $("#inicio");
  let final = $("#final");
  const inicioValido = validarVacio(inicio[0]);
  const finalValido = validarVacio(final[0]);

  if (inicioValido && finalValido) {
    $.ajax({
      url: "../Controller/PeriodoController.php?function=create",
      method: "POST",
      contentType: "application/json",
      data: JSON.stringify({
        inicio: inicio.val(),
        final: final.val(),
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
          [inicio, final].forEach((element) => {
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
  const botonEnviar = $("#ingresarNuevoPeriodoButton");
  const resultado_response = $("#resultado_response");

  let inicio = $("#inicio_editar");
  let final = $("#final_editar");
  const inicioValido = validarVacio(inicio[0]);
  const finalValido = validarVacio(final[0]);

  if (inicioValido && finalValido) {
    $("#modal_editar").modal("hide");

    $.ajax({
      url: `../Controller/PeriodoController.php?function=edit&user_id=${user_id}`,
      method: "POST",
      contentType: "application/json",
      data: JSON.stringify({
        inicio: inicio.val(),
        final: final.val(),
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
        [inicio, final].forEach((element) => {
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
  const botonEnviar = $("#editarPeriodoButton");

  let inicio = $("#inicio_editar");
  let final = $("#final_editar");

  $.ajax({
    url:
      "../Controller/PeriodoController.php?function=getPeriodo&user_id=" +
      Number(user_id),
    method: "GET",
    dataType: "json",
    success: function (response) {
      $("#modal_editar").modal("show");
      console.log(response);
      var fechaString = response.response.periodo_inicio;
      var fecha = new Date(fechaString);
      var año = fecha.getFullYear();
      var mes = fecha.getMonth() + 2;
      if (mes == 13) {
        mes = 1;
      }
      var fechaFormateada = año + "-" + (mes < 10 ? "0" : "") + mes;
      inicio.val(fechaFormateada);
      console.log(fechaFormateada);

      fechaString = response.response.periodo_fin;
      fecha = new Date(fechaString);
      año = fecha.getFullYear();
      mes = fecha.getMonth() + 2; // Nota: getMonth() devuelve valores de 0 a 11, por lo que sumamos 1
      fechaFormateada = año + "-" + (mes < 10 ? "0" : "") + mes;
      final.val(fechaFormateada);
      console.log(fechaFormateada);
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
    url: `../Controller/PeriodoController.php?function=deleteP&user_id=${user_id}`,
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
    url: "../Controller/PeriodoController.php?function=getAll",
    method: "POST",
    success: function (response) {
      let parsedResponse = JSON.parse(response);
      parsedResponse.forEach(function (element) {
        tbody_profesores.append(`
              <tr>
              <td>${element.id}</td>
              <td>${element.nombre}</td>
              <td>${element.periodo_inicio}</td>
              <td>${element.periodo_fin}</td>
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