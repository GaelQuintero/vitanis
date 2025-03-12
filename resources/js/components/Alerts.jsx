import React, { useState, useEffect } from "react";
import { formatDistanceToNow } from 'date-fns';
import { es } from 'date-fns/locale';
// import Alert from 'react-bootstrap/Alert';

const Alerts = () => {
    const [notificaciones, setNotificaciones] = useState([]);

    useEffect(() => {
        const fetchNotificaciones = async () => {
            try {
                const response = await fetch("/notificaciones", {
                    method: "GET",
                    headers: {
                        Accept: "application/json", // Asegura que el servidor devuelva JSON
                    },
                });

                if (!response.ok) {
                    throw new Error("Error en la respuesta del servidor");
                }

                const data = await response.json();
                console.log("Datos de notificaciones:", data); // Verifica los datos en la consola
                setNotificaciones(data);
            } catch (error) {
                console.error("Error al obtener las notificaciones:", error);
            }
        };
        fetchNotificaciones();
    }, []);

    const marcarComoLeido = async (notificacionId) => {
        try {
            const response = await fetch(
                `/notificaciones/${notificacionId}/leer`,
                {
                    method: "PATCH",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"), // Asegúrate de tener el token CSRF
                    },
                    body: JSON.stringify({
                        // Puedes pasar datos adicionales si es necesario
                    }),
                }
            );

            if (response.ok) {
                // Aquí actualizas el estado o la interfaz de usuario después de que la notificación se marque como leída
                console.log("Notificación marcada como leída");
            } else {
                console.error("Error al marcar la notificación como leída");
            }
        } catch (error) {
            console.error("Error al realizar la solicitud:", error);
        }
    };

    return (
        <div className="container p-4" data-bs-theme="dark">
            <div className="row">
                <div class="col-md-12 mb-3 text-end">
                    <a
                        class="btn btn-primary rounded-3"
                        href="{{ route('dashboard') }}"
                    >
                        Volver
                    </a>
                </div>
                <div class="col-md-12 mb-3 ">
                    <h4>Notificaciones 🛎️</h4>
                </div>
                <div>
                    {notificaciones.length > 0 ? (
                        <div className="list-group">
                            {notificaciones.map((notificacion, index) => (
                                <div
                                    key={index}
                                    className={`alert text-light-emphasis ${
                                        notificacion.read_at
                                            ? "alert-light"
                                            : "alert-primary"
                                    }`}
                                >
                                    <strong>{notificacion.data.title}</strong>
                                    <br />
                                    {notificacion.data.message} <br />
                                    {/* Formulario para marcar como leído */}
                                    <br />
                                    <div className="col-md-12">
                                        <form className="d-inline">
                                            <button
                                                onClick={() =>
                                                    marcarComoLeido(
                                                        notificacion.id
                                                    )
                                                }
                                                className={`btn btn-secondary btn-sm ${
                                                    notificacion.read_at
                                                        ? "visually-hidden"
                                                        : ""
                                                }`}
                                            >
                                                Marcar como leído
                                            </button>
                                        </form>
                                        <p className="text-muted">
                                        {notificacion.read_at && `Notificación leída ${formatDistanceToNow(new Date(notificacion.read_at), { locale: es, addSuffix: true })}`}
                                        </p>
                                    </div>
                                </div>
                            ))}
                        </div>
                    ) : (
                        <p className="text-center text-muted">
                            No hay notificaciones nuevas.
                        </p>
                    )}
                </div>
            </div>
        </div>
    );
};


export default Alerts;
