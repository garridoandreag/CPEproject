
# CPEproject - Sistema de Administración Escolar

**CPEproject** es una plataforma web integral diseñada para optimizar y digitalizar la gestión administrativa y académica de una institución educativa. El sistema permite centralizar la información de estudiantes, docentes, cursos y calificaciones en un solo lugar, facilitando la toma de decisiones y la comunicación interna.

## Características Principales

* **Gestión de Usuarios:** Control de acceso para administradores, profesores, alumnos y padres de familia.
* **Control Académico:** Administración de ciclos escolares, grados, secciones y asignaturas.
* **Inscripciones y Matrículas:** Registro digital de estudiantes y gestión de expedientes.
* **Control de Calificaciones:** Registro de notas por unidades/bimestres y generación de reportes de rendimiento.
* **Asistencia y Reportes:** Seguimiento de la asistencia diaria y generación de boletines escolares en formato PDF.

## Tecnologías Utilizadas

Este proyecto fue desarrollado utilizando un stack moderno para garantizar escalabilidad y rendimiento:

* **Frontend:**
* [HTML5](https://developer.mozilla.org/es/docs/Web/HTML) & [CSS3](https://developer.mozilla.org/es/docs/Web/CSS) - Estructura y diseño visual.
* [Bootstrap](https://getbootstrap.com/) - Framework para un diseño responsivo y adaptable a dispositivos móviles.
* [JavaScript (ES6+)](https://developer.mozilla.org/es/docs/Web/JavaScript) - Interactividad y validaciones dinámicas.


* **Backend:**
* [PHP](https://www.php.net/) - Lógica del lado del servidor.
* [Laravel](https://laravel.com/) - Framework para el manejo de rutas, MVC y seguridad.


* **Base de Datos:**
* [MySQL](https://www.mysql.com/) - Motor de base de datos relacional para el almacenamiento seguro de la información.


* **Herramientas y Otros:**
* [Composer](https://getcomposer.org/) - Manejo de dependencias.
* [Git/GitHub](https://github.com/) - Control de versiones.



## Instalación

Para ejecutar este proyecto de forma local, sigue estos pasos:

1. **Clonar el repositorio:**
```bash
git clone https://github.com/garridoandreag/CPEproject.git

```
2. **Configurar el entorno:**
* Importa la base de datos incluida en la carpeta `/database` o `sql` a tu servidor local (XAMPP, WAMP, Laragon).
* Configura las credenciales de conexión en el archivo de configuración (`config.php` o `.env`).
* 
3. **Ejecutar:**
* Copia la carpeta en el directorio `htdocs` o `www` de tu servidor.
* Accede a través de `http://localhost/CPEproject`.

## Licencia

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
