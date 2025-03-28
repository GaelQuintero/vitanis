let inventarioDT;

document.addEventListener("DOMContentLoaded", async () => {
    initInventarioTable();
});

const initInventarioTable = async () => {
    inventarioDT = $("#table").DataTable({
        order: [],
        searching: false,
        responsive: true,
        theme: "base",
        language: {
            url: langFile,
        },
        columnDefs: [
            {
                orderable: false,
                targets: [6],
            },
        ],
        ajax: {
            url: route("inventario.index"),
            type: "GET",
            headers: {
                "X-CSRF-TOKEN": $("#csrf").attr("content"),
                Accept: "application/json",
            },
            data: (d) => {
                d.producto = $("#producto").val();
                d.codigo = $("#codigo").val();
                d.categoria_id = $("#categoria_id").val();
                return d;
            },
        },
        columns: [
            {
                data: "nombre",
                defaultContent: "",
                render: (data) => data ?? "",
            },
            {
                data: "descripcion",
                defaultContent: "",
                render: (data) => data ?? "",
            },
            {
                data: "codigo",
                defaultContent: "",
                render: (data) => data ?? "",
            },
            {
                data: "cantidad_actual",
                defaultContent: "",
                render: (data) => data ?? "",
            },
            {
                data: "precio",
                defaultContent: "",
                render: (data) => data ?? "",
            },
            {
                data: "categoria.nombre",
                defaultContent: "",
                render: (data) => data ?? "",
            },
            {
                data: null,
                render: (d) => {
                    if (currentUserRol === 2) {
                        return '';
                    }
                    
                    return `
                        <button type="button" class="btn btn-primary" title="Editar" onclick="editar(${d.id})">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button type="button" class="btn btn-danger" title="Eliminar" onclick="eliminar(${d.id})">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>`;
                }
            },
        ],
    });
};

const buscarBtn = document.getElementById("buscarBtn");
buscarBtn.addEventListener("click", function () {
    inventarioDT.ajax.reload();
});

const limpiarBtn = document.getElementById("limpiarBtn");
limpiarBtn.addEventListener("click", function () {
    filterForm.reset();
    inventarioDT.ajax.reload();
});

const nuevoBtn = document.getElementById("nuevoBtn");
nuevoBtn.addEventListener("click", async function () {
    try {
        const url = route("inventario.create");
        const req = await fetch(url);
        if (!req.ok) {
            throw new Error("Error al realizar la solicitud");
        }
        // crear el modal nuevo
        const modal = new bootstrap.Modal(document.getElementById("modal"));

        // Obtener la respuesta como texto
        const view = await req.text();

        // Indicar la medida del modal
        document.getElementById("modalSize").classList.remove("modal-xl");

        // Indicar el titulo del modal
        document.getElementById("modalTitle").innerHTML =
            "Inventario | Registrar";

        // Indicar el cuerpo del modal
        document.getElementById("modalBody").innerHTML = view;
        // Show the modal
        modal.toggle();
    } catch (error) {
        console.error("Error al abrir el modal:", error);

        Swal.fire({
            icon: "error",
            text: "Ocurrió un error al abrir el modal. Intente nuevamente.",
        });
    }
});

const registrar = async () => {
    event.preventDefault();
    Swal.fire({
        title: "Registrando",
        text: "Espera un momento por favor...",
        didOpen: () => Swal.showLoading(),
    });
    // URL para registrar
    const url = route("inventario.store");
    // Tomar el formulario de registro por si id
    const form = document.getElementById("registroProductoForm");
    // Crear un objeto formData
    const formData = new FormData(form);
    // Indicar el metodo a usar
    const init = setMethodHeaders("POST", formData);
    try {
        // Hacer el request
        const req = await fetch(url, init);
        // Parsear la respuesta
        const res = await req.json();
        // Checar si el request fue exitoso
        if (req.ok) {
            // Mostrar alerta de registro exitoso
            Swal.fire({
                icon: "success",
                text: res.message || "Se registró correctamente.",
            });
            $(".modal").modal("hide");
            inventarioDT.ajax.reload();
        } else {
            let errorMessage =
                res.message || "Ocurrió un error durante el registro.";

            // Verificar si hay errores de validación
            if (res.errors) {
                errorMessage +=
                    "\n" + Object.values(res.errors).flat().join("\n");
            }

            Swal.fire({
                icon: "error",
                title: "Error!",
                text: errorMessage,
            });
        }
    } catch (error) {
        // Si hay un problema con el request
        Swal.fire({
            icon: "error",
            title: "Error de Conexión!",
            text: "No se pudo conectar con el servidor, intenta de nuevo.",
        });
    }
};

