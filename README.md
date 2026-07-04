# 🚗 Garage Finder Web Application

Garage Finder is a web application developed using Laravel and PHP that connects vehicle owners with garage owners. Users can browse available garages, view the services they offer, and request bookings. Garage owners can register their own garages, manage services, and respond to customer booking requests through a dedicated dashboard.

---

## 📖 Project Overview

The system provides two user roles:

- **Customer**
- **Garage Owner**

Customers can search for garages, explore available services, and submit booking requests. Garage owners can register and manage their garages, add or update services, and accept or reject customer booking requests. Once a booking request is accepted, the customer receives a notification within the system.

---

## ✨ Features

### Customer
- User registration and login
- Browse registered garages
- View garage details
- View available services
- Send booking requests
- Receive notifications when booking requests are accepted

### Garage Owner
- Secure authentication
- Register and manage a garage
- Add, edit, and delete garage services
- View incoming booking requests
- Accept or reject booking requests
- Manage garage information

---

## 🛠 Technologies Used

- Laravel
- PHP
- MySQL
- HTML5
- CSS3
- JavaScript
- Laravel Authentication
- DataTables

---

## 🗄 Database

- MySQL Database
- Relational database design
- CRUD operations
- Authentication system
- Booking management

---

## 📂 Project Structure

```
Garage-Finder/
│── app/
│── config/
│── database/
│── public/
│── resources/
│── routes/
│── storage/
│── README.md
```

---

## ⚙ Installation

### Clone the repository

```bash
git clone https://github.com/YOUR_USERNAME/garage-finder.git
```

### Navigate to the project

```bash
cd garage-finder
```

### Install dependencies

```bash
composer install
```

### Create environment file

```bash
cp .env.example .env
```

### Generate application key

```bash
php artisan key:generate
```

### Configure the database

Update the `.env` file with your MySQL database credentials.

### Run migrations

```bash
php artisan migrate
```

### Start the development server

```bash
php artisan serve
```

Open your browser and visit:

```
http://127.0.0.1:8000
```

---

## 📸 Screenshots

<img width="635" height="276" alt="image" src="https://github.com/user-attachments/assets/56f507eb-c210-4142-9438-b2ef7eda4872" />

<img width="630" height="289" alt="image" src="https://github.com/user-attachments/assets/af66934b-991c-4a0d-b0ed-3169915bc447" />
<img width="596" height="286" alt="image" src="https://github.com/user-attachments/assets/b1cf7b06-39f4-48ed-aee9-348e655c0f58" />
<img width="632" height="253" alt="image" src="https://github.com/user-attachments/assets/28557b34-dc8d-4e18-ba88-341d347ac03d" />
<img width="632" height="278" alt="image" src="https://github.com/user-attachments/assets/674e2ddb-13ad-4b2f-964a-dd00558f5117" />




---

## 🚀 Future Improvements

- Google Maps integration
- Online payments
- Ratings and reviews
- Search filters
- Email notifications
- Real-time notifications
- Chat between customers and garage owners

---

## 👩‍💻 Developer

**Manal Manzoor**

BS Software Engineering (Final Year)

COMSATS University Islamabad, Wah Campus

---

## 📄 License

This project was developed as a university academic project for learning and educational purposes.
