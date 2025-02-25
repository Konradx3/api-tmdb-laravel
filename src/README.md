# Rekrutacja - opis endpointów

## Endpointy
**Wszystkie endpointy znajdują się pod:**
`/api/v1/...`

| Metoda | Endpoint         | Opis           |
|--------|-----------------|----------------|
| GET    | `/movies`       | Lista filmów   |
| GET    | `/series`       | Lista seriali  |
| GET    | `/genres`       | Lista gatunków |

## Obsługa języków
Każdy endpoint akceptuje parametr `lang`:
- `en` → Angielski (domyślnie)
- `pl` → Polski
- `de` → Niemiecki

Przykład:
```
GET /api/v1/movies?lang=pl
```

## Pobieranie danych z TMDB
```
php artisan app:fetch-tmdb-data 
```
