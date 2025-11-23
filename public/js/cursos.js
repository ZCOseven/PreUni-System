document.addEventListener("DOMContentLoaded", () => {
    console.log("Cursos JS cargado");

    const modal = document.getElementById("curso-modal");
    const modalBody = document.getElementById("curso-modal-content");
    const closeBtn = document.getElementById("curso-modal-close");

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

    // Delegación de eventos en tabla dinámica
    document.addEventListener("click", (e) => {
        if (e.target.classList.contains("js-editar")) {
            CursoModal.edit(e.target.dataset.id);
        }
    });

    // Botón agregar curso
    document
        .getElementById("btnAgregarCurso")
        .addEventListener("click", () => {
            CursoModal.add();
        });

    // Objeto global para manejar modales de cursos
    window.CursoModal = {
        add: () => openModal("/cursos/modal/add"),
        edit: (id) => openModal(`/cursos/modal/${id}/edit`),
        // Por ahora no hay "ver detalles", pero se deja preparado
        view: (id) => openModal(`/cursos/modal/${id}/details`),
    };
});
