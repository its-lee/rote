![rote icon](https://raw.githubusercontent.com/Cygnut/rote/main/web/public/img/content/roteIcon-64x64-Transparent.png)

# rote

Simple public note database using NodeJs, Angular & Bootstrap.

# API

### GET /api
Get the most up to date documentation on the API in JSON format.

### GET /category

| Parameter | Type | Description |
| --------- | ---- | ----------- |
| id | Query | A category id to filter by. |

Get a set of categories.

### POST /category

| Parameter | Type | Description |
| --------- | ---- | ----------- |
| - | Body | A json category blob. |

```json
{ 
  "name": "writing", 
  "description": "random writing ideas."
}
```

Add a new category.

### PUT /category

| Parameter | Type | Description |
| --------- | ---- | ----------- |
| - | Body | A json category blob. |

```json
{ 
  "id": "1234",
  "name": "writing", 
  "description": "random writing ideas."
}
```

Update a category.

### DELETE /category

| Parameter | Type | Description |
| --------- | ---- | ----------- |
| - | Body | A json category blob. |

```json
{ 
  "id": "1234"
}
```

Delete a category by id.

### GET /note

| Parameter | Type | Description |
| --------- | ---- | ----------- |
| id | Query | A note id to filter by. |

Get a set of notes.

### POST /note

| Parameter | Type | Description |
| --------- | ---- | ----------- |
| - | Body | A json category blob. |

```json
{ 
  "title": "buttercups & hearthlilies", 
  "content": "are these a thing?",
  "category_id": "12"
}
```

Add a new note.

### PUT /category

| Parameter | Type | Description |
| --------- | ---- | ----------- |
| - | Body | A json note blob. |

```json
{ 
  "id": "4321",
  "title": "buttercups & hearthlilies", 
  "content": "are these a thing?",
  "category_id": "12"
}
```

Update a note.

### DELETE /category

| Parameter | Type | Description |
| --------- | ---- | ----------- |
| - | Body | A json note blob. |

```json
{ 
  "id": "1234"
}
```
Delete a note by id.
