// document.addEventListener("DOMContentLoaded", () => {
//     console.log("Asignaturas JS cargado");

//     const modal = document.getElementById("asignatura-modal");
//     const modalBody = document.getElementById("asignatura-modal-content");
//     const closeBtn = document.getElementById("asignatura-modal-close");

//     // Abrir modal
//     function openModal(url) {
//         // Mostrar loader BEM
//         modalBody.innerHTML = `
//         <div class="modal-loader">
//             <div class="modal-loader__circle"></div>
//         </div>
//         `;

//         modal.classList.add("modal--visible");

//         setTimeout(() => {
//             fetch(url)
//                 .then((response) => response.text())
//                 .then((html) => {
//                     modalBody.innerHTML = html;
//                 })
//                 .catch(() => {
//                     modalBody.innerHTML = "<p>Error al cargar el contenido</p>";
//                 });
//         }, 400);
//     }

//     // Cerrar modal
//     function closeModal() {
//         modal.classList.remove("modal--visible");
//         modalBody.innerHTML = "";
//     }

//     // Botón X
//     closeBtn.addEventListener("click", closeModal);

//     // Click afuera para cerrar
//     modal.addEventListener("click", (e) => {
//         if (e.target === modal) {
//             closeModal();
//         }
//     });

//     // Delegación de eventos
//     document.addEventListener("click", (e) => {
//         if (e.target.classList.contains("js-ver")) {
//             AsignaturaModal.view(e.target.dataset.id);
//         }

//         if (e.target.classList.contains("js-editar")) {
//             AsignaturaModal.edit(e.target.dataset.id);
//         }
//     });

//     // Botón agregar asignatura
//     document
//         .getElementById("btnAgregarAsignatura")
//         .addEventListener("click", () => {
//             AsignaturaModal.add();
//         });

//     // Objeto global para manejar modales de asignaturas
//     window.AsignaturaModal = {
//         add: () => openModal("/asignaturas/modal/add"),
//         edit: (id) => openModal(`/asignaturas/modal/${id}/edit`),
//         view: (id) => openModal(`/asignaturas/modal/${id}/details`),
//     };
// });


document.addEventListener("DOMContentLoaded", () => {
    console.log("Asignaturas JS cargado");

    // --- VARIABLES DEL MODAL ---
    const modal = document.getElementById("asignatura-modal");
    const modalBody = document.getElementById("asignatura-modal-content");
    const closeBtn = document.getElementById("asignatura-modal-close");

    // --- FUNCIONES DE MODAL ---
    function openModal(url) {
        // Mostrar loader mientras carga
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
            AsignaturaModal.view(e.target.dataset.id);
        }

        if (e.target.classList.contains("js-editar")) {
            AsignaturaModal.edit(e.target.dataset.id);
        }
    });

    // Botón agregar asignatura
    document.getElementById("btnAgregarAsignatura")?.addEventListener("click", () => {
        AsignaturaModal.add();
    });

    // --- OBJETO GLOBAL DE MODALES ---
    window.AsignaturaModal = {
        add: () => openModal("/asignaturas/modal/add"),
        edit: (id) => openModal(`/asignaturas/modal/${id}/edit`),
        view: (id) => openModal(`/asignaturas/modal/${id}/details`),
    };

    // --- FUNCIONALIDAD HORARIOS Y VALIDACIÓN ---
    // Delegación de evento para checkboxes de días dentro de cualquier formulario dinámico
    document.addEventListener("change", function(e) {
        if (e.target.matches('.form__multi-dias input[type=checkbox]')) {
            const parent = e.target.closest('.form__dia');
            if (parent) {
                const horaInputs = parent.querySelectorAll('input[type=time]');
                horaInputs.forEach(input => {
                    input.disabled = !e.target.checked;
                    if (!e.target.checked) {
                        input.value = ''; // limpiar si se desmarca
                        input.classList.remove('form__input--error');
                    }
                });
            }
        }
    });

    // Validación de horarios antes de enviar cualquier formulario de asignaturas
    document.addEventListener('submit', function(e) {
        if (e.target.matches('form.form')) {
            let errores = 0;

            e.target.querySelectorAll('.form__multi-dias .form__dia').forEach(diaBlock => {
                const checkbox = diaBlock.querySelector('input[type=checkbox]');
                if (checkbox.checked) {
                    const horaInicio = diaBlock.querySelector('input[name^="horario[hora_inicio_]"]').value;
                    const horaFin    = diaBlock.querySelector('input[name^="horario[hora_fin_]"]').value;

                    // Validar que existan horas
                    if (!horaInicio || !horaFin) {
                        errores++;
                        diaBlock.querySelectorAll('input[type=time]').forEach(input => input.classList.add('form__input--error'));
                    } 
                    // Validar que hora inicio < hora fin
                    else if (horaInicio >= horaFin) {
                        errores++;
                        diaBlock.querySelectorAll('input[type=time]').forEach(input => input.classList.add('form__input--error'));
                    } 
                    // Si todo correcto, remover clase de error
                    else {
                        diaBlock.querySelectorAll('input[type=time]').forEach(input => input.classList.remove('form__input--error'));
                    }
                }
            });

            if (errores > 0) {
                e.preventDefault();
                alert('Por favor, verifica las horas de los días seleccionados.');
            }
        }
    });

});
