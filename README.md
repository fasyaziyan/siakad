# SIAKAD — School Academic Information System

A web-based academic information system for a school, built with **Laravel 8**. It replaces manual grade sheets and printed report cards with one system shared by administrators, teachers, homeroom teachers and students.

Built as my Diploma (D3) final project at Politeknik Negeri Malang and tested with the school's real data: **92 students, 14 teachers and 90 subjects**.

## Features

**Roles and access**
- Separate logins and dashboards for **admin**, **teachers** and **students** (multi-guard authentication with role-based access).
- Homeroom teachers (wali kelas) get an extra view for their own class.

**Master data (admin)**
- Students, teachers, admins, classes, grade levels, subjects and curricula (academic year / semester).
- Class detail pages with student lists and attendance sheets.
- Teaching schedule per class and subject.

**Grades and report cards**
- Teachers enter grades per subject for their classes.
- Minimum passing score (KKM) per subject, with a list of students below KKM.
- Homeroom teachers review each student's report card and add notes.
- Report cards generated automatically and exported to **PDF**.
- Class ranking on the dashboard.

**Students**
- Students view their profile and report cards per semester, and can print them.

## Tech stack

- **Backend:** PHP, Laravel 8, Eloquent ORM, Livewire
- **Database:** MySQL
- **Frontend:** Blade, Bootstrap, jQuery, DataTables (server-side via `yajra/laravel-datatables`)
- **PDF:** `barryvdh/laravel-dompdf`

## Running locally

```bash
git clone https://github.com/fasyaziyan/siakad.git
cd siakad
composer install
# create a .env file with your DB_DATABASE, DB_USERNAME and DB_PASSWORD
php artisan key:generate
php artisan migrate
php artisan serve
```

Then open `http://localhost:8000`.

## Author

**Ziyan Al Khakim Fasya** — Fullstack Developer (Laravel, Vue.js)
[GitHub](https://github.com/fasyaziyan) · [LinkedIn](https://www.linkedin.com/in/ziyanfasya/)
