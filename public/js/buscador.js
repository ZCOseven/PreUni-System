// document.addEventListener("keyup", e => {
//     if (e.target.matches("#buscador")) {

//         if (e.key === "Escape") e.target.value = ""

//         document.querySelectorAll(".registro").forEach(producto => {
//             producto.textContent.toLowerCase().includes(e.target.value.toLowerCase())
//                 ? producto.classList.remove("filtro")
//                 : producto.classList.add("filtro")
//         })
//     }
// })

document.addEventListener("keyup", e => {
    if (e.target.matches("#search")) {

        if (e.key === "Escape") e.target.value = ""

        const filas = document.querySelectorAll(".registro")
        const filaNoResult = document.getElementById("no-result")

        let coincidencias = 0

        filas.forEach(producto => {
            const coincide = producto.textContent.toLowerCase().includes(e.target.value.toLowerCase())
            
            if (coincide) {
                producto.classList.remove("filtro")
                coincidencias++
            } else {
                producto.classList.add("filtro")
            }
        })

        // Mostrar u ocultar la fila de "no resultados"
        if (coincidencias === 0) {
            filaNoResult.style.display = ""
        } else {
            filaNoResult.style.display = "none"
        }
    }
})
