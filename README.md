## Prueba Técnica

Prueba técnica haciendo uso de:

- PHP
- Doctrine
- PHPUnit
- MySQL

## Requisitos

- Instalación de Docker

## Instalación

Pasos para configurar el proyecto:

Paso 1: Clonar el repositorio
git clone https://github.com/mdriveralv/prueba-tecnica-php-marvinrivera.git

Paso 2: Navegar al directorio del proyecto
cd prueba-tecnica-php-marvinrivera

Paso 3: Inicializar contenedores
docker compose up

Paso 4: Obtener el ID del contenedor testPHP
docker ps -a

Paso 5: Acceder a la sesión shell del contenedor testPHP
docker exec -it [ID del Contenedor] /bin/bash

Paso 6: Crear base de datos a partir de entidades definidas con Doctrine
make create-database

Paso 7: Ejecutar pruebas unitarias y de integración
make test
