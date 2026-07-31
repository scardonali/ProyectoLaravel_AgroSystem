# ProyectoLaravel_AgroSystem
AgroSystem is a Laravel-based web application for agricultural management. It features crop, employee, inventory and user management, interactive dashboards, weather API integration, Plotly.js charts, authentication, CRUD operations and a MySQL relational database following the MVC architecture.


# 🌱 AgroSystem

**AgroSystem** is a web application built with **Laravel** that streamlines agricultural management by centralizing crop, employee, inventory and user administration. It also provides interactive dashboards, weather information and statistical reports to support decision-making.

---

## ✨ Features

* 🌾 Crop management (CRUD)
* 👨‍🌾 Employee management
* 📦 Inventory management
* 👥 User management
* 🔐 Authentication and authorization
* 📊 Interactive dashboards with Plotly.js
* 🌦️ Weather API integration
* 🗃️ Relational MySQL database
* ✅ Form validation
* 📱 Responsive interface

---

## 🛠️ Tech Stack

* Laravel
* PHP
* MySQL
* JavaScript
* HTML5
* CSS3
* AdminLTE
* Plotly.js
* REST APIs


## ⚙️ Installation

Clone the repository:

```bash
git clone https://github.com/scardonali/ProyectoLaravel_AgroSystem.git
```

Go to the project folder:

```bash
cd AgroSystem
```

Install PHP dependencies:

```bash
composer install
```

Install JavaScript dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Configure your database credentials inside the `.env` file.

Run the migrations and seeders:

```bash
php artisan migrate --seed
```

Compile the frontend assets:

```bash
npm run dev
```

Start the development server:

```bash
php artisan serve
```

The application will be available at:

```text
http://127.0.0.1:8000
```

---

## 🗄️ Database

Create a MySQL database and update the following variables inside your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=agrosystem
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

---

## 📁 Project Structure

```text
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
```

---

## 🚀 Future Improvements

* Export reports to PDF and Excel.
* Notifications and reminders.
* Mobile application.
* Advanced analytics.
* Multi-language support.

---

## 👨‍💻 Author

**Santiago Cardona Libreros**

Systems Information Management Student

Laravel & PHP Developer

LinkedIn: https://www.linkedin.com/in/santiago-cardona-libreros-892661228/

GitHub: https://github.com/scardonali/ProyectoLaravel_AgroSystem

---

## 📄 License

This project is licensed under the MIT License.
