
### Seders
```bash
php artisan db:seed --class=ContrySeeder
```

```bash
php artisan db:seed --class=CitySeeder
```

```bash
php artisan db:seed --class=RoomSeeder
```


Si desea registrar un usuario debe registrar un servicio SMTP o deshabilitar la verificación de correo electrónico
Para deshabilitar la verificación de correo:
config/fortify.php linea 137
Comentar la línea
```bash
# Features::emailVerification(),
```
y en el Model/User quitar "implements MustVerifyEmail"
