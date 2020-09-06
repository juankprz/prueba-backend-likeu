# Prueba de Ingreso Likeu Desarrollador Backend

_En este proyecto de software(Construccion de una API) se coloca a prueba las destrezas y capacidades del desarrollador backend, en la cual se debe crear una API con metodos de autenticacion y  gestion de agendas y clientes._

# Comenzando 🚀


_Como punto de partida  se debe contar con el gestor de dependicias para php llamado composer y el gestor de dependencias de node npm si no lo tiene , dejo link donde se podra conseguir _

```
https://getcomposer.org/

https://nodejs.org/es/
```

Para empezar se debe  clonar  el proyecto desde el repositorio de codigo  Asi 

```
git clone https://github.com/juankprz/prueba-backend-likeu.git
```
Luego acceder al directorio donde se descargo el proyecto, luego instalar las dependencias  Asi: 

```
composer install

npm install
npm run dev
```
Comandos de configuracion 
```
cp .env.example  .env
php artisan migrate --seed
php artisan key:generate
php artisan l5-swagger:generate 
php artisan  jwt:secret 
```
Verificar si en el archivo de configuracion se creo la variable jwt secret de lo contrario agregar en .env
```
JWT_SECRET=
```

Las rutas de documentacion en entorno local son
```
http://127.0.0.1:8000/api/documentation
```

los accesos de usuarios son:

```
email: admin1@likeu.test
password:likeu@123

email: admin2@likeu.test
password:likeu@123
```

para mas informacion puede mirar los archivos seeder