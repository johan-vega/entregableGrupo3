# Despliegue en InfinityFree

Esta app Laravel puede publicarse en InfinityFree subiendo el proyecto completo dentro de `htdocs` y usando un `.htaccess` en la raiz de `htdocs` para reenviar todo hacia `public`.

## 1. Preparar el proyecto localmente

Antes de subir archivos:

1. Ejecuta `composer install --no-dev`.
2. Ejecuta `npm install`.
3. Ejecuta `npm run build`.
4. Verifica que exista la carpeta `vendor/`.
5. Verifica que exista `public/build/`.
6. No subas `node_modules/`.

## 2. Estructura en InfinityFree

Dentro de `htdocs` debes dejar algo asi:

```text
htdocs/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env
└── .htaccess
```

No reemplaces `public/.htaccess`. Laravel ya trae ese archivo y debe quedarse como esta.

## 3. .htaccess de htdocs

En `htdocs/.htaccess` pega este contenido:

```apache
RewriteEngine On

# Si usas archivos publicos de Laravel, deja esta regla antes del catch-all.
RewriteRule ^storage/(.*)$ /storage/app/public/$1 [L]

# Reenvia todas las peticiones al front controller dentro de /public.
RewriteRule (.*) /public/$1 [L]
```

En este repo tienes el mismo contenido en [.htaccess.infinityfree.example](/C:/xampp/htdocs/citas-grupo3/.htaccess.infinityfree.example).

## 4. Variables .env recomendadas

Usa un `.env` de produccion parecido a este:

```env
APP_NAME="SANAR+"
APP_ENV=production
APP_KEY=tu_app_key_generada_localmente
APP_DEBUG=false
APP_URL=https://entregable-grupo3.infinityfreeapp.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=tu_host_mysql_de_infinityfree
DB_PORT=3306
DB_DATABASE=tu_base_de_datos
DB_USERNAME=tu_usuario_bd
DB_PASSWORD=tu_password_bd

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

CACHE_STORE=file
QUEUE_CONNECTION=sync
FILESYSTEM_DISK=local

GOOGLE_CLIENT_ID=tu_google_client_id
GOOGLE_CLIENT_SECRET=tu_google_client_secret
GOOGLE_REDIRECT_URI=https://entregable-grupo3.infinityfreeapp.com/auth/google/callback

GITHUB_CLIENT_ID=tu_github_client_id
GITHUB_CLIENT_SECRET=tu_github_client_secret
GITHUB_REDIRECT_URI=https://entregable-grupo3.infinityfreeapp.com/auth/github/callback
```

## 5. OAuth de Google

En Google Cloud Console:

1. Ve a `APIs & Services` > `Credentials`.
2. Abre tu cliente OAuth tipo `Web application`.
3. En `Authorized redirect URIs` agrega:
   `https://entregable-grupo3.infinityfreeapp.com/auth/google/callback`
4. Si te pide origen, agrega:
   `https://entregable-grupo3.infinityfreeapp.com`

## 6. OAuth de GitHub

En GitHub:

1. Ve a `Settings` > `Developer settings` > `OAuth Apps`.
2. Abre tu aplicacion.
3. En `Authorization callback URL` coloca:
   `https://entregable-grupo3.infinityfreeapp.com/auth/github/callback`

## 7. Base de datos

InfinityFree no permite correr `php artisan migrate` en el servidor, asi que:

1. Corre migraciones localmente.
2. Exporta tu base de datos local a `.sql`.
3. Crea la base de datos MySQL en InfinityFree.
4. Importa el `.sql` desde phpMyAdmin.

## 8. Checklist final

Antes de abrir el dominio:

1. `APP_URL` apunta al dominio final con `https`.
2. `APP_DEBUG=false`.
3. `.env` fue subido a `htdocs`.
4. `vendor/` fue subido completo.
5. `public/build/` fue subido completo.
6. `htdocs/.htaccess` existe.
7. `public/.htaccess` sigue presente.
8. La base de datos ya fue importada.
9. Los callbacks de Google y GitHub coinciden exactamente con el dominio final.
10. Entras a `https://entregable-grupo3.infinityfreeapp.com/` y ves el login.

## 9. Si sale error 500

Revisa primero:

1. Credenciales MySQL del `.env`.
2. Que `vendor/` se haya subido completo.
3. Que `public/build/manifest.json` exista.
4. Que el `.htaccess` de `htdocs` este bien copiado.
5. Que `APP_KEY` no este vacio.

## Fuentes

- [InfinityFree Laravel guide](https://forum.infinityfree.com/t/how-to-install-a-laravel-site-on-infinityfree/118578)
- [InfinityFree .env example](https://forum.infinityfree.com/t/setting-up-env-accordingly-to-infinity-hosting/27197)
- [Google OAuth web server apps](https://developers.google.com/identity/protocols/oauth2/web-server)
- [GitHub OAuth callback URL rules](https://docs.github.com/en/apps/oauth-apps/building-oauth-apps/authorizing-oauth-apps)
