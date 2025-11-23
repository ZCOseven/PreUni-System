document.addEventListener("DOMContentLoaded", () => {
    console.log("Docentes JS cargado");

    const modal = document.getElementById("docente-modal");
    const modalBody = document.getElementById("docente-modal-content");
    const closeBtn = document.getElementById("docente-modal-close");

    // Abrir modal (reutilizado para TODO)
    function openModal(url) {
        modalBody.innerHTML = `
        <div class="modal-loader">
            <div class="modal-loader__circle"></div>
        </div>
        `;

        modal.classList.add("modal--visible");

        setTimeout(() => {
            fetch(url)
                .then((response) => response.text())
                .then((html) => {
                    modalBody.innerHTML = html;
                })
                .catch(() => {
                    modalBody.innerHTML = "<p>Error al cargar el contenido</p>";
                });
        }, 400);
    }

    // Cerrar modal
    function closeModal() {
        modal.classList.remove("modal--visible");
        modalBody.innerHTML = "";
    }

    // Botón X
    closeBtn.addEventListener("click", closeModal);

    // Click afuera para cerrar
    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Delegación de eventos para botones dentro de la tabla
    document.addEventListener("click", (e) => {
        if (e.target.classList.contains("js-ver")) {
            DocenteModal.view(e.target.dataset.id);
        }

        if (e.target.classList.contains("js-editar")) {
            DocenteModal.edit(e.target.dataset.id);
        }

        // NUEVO: botón CURSOS ASIGNADOS
        if (e.target.classList.contains("js-cursos")) {
            DocenteModal.cursos(e.target.dataset.id);
        }
    });

    // Botón agregar docente
    document
        .getElementById("btnAgregarDocente")
        .addEventListener("click", () => {
            DocenteModal.add();
        });

    // Objeto global: ahora incluye cursos()
    window.DocenteModal = {
        add: () => openModal("/docentes/modal/add"),
        edit: (id) => openModal(`/docentes/modal/${id}/edit`),
        view: (id) => openModal(`/docentes/modal/${id}/details`),

        // NUEVO: cursos asignados
        cursos: (id) => openModal(`/docentes/${id}/cursos-asignados`),
    };
});
