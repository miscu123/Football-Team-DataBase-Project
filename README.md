# ⚽ Football Team Database System

A comprehensive database management system for football clubs, enabling:
- **Admin management** of team catalogs
- **User ticket reservations** for matches
- **Role-based access control** (Admin/Regular User)

## 🗃️ Database Schema
```mermaid
erDiagram
    USERS ||--o{ TICKETS : "reserves"
    USERS {
        int user_id PK
        varchar(50) username
        varchar(100) password
        enum("admin","user") role
    }
    MATCHES {
        int match_id PK
        date match_date
        varchar(100) opponent
        int available_tickets
    }
    TICKETS {
        int ticket_id PK
        int user_id FK
        int match_id FK
        timestamp reservation_date
    }
