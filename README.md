# CaféAroma. Proyecto base de la UT2

Estado final de la UT1: la web corporativa de CaféAroma servida por **nginx + PHP-FPM + MariaDB**.

## Puesta en marcha

```bash
cp .env.example .env  # y cambia las contraseñas
docker compose up -d --build
docker compose ps  # db debe aparecer como (healthy)
```

| URL | Qué muestra |
| --- | --- |
| http://localhost:8080 | Portada de CaféAroma |
| http://localhost:8080/catalogo.php | Productos leídos desde MariaDB |
| http://localhost:8080/contacto.php | Formulario que guarda en `mensajes_contacto` |
| http://localhost:8081 | Adminer (servidor `db`) |

## Estructura

```text
CafeAroma/
├── compose.yaml
├── .env.example          # variables necesarias (copiar a .env)
├── db/init/
│   └── 01-cafearoma.sql  # tablas y productos: se ejecuta la PRIMERA vez que arranca MariaDB
├── nginx/default.conf    # server {} de la web: estático + PHP-FPM
├── php/Dockerfile        # php:8.3-fpm-alpine + pdo_mysql + mysqli
└── web/                  # index.html, catalogo.php, contacto.php, estilos.css, 404/50x
```

## Diferencias con lo visto en la UT1

- Las tablas `productos` y `mensajes_contacto` ya no se crean a mano: las crea
  `db/init/01-cafearoma.sql` al inicializar el volumen `dbdata`. Si ya tenías el volumen
  creado, el script no se vuelve a ejecutar (`docker compose down -v` para empezar de cero).
- El HTTPS de la última sesión de la UT1 no está incluido: lo configuraremos al final de la UT2
  para los tres sitios a la vez (web, blog y wiki).
- `name: cafearoma` fija el nombre del proyecto Compose: contenedores, red y volúmenes se llaman
  `cafearoma-*` / `cafearoma_*` aunque renombres la carpeta.