const editar = async (id) => {
    event.preventDefault();
    try {
        // Asignamos la ruta
        const url = route("inventario.edit", id);

        // Hacemos el request
        const req = await fetch(url);

        // Verificamos si la respuesta fue exitosa
        if (!req.ok) {
            throw new Error("Error al realizar la solicitud.");
        }

        // Create a new modal
        const modal = new bootstrap.Modal(document.getElementById("modal"));

        // Get the response as text
        const view = await req.text();

        // Set modal size
        document.getElementById("modalSize").classList.remove("modal-xl");

        // Set modal title
        document.getElementById("modalTitle").innerHTML = "Sucursal | Editar";

        // Set the modal's body to the view
        document.getElementById("modalBody").innerHTML = view;
        // Show the modal
        modal.toggle();
    } catch (error) {
        console.error("Error al abrir el modal:", error);

        // Mostrar un mensaje de error o alguna alerta si la solicitud falla
        alert("Ocurrió un error al abrir el modal. Intente nuevamente.");
    }
};

const update = async (id) => {
    event.preventDefault();
    Swal.fire({
        title: "Actualizando",
        text: "Espera un momento por favor...",
        didOpen: () => Swal.showLoading(),
    });

    // URL para registrar
    const url = route("inventario.update", id);
    // Tomar el formulario de registro por si id
    const form = document.getElementById("editForm");
    // Crear un objeto formData
    const formData = new FormData(form);
    // Indicar el metodo a usar
    const init = setMethodHeaders("PUT", formData);

    try {
        // Hacer el request
        const req = await fetch(url, init);
        // Parsear la respuesta
        const res = await req.json();
        // Checar si el request fue exitoso
        if (req.ok) {
            // Mostrar alerta de registro exitoso
            Swal.fire({
                icon: "success",
                text: res.message || "Se editó correctamente.",
            });
            $(".modal").modal("hide");
            inventarioDT.ajax.reload();
        } else {
            let errorMessage =
                res.message || "Ocurrió un error durante el registro.";

            // Verificar si hay errores de validación
            if (res.errors) {
                errorMessage +=
                    "\n" + Object.values(res.errors).flat().join("\n");
            }

            Swal.fire({
                icon: "error",
                title: "Error!",
                text: errorMessage,
            });
        }
    } catch (error) {
        // Si hay un problema con el request
        Swal.fire({
            icon: "error",
            title: "Error de Conexión!",
            text: "No se pudo conectar con el servidor, intenta de nuevo.",
        });
    }
};

const eliminar = async (id) => {
    event.preventDefault();
    Swal.fire({
        title: "¿Seguro que desea eliminar este registro?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Eliminar",
        confirmButtonColor: "#cb4335",
        cancelButtonText: "Cancelar",
    }).then(async (result) => {
        if (result.isConfirmed) {
            const url = route("inventario.destroy", id);
            const init = setMethodHeaders("DELETE");
            const req = await fetch(url, init);
            try {
                const res = await req.json();
                if (req.ok) {
                    Swal.fire({
                        icon: "success",
                        text: res.message || "Registro eliminado",
                    });
                    $(".modal").modal("hide");
                    inventarioDT.ajax.reload();
                } else {
                    // If there were validation errors or other issues
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text:
                            res.message ||
                            "Ocurrió un error durante el registro.",
                    });
                }
            } catch (error) {
                // If there was a problem with the request itself (e.g., network issues)
                Swal.fire({
                    icon: "error",
                    title: "Error de Conexión!",
                    text: "No se pudo conectar con el servidor, intenta de nuevo.",
                });
            }
        }
    });
};
