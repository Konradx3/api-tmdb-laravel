# Recruitment - Endpoint Description

## Configuration
Copy the .env.example file and paste it next to it as .env and then complete 
DB_DATABASE, DB_USERNAME, DB_PASSWORD, TMDB_API_KEY

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
