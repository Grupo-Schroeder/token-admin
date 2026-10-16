# Token Admin

Servidor central de autorización basado en **Laravel 13 + Laravel Passport**, diseñado para registrar aplicaciones y administrar la emisión y el ciclo de vida de tokens OAuth 2.0.

> **Estado:** desarrollo e integración. Antes de producción, revisar las tareas de seguridad de este documento.

## Funcionalidades

- Dashboard web para administrar aplicaciones, usuarios, tokens y logs.
- Alta y vinculación de clientes OAuth de Laravel Passport.
- Emisión de access tokens mediante OAuth 2.0 `client_credentials` para comunicación entre servicios.
- Desactivación de aplicaciones y regeneración de secretos de cliente.
- Registro de aplicaciones, clientes OAuth, tokens y eventos instrumentados.
- Endpoint de introspección propio para comprobar si un token está activo; debe restringirse a clientes autorizados antes de producción.

## Arquitectura

```text
                   ┌──────────────────────────┐
                   │ Dashboard Token Admin    │
                   │ Aplicaciones y tokens    │
                   └────────────┬─────────────┘
                                │
                                ▼
┌──────────────────────┐ OAuth 2.0 / Passport ┌──────────────────────┐
│ Servicio consumidor  │ ─ POST /oauth/token ►│ Token Admin          │
│ (cualquier tecnología)│ ◄── access_token ───│ Emisión y gestión    │
└──────────┬───────────┘                       └──────────────────────┘
           │
           └──── Bearer token ───► API protegida del sistema consumidor
```

Token Admin centraliza la gestión de clientes y tokens. Cada sistema integrado sigue siendo responsable de proteger sus propios endpoints y aplicar permisos de negocio: un token válido no concede automáticamente acceso irrestricto.

## Componentes y rutas principales

- `POST /oauth/token`: endpoint de Laravel Passport para emitir tokens.
- `POST /api/oauth/introspect`: endpoint propio de introspección en desarrollo; protegerlo antes de producción.
- `oauth_clients`: clientes OAuth administrados por Passport.
- `oauth_access_tokens`: tokens emitidos, expiración, scopes y estado de revocación.
- `applications`: registro funcional de aplicaciones administradas.
- `api_logs`: eventos que actualmente se registran mediante la instrumentación existente.

El dashboard incluye pestañas de Tokens, Usuarios, Aplicaciones y Logs.

## Flujo OAuth `client_credentials`

Este flujo es para comunicación máquina a máquina; no representa el inicio de sesión de un usuario final.

1. Crear o registrar una aplicación desde el dashboard.
2. Crear o vincular su cliente OAuth y obtener `client_id` y `client_secret`.
3. El servicio consumidor solicita un token a Token Admin.
4. Passport devuelve un `access_token`.
5. El consumidor envía el token a su API mediante `Authorization: Bearer <access_token>`.
6. La API consumidora valida el token según la integración implementada y aplica sus propios permisos.

### Solicitar un token

Reemplazar las credenciales de ejemplo por las de un cliente propio:

```bash
curl -X POST http://localhost:8000/oauth/token \
  -H "Accept: application/json" \
  -H "Content-Type: application/x-www-form-urlencoded" \
  --data-urlencode "grant_type=client_credentials" \
  --data-urlencode "client_id=TU_CLIENT_ID" \
  --data-urlencode "client_secret=TU_CLIENT_SECRET"
```

La respuesta contiene `access_token`, `token_type` y `expires_in`. La duración efectiva depende de la configuración de Passport.

## Requisitos

- Docker Engine y Docker Compose v2 (`docker compose`).
- El código fuente de Laravel 13 en el directorio del proyecto.
- Laravel Passport incluido en `composer.json` y configurado.
- Un archivo `.env` local configurado antes del primer arranque.

No hace falta instalar PHP, Composer ni PostgreSQL directamente en el host: se ejecutan en contenedores.

## Instalación y ejecución con Docker

1. Copiar `.env.example` a `.env` si todavía no existe:

   ```bash
   cp .env.example .env
   ```

2. Ajustar como mínimo las variables de aplicación y PostgreSQL. Con la configuración del `docker-compose.yml` incluido:

   ```dotenv
   APP_NAME="Token Admin"
   APP_ENV=local
   APP_DEBUG=true
   APP_URL=http://localhost:8000
   APP_KEY=

   DB_CONNECTION=pgsql
   DB_HOST=db
   DB_PORT=5432
   DB_DATABASE=token_admin
   DB_USERNAME=token_admin
   DB_PASSWORD=cambiar_esta_clave
   ```

   Usar la misma contraseña en `DB_PASSWORD` y `POSTGRES_PASSWORD` del `docker-compose.yml` o definir ambos valores en un archivo `.env` de Compose. No utilizar contraseñas de ejemplo en producción.

3. Construir e iniciar los servicios:

   ```bash
   docker compose up -d --build
   ```

4. Generar `APP_KEY` si está vacío:

   ```bash
   docker compose exec app php artisan key:generate
   ```

5. Aplicar migraciones:

   ```bash
   docker compose exec app php artisan migrate --force
   ```

6. Si las claves de Passport no existen, generarlas:

   ```bash
   docker compose exec app php artisan passport:keys
   ```

7. Consultar el estado y los logs:

   ```bash
   docker compose ps
   docker compose logs -f app
   docker compose logs -f db
   ```

Abrir el dashboard en [http://localhost:8000](http://localhost:8000).

> **Importante sobre la migración desde SQLite:** cambiar `DB_CONNECTION` a `pgsql` no copia los datos existentes. Hacer una copia de seguridad y planificar la transferencia de usuarios, aplicaciones, clientes y tokens antes de abandonar la base SQLite. No ejecutar `migrate:fresh` sobre una base con datos que se quieran conservar.

## Base de datos PostgreSQL

El servicio `db` usa una imagen oficial de PostgreSQL y un volumen Docker persistente llamado `postgres_data`. Los datos sobreviven al recrear el contenedor. `docker compose down -v` elimina también el volumen y, por lo tanto, los datos de la base: no usarlo salvo que se quiera borrar todo.

El contenedor Laravel se conecta a PostgreSQL por el nombre de servicio `db`, no por `localhost`.

## Comandos útiles

```bash
# Ver contenedores
docker compose ps

# Seguir logs de Laravel
docker compose logs -f app

# Ejecutar comandos Artisan
docker compose exec app php artisan route:list --path=oauth

docker compose exec app php artisan migrate:status

# Detener contenedores sin borrar los datos
docker compose down
```

## Seguridad antes de producción

- Configurar `APP_DEBUG=false`, una `APP_KEY` fuerte y HTTPS.
- No publicar PostgreSQL directamente en internet; el Compose propuesto no publica el puerto `5432` en el host.
- Cambiar contraseñas de ejemplo y no versionar `.env`, secretos ni tokens.
- Proteger `POST /api/oauth/introspect` para que solo clientes autorizados puedan invocarlo.
- Definir scopes, permisos y reglas de autorización por aplicación.
- Probar tokens válidos, expirados, revocados y clientes desactivados.
- No guardar secretos ni tokens completos en logs.
- Preparar backups y probar su restauración.
- Añadir servidor web/HTTPS, monitorización, límites de solicitudes y pruebas de seguridad antes del despliegue productivo. `php artisan serve` se usa aquí para desarrollo, no como servidor de producción.

