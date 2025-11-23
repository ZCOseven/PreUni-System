document.addEventListener("DOMContentLoaded", () => {
    console.log("Matrículas JS cargado");

    // --- VARIABLES DEL MODAL ---
    const modal = document.getElementById("matricula-modal");
    const modalBody = document.getElementById("matricula-modal-content");
    const closeBtn = document.getElementById("matricula-modal-close");

    // --- FUNCIONES DE MODAL ---
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

    function closeModal() {
        modal.classList.remove("modal--visible");
        modalBody.innerHTML = "";
    }

    // --- EVENTOS DEL MODAL ---
    closeBtn.addEventListener("click", closeModal);

    // Cerrar modal al hacer click fuera del contenido
    modal.addEventListener("click", (e) => {
        if (e.target === modal) closeModal();
    });

    // Delegación de eventos para botones de ver y editar
    document.addEventListener("click", (e) => {
        if (e.target.classList.contains("js-ver")) {
            MatriculaModal.view(e.target.dataset.id);
        }

        if (e.target.classList.contains("js-editar")) {
            MatriculaModal.edit(e.target.dataset.id);
        }
    });

    // Botón agregar matrícula
    document.getElementById("btnAgregarMatricula")?.addEventListener("click", () => {
        MatriculaModal.add();
    });

    // --- OBJETO GLOBAL DE MODALES ---
    window.MatriculaModal = {
        add: () => openModal("/matriculas/modal/add"),
        edit: (id) => openModal(`/matriculas/modal/${id}/edit`),
        view: (id) => openModal(`/matriculas/modal/${id}/details`),
    };

    // --- FUNCIONALIDAD ADICIONAL (por ejemplo validaciones de formulario) ---
    // Si quieres agregar validaciones de campos, checkboxes, etc., se pueden agregar aquí
});
