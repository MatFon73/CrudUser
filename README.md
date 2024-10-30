# Crud - Usuarios

## Descripción del Proyecto

Este proyecto es una aplicación web básica de gestión de usuarios utilizando HTML, CSS, JavaScript y PHP. Permite realizar operaciones CRUD (Crear, Leer, Actualizar, Eliminar) sobre una base de datos de usuarios. La aplicación se conecta a una base de datos MySQL, donde los usuarios pueden ser agregados, editados o eliminados fácilmente a través de un interfaz intuitiva. El diseño se realiza con HTML y CSS, mientras que la lógica del backend se maneja con PHP, asegurando una experiencia fluida en la manipulación de datos. Este proyecto es ideal para aprender sobre la interacción entre el frontend y el backend, así como para practicar el uso de bases de datos en aplicaciones web.

## Contacto

Puedes seguirme en Twitter (no le dire X):

## Autor
- `Mateo Fonseca` -  `MatFon73`
 
[![Twitter](https://img.shields.io/badge/Twitter-1DA1F2?style=for-the-badge&logo=twitter&logoColor=white)](https://twitter.com/MatFon73)

## Requisitos del Sistema

- Un navegador actualizado a la última versión.

## Instalación

Sigue estos pasos para instalar y configurar el proyecto en un entorno de desarrollo local:

1. **Clona el repositorio:**

    ```bash
    git clone https://github.com/MatFon73/CrudUser.git

    cd CrudUser
    ```

2. **Instalar las dependencias:**
    ```bash
    composer install
    ```

## Dependencias

El proyecto utiliza las siguientes librerías y frameworks:

[![SweetAlert](https://img.shields.io/badge/SweetAlert-11.14.0-blue?style=for-the-badge)](https://sweetalert.js.org/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.3-purple?style=for-the-badge)](https://getbootstrap.com/)
[![jQuery](https://img.shields.io/badge/jQuery-3.7.1-blue?style=for-the-badge)](https://jquery.com/)
[![FontAwesome](https://img.shields.io/badge/FontAwesome-6.6.0-blue?style=for-the-badge)](https://fontawesome.com/)

## Imagen Del Software

![Software](https://i.ibb.co/t4Q15gY/software.png)

## Estructura del Proyecto

El proyecto tiene la siguiente estructura de directorios y archivos:

```
CrudUser/
├── app/
│ ├── controller/
│ │ └──Crud_controller.php
│ ├── Connection.php
│ ├── .env
│ └── Execute_controller.php
├── data/
│ └── cruduser.sql
├── public/
│ ├── css/
│ │ └── style.css
│ ├── js/
│ │ └── CrudUser.js
├── index.html
├── README.md
├── .gitignore
├── LICENSE.md
├── composer.json
└── composer.lock
```

### Descripción de Directorios

- **app/**: Contiene la lógica de la aplicación.
- **data/**: Almacena datos en formato SQL, como la base de datos.
- **public/**: Contiene los archivos públicos accesibles desde el navegador, incluyendo CSS, JS, y secciones HTML.
- **vendor/**: Directorio que contiene las dependencias del proyecto instaladas vía npm.

## Licencia

Este proyecto está licenciado bajo los términos de la licencia [ISC](LICENSE).
