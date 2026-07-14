<p align="center">
  <img src="assets/banner.svg" alt="Hacker's Throne, a hackathon signup form built with PHP and MySQL" width="100%">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-7.4%2B-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 7.4 or newer">
  <img src="https://img.shields.io/badge/MySQL-5.7%2B-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL 5.7 or newer">
  <img src="https://img.shields.io/badge/PRs-welcome-a855f7?style=for-the-badge" alt="Pull requests welcome">
</p>

<p align="center">
  A signup form for a hackathon trip. Entries are validated in the browser, validated again on
  the server, and stored in MySQL through a prepared statement.
</p>

<br>

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Project Structure](#project-structure)
- [Requirements](#requirements)
- [Getting Started](#getting-started)
  - [1. Clone the repository](#1-clone-the-repository)
  - [2. Start Apache and MySQL](#2-start-apache-and-mysql)
  - [3. Create the database](#3-create-the-database)
  - [4. Configure the connection](#4-configure-the-connection)
  - [5. Open the app](#5-open-the-app)
- [How It Works](#how-it-works)
- [Security Notes](#security-notes)
- [Database Schema](#database-schema)
- [Contributing](#contributing)
- [Contributors](#contributors)

## Overview

Hacker's Throne is a small PHP web application. A visitor fills in their name, age, gender,
email, phone, and any extra notes, then submits the form. The submission is checked on the
client for fast feedback, checked again on the server because client checks can be bypassed,
and finally written to a MySQL table as a timestamped row.

It is intentionally small. The point is a clean, correct request cycle: render, validate,
persist, respond.

## Features

- A responsive signup form with a full bleed background image.
- Client side validation in plain JavaScript, with no build step and no dependencies.
- Server side validation that re-checks every field, so the browser is never trusted.
- Inserts performed with a prepared statement, which makes SQL injection impossible.
- Database errors written to the PHP error log rather than shown to the visitor.
- Success and error messages rendered inline, escaped with `htmlspecialchars`.

## Project Structure

| Path | Role |
| :--- | :--- |
| `index.php` | The form and the server side handler. Validates the submission and inserts it into MySQL. |
| `index.js` | Client side validation, giving the user feedback before a round trip. |
| `style.css` | Styling for the form, background image, and status messages. |
| `schema.sql` | Creates the `trip_us` database and the `trip` table. |
| `_index.html` | The original static mockup of the form, kept for reference. |
| `assets/banner.svg` | The animated banner at the top of this file. |
| `bg.jpg` | Background image. |

## Requirements

- PHP 7.4 or newer, with the `mysqli` extension enabled (it ships enabled by default).
- MySQL 5.7 or newer, or MariaDB.
- A web server such as Apache.

On Windows the simplest way to get all three at once is
[XAMPP](https://www.apachefriends.org/), which bundles Apache, PHP, and MySQL in one installer.

## Getting Started

### 1. Clone the repository

Clone into your web server's document root. For XAMPP that is `C:\xampp\htdocs`.

```bash
git clone https://github.com/ImranTayyab01/cwh.git
cd cwh
```

### 2. Start Apache and MySQL

Open the XAMPP control panel and start both services.

### 3. Create the database

Import `schema.sql` through phpMyAdmin, or run it from a shell:

```bash
mysql -u root -p < schema.sql
```

This creates the `trip_us` database and the `trip` table that the form writes to.

### 4. Configure the connection

The connection settings sit at the top of `index.php` and default to a standard XAMPP install:

```php
$server   = "localhost";
$username = "root";
$password = "";
$database = "trip_us";
```

Adjust them if your MySQL user or password differs.

### 5. Open the app

Visit <http://localhost/cwh/index.php>.

Fill in the form and submit. A confirmation message appears, and a new row lands in
`trip_us`.`trip`.

## App Interface
<img width="1895" height="973" alt="image" src="https://github.com/user-attachments/assets/f2f29b19-4f79-40ea-9f3f-5bba890121d2" />

## How It Works

A single request cycle, in order:

1. **The browser checks first.** On submit, `index.js` verifies that the name is present, the
   age is a number between 1 and 120, and the email looks like an email. Failures are shown
   inline and the request is never sent.
2. **The server checks again.** `index.php` re-runs all of those checks on `$_POST`. This is
   the check that matters, because anyone can disable JavaScript or post directly to the
   endpoint.
3. **The insert is prepared, not concatenated.** The SQL is sent to MySQL with `?`
   placeholders, and the user's values are bound to it separately.
4. **The result is reported.** On success the visitor sees a confirmation. On failure the real
   error goes to the PHP error log and the visitor sees a generic message.

## Security Notes

**SQL injection.** User input is never concatenated into the query. The insert uses a prepared
statement with bound parameters, so a value such as `'); DROP TABLE trip;--` typed into the
name field is stored as ordinary text rather than executed.

**Cross site scripting.** Anything echoed back into the page passes through
`htmlspecialchars($value, ENT_QUOTES, 'UTF-8')`.

**Error disclosure.** A failed query or a failed connection is logged with `error_log` and the
visitor sees a generic apology. The schema is never printed to the page.

**Credentials.** The values in `index.php` are XAMPP's local defaults and are fine for local
development. Before deploying anywhere real, move them out of version control into an
environment variable or an ignored config file, and give the application a database user whose
only privilege is `INSERT` on the one table it needs.

## Database Schema

```sql
CREATE TABLE `trip` (
    `id`     INT AUTO_INCREMENT PRIMARY KEY,
    `name`   VARCHAR(100) NOT NULL,
    `age`    INT          NOT NULL,
    `gender` VARCHAR(50)      NULL,
    `email`  VARCHAR(150) NOT NULL,
    `phone`  VARCHAR(30)      NULL,
    `other`  TEXT             NULL,
    `dt`     TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## Contributing

Contributions are welcome.

1. Fork the repository.
2. Create a branch: `git checkout -b feature/your-feature`.
3. Commit your changes.
4. Push the branch and open a pull request.

## Contributors

| Contributor | Role |
| :--- | :--- |
| [Imran Tayyab](https://github.com/ImranTayyab01) | Author, original project |
| [Awais Asghar](https://github.com/Awais-Asghar) | Bug fixes, SQL injection hardening, validation, documentation |
