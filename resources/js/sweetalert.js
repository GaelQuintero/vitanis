import Swal from "sweetalert2";
import "@sweetalert2/theme-dark/dark.css"; // Importa el tema oscuro

//Solo funciona si se corre vite con npm run dev
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    theme: 'auto', //Aplica blanco o oscuro depende del tema del navegador
});

window.Swal = Swal; // Para poder usarlo en toda la app
window.Toast = Toast;
