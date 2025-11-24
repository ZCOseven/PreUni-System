document.addEventListener("DOMContentLoaded", () => {

    const modal = document.getElementById("alumno-modal");
    const modalBody = document.getElementById("alumno-modal-content");
    const closeBtn = document.getElementById("alumno-modal-close");

    // Abrir modal
    function openModal(url) {
        // Mostrar loader BEM
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

    document.addEventListener("click", (e) => {
        if (e.target.classList.contains("js-ver")) {
            AlumnoModal.view(e.target.dataset.id);
        }

        if (e.target.classList.contains("js-editar")) {
            AlumnoModal.edit(e.target.dataset.id);
        }
    });

    document
        .getElementById("btnAgregarAlumno")
        .addEventListener("click", () => {
            AlumnoModal.add();
        });

    // Para futuros módulos: Añadir event delegation si se usa tabla dinámica

    window.AlumnoModal = {
        add: () => openModal("/alumnos/modal/add"),
        edit: (id) => openModal(`/alumnos/modal/${id}/edit`),
        view: (id) => openModal(`/alumnos/modal/${id}/details`),
    };
});
