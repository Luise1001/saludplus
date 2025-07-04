# SaludPlus

**SaludPlus** is a web application built with **Laravel, Jetstream, and Livewire** that streamlines the scheduling of medical appointments across multiple hospitals and specialties. It allows healthcare centers to manage patient requests, configure specialist availability, and optimize resource allocation.

---

## 🏥 Key Features

- Patient identity validation and appointment booking (without requiring full login).
- Multi-hospital management:
  - Each hospital can manage its own specialists and settings.
- Specialty-based scheduling:
  - Medical areas (e.g., Pediatrics, Dentistry) configured per hospital.
  - Specialists assigned to one or more areas.
- Configurable availability:
  - Set slots per day/shift (e.g., morning, afternoon).
  - Calendar with available/blocked days.
  - Prevents overbooking and blocks past dates.
- Admin dashboard to manage:
  - Hospitals, areas, specialists, appointment slots, and patients.
- Designed to be accessible, even for non-technical users (e.g., elderly patients).
- Built-in dark mode and mobile-friendly interface.

---

## ⚙️ Tech Stack

- **Laravel 10**
- **Livewire**
- **Jetstream + Tailwind CSS**
- **MySQL**
- **Flatpickr** (calendar UI)
- **Spatie roles/permissions** (optional for user control)

---

## 🚀 Installation

```bash
git clone https://github.com/Luise1001/SaludPlus.git
cd SaludPlus
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm install && npm run build
