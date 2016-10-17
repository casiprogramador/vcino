##Instalacion
Para la instalacion primeramente clonar el sistema del repositorio.
> git clone https://github.com/pmarce/vcino.git

ingresar a la carpeta.
> ```cd vcino```

Actualizar dependencias.
> ```composer update```

Copiar el archivo de configuracion.
> ```copiar .env_example a .env```

Configurar base de datos.

Generamos la llave de seguridad.
> ```$ php artisan key:generate```

Creamos el esquema de la base de datos.
> ```$ php artisan migrate```

Creamos datos iniciales.
> ```$ php artisan db:seed```

Iniciamos el servidor.
> ```$ php aritsan serve```