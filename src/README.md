# 📊 Sistema de Gestión de Clientes (CRUD Nativo con PHP y MariaDB)

¡Bienvenido/a! Este proyecto consiste en un sistema funcional de gestión y administración de datos de clientes. El núcleo de la aplicación es un **CRUD completo** (Crear, Leer, Actualizar y Borrar) desarrollado utilizando **PHP nativo**, **PDO** para la manipulación segura de datos y **MariaDB/MySQL** como motor de persistencia relacional.

El diseño se ha estructurado utilizando código limpio, sin frameworks pesados ni dependencias externas de JavaScript o CSS de terceros, priorizando la comprensión de la arquitectura web nativa y los patrones de seguridad esenciales en el desarrollo backend.

---

## 🚀 Características Clave

- **Operaciones CRUD Completas:** Interfaz interactiva para dar de alta, listar en tiempo real, modificar campos específicos y eliminar registros de la base de datos.
- **Arquitectura Segura con PDO:** Mitigación total de ataques de **Inyección SQL** mediante la implementación estricta de Sentencias Preparadas (`prepare` y `execute`).
- **Seguridad en Visualización:** Blindaje contra ataques de Secuencia de Comandos en Sitios Cruzados (**XSS**) mediante el filtrado de variables con la función `htmlspecialchars()`.
- **Estructura Web Robusta:** Implementación del patrón de diseño web **PRG (Post-Redirect-Get)** para prevenir la duplicación accidental de formularios al refrescar la página con F5.
- **Interfaz Fluida y Limpia:** Estilizado modular e independiente a través de una hoja de estilos CSS externa centralizada (`style.css`), proporcionando un diseño adaptativo y centrado.

---

## 📂 Estructura del Repositorio

El proyecto mantiene una disposición clara y modularizada de sus componentes:

```text
├── init.sql               # Script de creación de la tabla y semillas de datos de prueba.
├── connection_db.php      # Archivo central de instanciación del objeto de conexión PDO.
├── index.php              # Interfaz principal (Formulario de inserción y tabla de listado).
├── insertar.php           # Script controlador encargado del procesamiento de altas (POST).
├── editar.php             # Formulario de modificación de datos y actualización (GET/POST).
├── eliminar.php           # Script controlador encargado del borrado seguro de registros (GET).
└── style.css              # Hoja de estilos de diseño unificada para toda la aplicación.