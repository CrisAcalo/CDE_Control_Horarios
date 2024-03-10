document.addEventListener("DOMContentLoaded", function () {
  cargarCursos();
});

function cargarCursos() {
  let materias_container = $("#materias_container");
  materias_container.empty();
  $.ajax({
    url: "../Controller/CursoController.php?function=getAll",
    method: "POST",
    success: function (response) {
      let parsedResponse = JSON.parse(response);
      parsedResponse.forEach(function (element) {
        materias_container.append(`
        <div class="materia_element mb-2">
            <div class="materia_element_data">
                <div class="materia_element_data_text">
                    <p class="m-0 fw-bold fs-5 text-center"><span class="">${element.data.materia[0].nombre}</span></p>
                    <p class="m-0 fw-bold fs-5 text-center"><span class="">${element.nrc}</span></p>
                    <p class="m-0 fw-bold">Profesor: <span class="fw-normal">${element.data.profesor[0].nombre}</span></p>
                    <p class="m-0 fw-bold">Carrera: <span class="fw-normal">${element.data.carrera[0].nombre}</span></p>
                    <p class="m-0 fw-bold">Periodo: <span class="fw-normal">${element.data.periodo[0].nombre}</span></p>
                </div>
            </div>
        </div>
        `);
      });
    },
    error: function (xhr, textStatus, errorThrown) {
      console.error(xhr.status + errorThrown + xhr.responseText);
    },
  });
}
