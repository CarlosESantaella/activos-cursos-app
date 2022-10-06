# Activos Cursos APP

## Instalación


Copiar y pegar las variables de entorno:
```
cp .env.sample .env
```

Cambiar las variables de entorno en caso de ser necesario:
```
#connection
DB_SERVER="localhost"
DB_NAME="activos_cursos"
DB_USER="root"
DB_PASS="password"
```

Instalar dependencias de composer
```
composer install
```

Entrar a MySQL y crear la base de datos:
```
sudo mysql
CREATE DATABASE activos_cursos;
```

Migrar estructura de la base de datos:
```
cd migrations
sudo mysql -u root -p activos_cursos < activos_cursos.sql
```