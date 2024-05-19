
# Proyecto Laravel: Control de Finanzas

## Instalación

1. Dirígete a la terminal en el directorio del proyecto y ejecuta el siguiente comando para instalar las dependencias necesarias:
    ```bash
    composer install
    ```

2. Crea la base de datos en MySQL con el nombre `control_finanzas`.

3. Importa la base de datos utilizando el archivo `control_finanzas.sql` incluido en el proyecto.

4. Configura el archivo `.env` del proyecto con los detalles de la base de datos:
    - Nombre de la base de datos (`DB_DATABASE`)
    - Usuario de la base de datos (`DB_USERNAME`)
    - Contraseña de la base de datos (`DB_PASSWORD`)

## Configuración

1. Abre el proyecto en Visual Studio Code.

2. En la terminal de Visual Studio Code, ejecuta el siguiente comando para regenerar el archivo de autoloading de clases de Composer:
    ```bash
    composer dump-autoload
    ```

3. Luego, ejecuta el siguiente comando para optimizar el rendimiento de la aplicación:
    ```bash
    php artisan optimize
    ```

4. Finalmente, ejecuta el servidor para lanzar la aplicación con el siguiente comando:
    ```bash
    php artisan serve
    ```

## Acceso al Sistema

- **Correo:** admin@gmail.com
- **Contraseña:** 12345678

---

¡Listo! Ahora puedes comenzar a trabajar con tu proyecto Laravel: Control de Finanzas.
