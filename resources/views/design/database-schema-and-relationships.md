# Database Schema and Relationships

--------------------------------------------------------------------------------

## Table: Widget

### Purpose

Stores widget records used for development and testing purposes. Demonstrates a
variety of field types, relationships, and data associations.

### Columns

| Column       | Type            | Nullable | Default | Notes       |
| ------------ | --------------- | -------- | ------- | ----------- |
| id           | bigint unsigned | No       | AUTO    | PK          |
| user_id      | bigint unsigned | Yes      | -       | FK          |
| parent_id    | bigint unsigned | Yes      | -       | FK (self)   |
| code         | varchar(255)    | No       | -       | UNIQUE      |
| name         | varchar(255)    | No       | -       |             |
| slug         | varchar(255)    | No       | -       | UNIQUE      |
| headline     | varchar(255)    | Yes      | -       |             |
| overview     | mediumText      | Yes      | -       |             |
| highlights   | mediumText      | Yes      | -       |             |
| content      | longText        | Yes      | -       |             |
| image_name   | varchar(255)    | Yes      | -       |             |
| file_name    | varchar(255)    | Yes      | -       |             |
| is_active    | boolean         | No       | true    |             |
| status       | varchar(255)    | Yes      | -       |             |
| position     | smallint        | No       | 0       |             |
| price        | bigint unsigned | Yes      | -       |             |
| extra_data   | json            | Yes      | -       |             |
| started_at   | timestamp       | Yes      | -       |             |
| ended_at     | timestamp       | Yes      | -       |             |
| expired_at   | timestamp       | Yes      | -       |             |
| published_at | timestamp       | Yes      | -       |             |
| released_at  | timestamp       | Yes      | -       |             |
| created_at   | timestamp       | Yes      | -       |             |
| updated_at   | timestamp       | Yes      | -       |             |

### Constraints

- `user_id` references `users.id`
- `parent_id` references `widgets.id` (self-referential)
- `code` is unique
- `slug` is unique

### Relationships

- Widget belongs to User
- Widget has many Widgets (children)
- Widget belongs to Widget (parent)
