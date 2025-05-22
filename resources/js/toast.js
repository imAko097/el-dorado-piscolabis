import Toastify from "toastify-js";
import 'toastify-js/src/toastify.css';

function showToast(message, options = {}) {
    Toastify({
        text: message,
        duration: 3000,
        gravity: "bottom",
        position: "right",
        ...options,
    }).showToast();
}

// Toast que salta cuando un producto es agregado en el carrito
window.addEventListener('producto-agregado', event => {
    showToast(`Producto añadido: ${event.detail[0].nombre_producto}`, {
        style: {
            borderRadius: "12px",
            background: "linear-gradient(to right, #EAB308, #EAB308)",
            color: "#000",
        }
    });
});