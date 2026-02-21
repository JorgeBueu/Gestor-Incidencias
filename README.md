🛠️ Gestor de Incidencias

📌 Sobre el Proyecto
Este es un sistema de gestión de tickets técnicos enfocado en la robustez del lado del servidor. El objetivo principal es aplicar patrones de diseño profesionales para garantizar un código escalable y limpio, alejándome del código "spaghetti" tradicional en PHP.

🏗️ Arquitectura y Patrones
Para este proyecto, he implementado una estructura basada en:

Modelo-Vista-Controlador (MVC): Separación clara entre la lógica de negocio, la presentación y el flujo de datos.

Patrón Repository: Capa intermedia entre el Modelo y la Base de Datos. Esto permite que la lógica de negocio no dependa directamente de SQL, facilitando futuros cambios de persistencia y mejorando la testabilidad.

🚀 Funcionalidades Actuales
CRUD Completo de Incidencias: Creación, lectura, edición y eliminación de tickets.

Ciclo de Vida: Capacidad de cerrar y reabrir incidencias de forma dinámica.

Filtrado Avanzado: Sistema de búsqueda por estado (Abiertas, Cerradas o Todas) procesado en el servidor.

Validación de Datos: Sanitización y validación de entradas para prevenir ataques como SQL Injection.

🛠️ Stack Tecnológico
Lenguaje: PHP

Base de Datos: MySQL

Frontend: HTML5, CSS3, JavaScript (Bootstrap para la interfaz).

Herramientas: Git para el control de versiones.

🚧 En Construcción (Roadmap)
El proyecto se encuentra en fase de desarrollo activo. Próximas implementaciones:

[ ] Sistema de Autenticación: Login seguro con roles de usuario/administrador.
