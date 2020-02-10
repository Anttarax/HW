Telepítési útmutató:

Nyisd meg a mellékelt HW.zip fájlt.

Az "Adatbázis import fájlok" mappában találsz 2 darab SQL fájlt. Hozz létre egy MySQL adatbázist,
majd az (PhpMyAdmin) "Importálás" fülön válaszd ki a fájlokat és végezd el az importálást.

A "Tartalmát laravel mappába" mappa tartalmát másold be egy laravel project mappájába.


Másold be a web.php fájl tartalmát a routes/web.php fájlba, vagy pedig írd felül azt.



Később az általam készített fájlok törléséhez:
---------------------------------------------
                                            |
app/http/Controllers/hwController.php       |
                                            |
public/main.js                              |
                                            |
resources/views/hw.blade.php                |
                                            |
---------------------------------------------

Laravel project telepítés menete:
Telepítsd a composert.
Nyisd meg a CMD-t
Navigálj egy mappába, például 
D:
cd D:\xampp\htdocs\mappanév vagy más elérési út.

composer create-project --prefer-dist laravel/laravel blog

Laravel indítás
CMD
Laravel project mappába navigálás után
php artisan serve
vagy
php artisan serve --host IP --port=8000