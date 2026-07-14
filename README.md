# cwh — Learning PHP

A hands-on PHP learning repository. It contains a set of annotated tutorial scripts covering
the language fundamentals, plus a small end-to-end project — **Hacker's Throne**, a hackathon
signup form that validates user input and stores submissions in a MySQL database.

## What's inside

### Tutorial scripts

| File | Covers |
| --- | --- |
| `01_Basics.php` | Variables, constants, comments, arithmetic / assignment / comparison / increment / logical operators, and PHP's data types via `var_dump()` |
| `02_MoreBasics.php` | `if` / `else if` / `else`, arrays, `while` / `do…while` / `for` / `foreach` loops, and user-defined functions |
| `03_strings.php` | String functions: `strlen`, `str_word_count`, `strrev`, `strpos`, `str_replace` |

Each script is a standalone page — open it in the browser to see its output.

### The project — Hacker's Throne

A signup form for a hackathon trip.

| File | Role |
| --- | --- |
| `index.php` | The form plus the server-side handler: validates the submission and inserts it into MySQL using a prepared statement |
| `index.js` | Client-side validation, so users get immediate feedback before a round trip |
| `style.css` | Styling for the form, the background image, and status messages |
| `schema.sql` | `CREATE DATABASE` / `CREATE TABLE` statements for the `trip_us`.`trip` table |
| `_index.html` | The original static mockup of the form, kept for reference |
| `bg.jpg` | Background image |

## Running it locally

You need a PHP environment with MySQL — [XAMPP](https://www.apachefriends.org/) is the easiest
on Windows.

1. **Clone into your web root** (`htdocs` for XAMPP):

   ```bash
   git clone https://github.com/ImranTayyab01/cwh.git
   ```

2. **Start Apache and MySQL** from the XAMPP control panel.

3. **Create the database.** Import `schema.sql` through phpMyAdmin, or run it from the shell:

   ```bash
   mysql -u root -p < schema.sql
   ```

   This creates the `trip_us` database and the `trip` table the form writes to.

4. **Check the credentials** at the top of `index.php`. They default to the standard XAMPP
   setup (user `root`, empty password, database `trip_us`). Adjust them if yours differ.

5. **Open the app** at <http://localhost/cwh/index.php>.

Submit the form and the row will appear in `trip_us`.`trip`.

## Notes on the code

- **Input is never concatenated into SQL.** `index.php` uses a prepared statement with bound
  parameters, so a submitted value like `'); DROP TABLE trip;--` is stored as ordinary text
  rather than executed.
- **Validation happens twice.** `index.js` gives fast feedback in the browser, but that can be
  bypassed trivially, so `index.php` re-checks the name, age, and email on the server. The
  server-side check is the one that actually protects the database.
- **Database errors are not shown to visitors.** Failures go to the PHP error log; the page
  shows a generic message, so the schema isn't leaked to anyone who triggers an error.
- The credentials in `index.php` are XAMPP's local defaults. If this is ever deployed anywhere
  real, move them out of version control (an environment variable or an ignored config file)
  and give the app a database user that only has `INSERT` on the one table it needs.

## Contributors

- **[Imran Tayyab](https://github.com/ImranTayyab01)** — author, original tutorials and project
- **[Awais Asghar](https://github.com/Awais-Asghar)** — bug fixes, SQL injection hardening, validation, documentation

Contributions are welcome — fork the repo, create a branch, and open a pull request.
