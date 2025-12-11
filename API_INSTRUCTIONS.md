# Instrucciones de API - Grupos

## 📋 Descripción
API REST para la gestión de grupos académicos.

## 🔗 Endpoints Disponibles

### Base URL
```
http://grupos-2.test/api
```

### 1. Listar Todos los Grupos
**GET** `/api/grupos`

**Respuesta exitosa (200):**
```json
{
  "data": [
    {
      "id": 1,
      "periodo": "2025A",
      "materia": "Matemáticas",
      "rfc": "ABC123456789",
      "alumno_escritos": 20,
      "grupo": "A",
      "estatus_grupo": "Activo",
      "capacidad_grupo": 30,
      "created_at": "2025-01-20T00:00:00.000000Z",
      "updated_at": "2025-01-20T00:00:00.000000Z"
    }
  ]
}
```

### 2. Mostrar un Grupo Específico
**GET** `/api/grupos/{id}`

**Parámetros:**
- `id` (path): ID del grupo

**Respuesta exitosa (200):**
```json
{
  "data": {
    "id": 1,
    "periodo": "2025A",
    "materia": "Matemáticas",
    "rfc": "ABC123456789",
    "alumno_escritos": 20,
    "grupo": "A",
    "estatus_grupo": "Activo",
    "capacidad_grupo": 30
  }
}
```

### 3. Crear/Registrar un Nuevo Grupo
**POST** `/api/grupos`

**Headers:**
```
Content-Type: application/json
Accept: application/json
```

**Body (JSON):**
```json
{
  "periodo": "2025A",
  "materia": "Matemáticas",
  "rfc": "ABC123456789",
  "alumno_escritos": 20,
  "grupo": "A",
  "estatus_grupo": "Activo",
  "capacidad_grupo": 30,
  "tipo_personal": "Profesor",
  "folio_acta": "ACTA001",
  "paralelo_de": null,
  "exclusivo_carrera": null,
  "exclusivo_reticula": null
}
```

**Campos requeridos:**
- `periodo` (string, max: 5)
- `rfc` (string, max: 13)
- `alumno_escritos` (integer, min: 0)
- `grupo` (string, max: 255)
- `estatus_grupo` (string, max: 50)
- `capacidad_grupo` (integer, min: 1)

**Campos opcionales:**
- `materia` (string, max: 255)
- `tipo_personal` (string, max: 100)
- `folio_acta` (string, max: 100)
- `paralelo_de` (string, max: 100)
- `exclusivo_carrera` (string, max: 100)
- `exclusivo_reticula` (string, max: 100)

**Respuesta exitosa (200):**
```json
{
  "data": {
    "id": 1,
    "periodo": "2025A",
    "materia": "Matemáticas",
    "rfc": "ABC123456789",
    "alumno_escritos": 20,
    "grupo": "A",
    "estatus_grupo": "Activo",
    "capacidad_grupo": 30,
    "created_at": "2025-01-20T00:00:00.000000Z",
    "updated_at": "2025-01-20T00:00:00.000000Z"
  }
}
```

**Errores de validación (422):**
```json
{
  "error": {
    "periodo": ["El campo periodo es obligatorio."],
    "rfc": ["El campo rfc es obligatorio."]
  }
}
```

### 4. Actualizar un Grupo
**PUT** `/api/grupos/{id}`

**Parámetros:**
- `id` (path): ID del grupo a actualizar

**Headers:**
```
Content-Type: application/json
Accept: application/json
```

**Body (JSON):** (mismos campos que crear)

**Respuesta exitosa (200):**
```json
{
  "data": {
    "id": 1,
    "periodo": "2025A",
    "materia": "Matemáticas Avanzadas",
    "rfc": "ABC123456789",
    "alumno_escritos": 25,
    "grupo": "A",
    "estatus_grupo": "Activo",
    "capacidad_grupo": 35
  }
}
```

### 5. Eliminar un Grupo
**DELETE** `/api/grupos/{id}`

**Parámetros:**
- `id` (path): ID del grupo a eliminar

**Headers:**
```
Accept: application/json
```

**Respuesta exitosa (200):**
```json
{
  "message": "Grupo eliminado correctamente"
}
```

**Error (404):**
```json
{
  "message": "No query results for model [App\\Models\\Grupos] {id}"
}
```

## 🚀 Uso con Insomnia

### Importar la Colección

1. Abre Insomnia
2. Ve a **Application → Preferences → Data → Import Data**
3. Selecciona **Insomnia v4** como formato
4. Selecciona el archivo `insomnia-collection.json` del proyecto
5. La colección "Grupos API" se importará con todas las peticiones

### Configurar el Entorno

La colección incluye dos entornos:

1. **Base Environment** (por defecto)
   - `base_url`: `http://grupos-2.test`

2. **Production**
   - `base_url`: `https://api.tudominio.com`

Puedes cambiar el entorno desde el menú desplegable en la parte superior de Insomnia.

### Peticiones Incluidas

- ✅ **Listar Grupos** - GET
- ✅ **Mostrar Grupo** - GET
- ✅ **Crear Grupo (Registrar)** - POST
- ✅ **Actualizar Grupo** - PUT
- ✅ **Eliminar Grupo** - DELETE

## 📝 Ejemplos de Uso

### cURL

**Crear un grupo:**
```bash
curl -X POST http://grupos-2.test/api/grupos \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{
    "periodo": "2025A",
    "materia": "Matemáticas",
    "rfc": "ABC123456789",
    "alumno_escritos": 20,
    "grupo": "A",
    "estatus_grupo": "Activo",
    "capacidad_grupo": 30
}'
```

### JavaScript (Fetch API)

```javascript
fetch('http://grupos-2.test/api/grupos', {
  method: 'POST',
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json'
  },
  body: JSON.stringify({
    periodo: '2025A',
    materia: 'Matemáticas',
    rfc: 'ABC123456789',
    alumno_escritos: 20,
    grupo: 'A',
    estatus_grupo: 'Activo',
    capacidad_grupo: 30
  })
})
.then(response => response.json())
.then(data => console.log(data))
.catch(error => console.error('Error:', error));
```

### PHP (Guzzle)

```php
$client = new \GuzzleHttp\Client();

$response = $client->post('http://grupos-2.test/api/grupos', [
    'headers' => [
        'Content-Type' => 'application/json',
        'Accept' => 'application/json'
    ],
    'json' => [
        'periodo' => '2025A',
        'materia' => 'Matemáticas',
        'rfc' => 'ABC123456789',
        'alumno_escritos' => 20,
        'grupo' => 'A',
        'estatus_grupo' => 'Activo',
        'capacidad_grupo' => 30
    ]
]);

$data = json_decode($response->getBody(), true);
```

## ⚠️ Códigos de Estado HTTP

- `200` - Éxito
- `422` - Error de validación
- `404` - Recurso no encontrado
- `500` - Error del servidor

## 📌 Notas

- Todos los endpoints requieren el header `Accept: application/json`
- Los endpoints POST y PUT requieren el header `Content-Type: application/json`
- El campo `rfc` se convierte automáticamente a mayúsculas
- Los campos de fecha (`created_at`, `updated_at`) se devuelven en formato ISO 8601

