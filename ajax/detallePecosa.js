// $(document).ready(function () {
//     let tableBody = document.getElementById("tableProductos").querySelector("tbody");

// // nuva pecosa - abrir modal
//     $(document).off("click", "#btnAgregarProducto").on("click", "#btnAgregarProducto", function(e) {
//         e.preventDefault();
//         alert("HOLA");
//         let descripcionProducto = document.getElementById("cboProducto").value;
//         let prioridad = document.getElementById("cboPrioridad").value;
//         let newRow = document.createElement("tr");

//         // Crear celdas
//         let celdaDescripcionProducto = document.createElement("td");
//         celdaDescripcionProducto.textContent = descripcionProducto;

//         let celdaPrioridadProducto = document.createElement("td");
//         celdaPrioridadProducto.textContent = prioridad; // Usar el valor del select

//         // Agregar las celdas a la fila
//         newRow.appendChild(celdaDescripcionProducto);
//         newRow.appendChild(celdaPrioridadProducto);

//         // Agregar la fila al cuerpo de la tabla
//         tableBody.appendChild(newRow);


//     });
// })

// $(document).ready(function () {
//     let tableBody = document.getElementById("tableProductosDetalles"); // Cuerpo de la tabla
//     let productosSeleccionados = []; // Arreglo para almacenar los datos esenciales

//     // Evento para agregar productos a la tabla
//     $(document).off("click", "#btnAgregarProducto").on("click", "#btnAgregarProducto", function (e) {
//         e.preventDefault();

//         // Obtener valores de los campos del formulario
//         const cboProducto = document.getElementById("cboProducto");
//         const idProducto = cboProducto.value; // ID del producto (value del select)
//         const descripcionProducto = cboProducto.options[cboProducto.selectedIndex].text; // Nombre del producto

//         const prioridad = document.getElementById("cboPrioridad").value;
//         const fechaDesde = document.getElementById("fechaDesde").value;
//         const fechaHasta = document.getElementById("fechaHasta").value;
//         const cantidad = document.getElementById("cantidad").value;
//         const precioUnitario = document.getElementById("precioUnitario").value;

//         // Validar que los campos obligatorios estén llenos
//         if (!idProducto || !prioridad || !fechaDesde || !fechaHasta || !cantidad || !precioUnitario) {
//             alert("Por favor, complete todos los campos obligatorios.");
//             return;
//         }

//         // Crear una nueva fila en la tabla
//         const newRow = document.createElement("tr");
//         newRow.innerHTML = `
//             <td>${idProducto}</td>
//             <td>${descripcionProducto}</td>
//             <td>${prioridad}</td>
//             <td>${fechaDesde}</td>
//             <td>${fechaHasta}</td>
//             <td>${cantidad}</td>
//             <td>${precioUnitario}</td>
//             <td><button class="btn btn-danger btn-sm btnEliminar">Eliminar</button></td>
//         `;

//         // Agregar la fila al cuerpo de la tabla
//         tableBody.appendChild(newRow);

//         // Agregar los datos al arreglo
//         productosSeleccionados.push({
//             idProducto: idProducto,
//             prioridad: prioridad,
//             fechaDesde: fechaDesde,
//             fechaHasta: fechaHasta,
//             cantidad: cantidad,
//             precioUnitario: precioUnitario,
//         });

//         console.log("Productos seleccionados:", productosSeleccionados);
//     });

//     // Evento para eliminar una fila
//     $(document).off("click", ".btnEliminar").on("click", ".btnEliminar", function (e) {
//         e.preventDefault();

//         const row = e.target.closest("tr"); // Fila a eliminar
//         const idProducto = row.cells[0].textContent; // ID del producto (columna 1)

//         // Remover la fila de la tabla
//         row.remove();

//         // Eliminar del arreglo
//         productosSeleccionados = productosSeleccionados.filter(item => item.idProducto !== idProducto);

//         console.log("Productos seleccionados tras eliminación:", productosSeleccionados);
//     });
// });