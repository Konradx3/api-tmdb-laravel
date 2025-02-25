# Recruitment - Endpoint Description

## Endpoints
**All endpoints are available at:**
`/api/v1/...`

| Method | Endpoint         | Description           |
|--------|-----------------|----------------|
| GET    | `/movies`       | Movie list   |
| GET    | `/series`       | Series list  |
| GET    | `/genres`       | Genre list |

## Language Support
Each endpoint accepts a `lang` parameter:
- `en` → English (default)
- `pl` → Polish
- `de` → German

Example:

```
GET /api/v1/movies?lang=pl
```

## Fetching Data from TMDB
```
php artisan app:fetch-tmdb-data 
```
