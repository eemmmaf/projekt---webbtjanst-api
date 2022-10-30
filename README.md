# Projekt webbtjanst-api-eemmmaf
Skapad av Emma Forslund, 2022

## REST-webbtjänst
Detta är en del av projektet i kursen DT193G - Fullstack-utveckling med ramverk. Detta repo innehåller filerna till en REST-webbtjänst som är skapad med backend-ramverket Laravel. 
Utöver tabellerna som följer med i installationen av Laravel har två tabeller skapats. En tabell som lagrar produkter och en tabell som lagrar kategorier. En klient-applikation har skapats i ett annat repo som konsumerar denna REST-webbtjänst.
Full CRUD-funktionalitet har skapats för båda tabellerna. Laravels inbyggda system Sanctum har använts för autentisering. 
### Tabeller
| Tabellnamn  | Fält |
| ------------- | ------------- |
| Products      | **id** bigint(20) **category_id** bigint(20) **name** varchar(255) **description** longtext **price** int(11) **quantity** varchar(255) **shelf** varchar(255) **created_at** timestamp **updated_at** timestamp|
| Categories    | **id** bigint(20) **categoryname** varchar(255) **categorydescription** longtext **created_at** timestamp **updated_at** timestamp |

### Models
Det finns två stycken Models. Category.php för kategorier och Product.php för produkter. Relationen mellan Produkter och Kategorier är ett "ett-till-många"-samband. 

### Controllers
#### ProductController.php
Denna controller har funktioner för produkterna. I den filen finns det funktioner för att lägga till, uppdatera, ta bort, hämta produkt utifrån dess id, hämta alla produkter och sökfunktionalitet. 
#### CategoryController.php
Denna controller har funktioner för kategorierna. I den filen finns det funktioner för att lägga till, uppdatera, ta bort, hämta kategori utifrån dess id och hämta alla kategorier. 
#### AuthController.php
Denna controller har funktioner för att kunna registrera konto, logga in och logga ut. 

### Använda REST-webbtjänsten
Denna REST-webbtjänst har inte publicerats. Den har endast använts med localhost. 

#### Sökväg för att hämta alla produkter
http://localhost:8000/api/getproducts

Här nedan visas hur de olika API:erna används med metoderna GET, POST, PUT, DELETE.

#### Kategorier
| Metod  | Ändpunkt | Beskrivning |
| ------------- | ------------- | -----------|
| POST | /addcategory | Lägga till kategori |
| GET | /getcategories | Hämtar alla lagrade kategorier |
| GET | /getcategory/id | Hämtar kategori utifrån dess id. Byt ut id mot ett nummer |
| PUT | /updatecategory/id | Uppdaterar kategori utifrån dess id. Byt ut id mot ett nummer |
| DELETE | /deletecategory/id | Tar bort kategori utifrån dess id. Byt ut id mot ett nummer |

#### Produkter
| Metod  | Ändpunkt | Beskrivning |
| ------------- | ------------- | -----------|
| GET | /getproducts | Hämtar alla produkter |
| GET | /getproductbyid/id | Hämtar kategori utifrån dess id. Byt ut id mot ett nummer |
| GET | /products/search/name | Hämtar produkter som har ett produktnamn som innehåller ordet som är sökt på. Byt ut name mot produktens namn |
| POST | /addproduct | Lägger till produkt |
| PUT | /updateproduct/id | Uppdaterar produkt utifrån dess id. Byt ut id mot ett nummer |
| DELETE | /deleteproduct/id | Tar bort produkt utifrån dess id. Byt ut id mot ett nummer |

#### Användare
| Metod  | Ändpunkt | Beskrivning |
| ------------- | ------------- | -----------|
| GET | /user | Hämtar information om användare |
| POST | /register | Registrerar användare |
| POST | /login | Loggar in användare |
| POST | /logout | Loggar ut användare |

Ett produkt-objekt returneras/skickas som JSON med följande struktur:
```
{
    "id": 9,
    "category_id": 6,
    "name": "Kanel malen",
    "description": "Kanel är en söt och aromatisk krydda som är god i efterrätter och bakverk eller som smaksättare i en gryta.",
    "price": 20,
    "quantity": "47",
    "shelf": "50",
    "created_at": "2022-10-25T07:39:52.000000Z",
    "updated_at": "2022-10-25T12:57:47.000000Z",
    "categoryname": "Kryddor"
  }
```
Ett kategori-objekt returneras/skickas som JSON med följande struktur:
```
{
    "id": 6,
    "categoryname": "Kryddor",
    "categorydescription": "Kryddor, fonder och andra smaksättare",
    "created_at": "2022-10-24T22:18:42.000000Z",
    "updated_at": "2022-10-24T22:18:42.000000Z"
  }
  ```
  
### Sanctum
Alla Routes förutom /login är skyddade av Laravels inbyggda system Sanctum. För att komma åt routesen måste ett användarkonto registreras.

## Provköra denna REST-webbtjänst
* Klona detta repo
* Installera Laravel CLI med kommandot `composer global require laravel/installer`
* Stå i mappen för projektapi
* Starta projektet med kommandot `php artisan serve`
* Ställ in miljöinställningarna för databasanslutningen i filen .env
* Migrera databasen med kommandot ``php artisan migrate`
* För att skapa ett nytt användarkonto behövs autentiseringen tillfälligt tas bort








