import './bootstrap';
import Alpine from 'alpinejs';
import React from 'react';
import ReactDOM from 'react-dom/client';
import Alerts from './components/Alerts'; 
// import Spinner from './components/Spinner';




const rootElement = document.getElementById('app');
const root = ReactDOM.createRoot(rootElement);

root.render(
  <React.StrictMode>
    <Alerts />
  </React.StrictMode>
)


// const globalSpinner = document.getElementById('spinner');
// const rootSpinner = ReactDOM.createRoot(globalSpinner);

// rootSpinner.render(
//   <React.StrictMode>
//     <Spinner />
//   </React.StrictMode>
// )
// window.Alpine = Alpine;

// Alpine.start();


// Si quiero continuar con la sincronizacion de datos entre indexedDB y laravel cuando vuelva la conexion pero ten encuenta que cuando quiero mandar correos lo hago de forma en database
//    public function via($notifiable)
//     {
//         return ['database', 'mail']; // Guardar en la base de datos y enviar al correo
//     }

// y uso QUEUE_CONNECTION=sync
// para evitar ejecutar un comando cada ves que inicio la app
// uso notificaciones de laravel

// no estoy usando react
// uso solo laravel 11, mysql, blade y boostrap