# 💊 Apotek Hidup

**Apotek Hidup** is an online pharmacy e-commerce website built with **Native PHP and MySQL**. The application allows users to browse and search for medicines, manage a shopping cart, complete purchases, and view transaction history.

The system also includes an **admin dashboard** for managing medicines, customers, transactions, sales reports, and customer messages.

> This project was developed as a web development project to implement full-stack development concepts, including CRUD operations, authentication, session management, transaction processing, and relational databases.

---

## ✨ Key Features

### 👤 User Features

#### Authentication

- User registration.
- Login using email and password.
- Passwords are stored using `password_hash()`.
- Login verification using `password_verify()`.
- PHP Session is used to maintain the user's login state.
- Users can return to the checkout process after logging in if they were redirected due to authentication requirements.

#### Home Page

- Main hero section and pharmacy information.
- Displays popular or best-selling medicines.
- Navigation to products, profile, transaction history, and contact pages.
- Quick access to the shopping cart.

#### Product Catalog

- Displays available medicines.
- Shows medicine name, category, price, stock, image, and product information.
- Search functionality based on **medicine name or category**.
- Products can be added to the shopping cart.

#### Shopping Cart

- Cart data is managed using PHP Session.
- Add medicines to the cart.
- Update product quantities.
- Calculate the total purchase amount.
- Connect directly to the checkout process.

#### Checkout

- Displays an order summary.
- Collects recipient information:
  - Name
  - Phone number
  - Address
- Provides payment method selection.
- Includes payment display options such as **QRIS** and bank transfer.
- Successfully processed orders are stored in the database.
- Transaction details are saved for each purchased item.
- The shopping cart is cleared after a successful checkout.

#### Transaction History

- Users can view their transaction history.
- Displays transaction status.
- Users can open detailed information for each transaction.
- Transaction details include purchased medicines, prices, quantities, and transaction information.

#### User Profile

- View account information.
- Update profile information.
- Upload or update a profile photo.
- Profile data is retrieved based on the active user session.

#### Password Recovery

- Password recovery and reset pages.
- New passwords are stored using password hashing.

#### Contact Us

Users can send messages to the pharmacy. The system stores:

- Name
- Email
- Phone number
- Subject
- Message
- Message status

---

## 🛠️ Admin Features

### 📊 Dashboard

The admin dashboard provides an overview of the application, including:

- Total medicines.
- Total transactions.
- Total customers.
- Total revenue.
- Number of transactions for the current day.

The dashboard retrieves statistics directly from the database.

### 💊 Medicine Management

Administrators can perform CRUD operations on medicine data:

- Add medicines.
- Edit medicines.
- Delete medicines.
- Upload medicine images.
- Manage:
  - Medicine name
  - Category
  - Price
  - Stock
  - Expiration date
  - Description
  - Image

### 👥 Customer Management

Administrators can:

- View the customer list.
- Search customers by name or phone number.
- View customer details.
- Add customer data.
- Delete customers.
- Manage customer phone numbers and addresses.

### 🧾 Transaction Management

Administrators can:

- View all transactions.
- View transaction details.
- Monitor transaction status.
- View medicines included in each transaction.
- Add transactions manually.
- Delete transactions.
- Manage transaction statuses such as:
  - `pending`
  - `diproses`
  - `selesai`

For manually added transactions, the system can also update medicine stock based on the entered quantity.

### 📈 Sales Reports

Administrators can generate sales reports based on a selected date range.

Available information includes:

- Total transactions.
- Total revenue.
- Total customers.
- Total medicines.
- Start and end date filters.
- Print functionality using `window.print()`.

### 💬 Message Management

Administrators can:

- View messages submitted through the Contact Us page.
- Open message details.
- Delete messages.

---

## 🔐 Authentication and Access Control

The application uses a simple role-based access system.

```text
User
 ├── Home
 ├── Products
 ├── Shopping Cart
 ├── Checkout
 ├── Profile
 └── Transaction History

Admin
 ├── Dashboard
 ├── Medicine Management
 ├── Transaction Management
 ├── Customer Management
 ├── Sales Reports
 └── Message Management
```

PHP Session is used to store information such as:

- Login status.
- User ID.
- User name.
- Email.
- User role.
- Shopping cart data.

---

## 🧱 Technologies Used

| Technology | Purpose |
|---|---|
| **Native PHP** | Backend and server-side processing |
| **MySQL** | Database management |
| **HTML5** | Page structure |
| **CSS3** | Styling and responsive user interface |
| **JavaScript** | Client-side interactions and animations |
| **PHP Session** | Authentication state and shopping cart |
| **MySQLi** | Database connection and queries |
| **Font Awesome** | User interface icons |
| **Google Fonts – Poppins** | Typography |

This project **does not use a PHP framework such as Laravel**. The backend functionality is implemented using Native PHP.

---

## 🏗️ Project Structure

```text
Apotek Hidup/
│
├── admin/
│   ├── admin_contact.php
│   ├── contact_delete.php
│   ├── contact_detail.php
│   ├── dashboard.php
│   ├── data_obat.php
│   ├── data_pelanggan.php
│   ├── detail_pelanggan.php
│   ├── edit_obat.php
│   ├── hapus_obat.php
│   ├── laporan_penjualan.php
│   ├── tambah_obat.php
│   ├── tambah_pelanggan.php
│   ├── tambah_transaksi.php
│   ├── transaksi.php
│   └── transaksi_detail.php
│
├── assets/
│   ├── css/
│   ├── image/
│   └── js/
│
├── auth/
│   ├── cart_add.php
│   ├── cart_get.php
│   ├── checkout_process.php
│   ├── contact_process.php
│   ├── login_process.php
│   ├── logout.php
│   ├── lupa_password_process.php
│   ├── profile_update.php
│   ├── proses_obat.php
│   ├── proses_pelanggan.php
│   ├── reset_password_process.php
│   ├── signup_process.php
│   ├── transaksi_process.php
│   └── update_foto.php
│
├── config/
│   └── database.php
│
├── pages/
│   ├── checkout.php
│   ├── contact.php
│   ├── home.php
│   ├── login.php
│   ├── lupa_password.php
│   ├── produk.php
│   ├── profile.php
│   ├── reset_password.php
│   ├── riwayat_detail.php
│   ├── riwayat_transaksi.php
│   ├── signup.php
│   └── sukses.php
│
└── kalender.php
```

---

## 🗄️ Database Overview

The main database used by the application is:

```text
db_apotekhidup
```

The application uses several main entities:

```text
users
 └── Stores user accounts and roles

obat
 └── Stores medicine data

pelanggan
 └── Stores customer data

transaksi
 └── Stores main transaction information

detail_transaksi
 └── Stores purchased items for each transaction

contact
 └── Stores messages submitted by users
```

Conceptual transaction relationship:

```text
User
 │
 └─────────── Transaction
                 │
                 └── Transaction Details
                         │
                         └── Medicine
```

---

## 🔄 Purchase Flow

```text
User
   │
   ▼
Browse Products
   │
   ▼
Search / Select Medicine
   │
   ▼
Add to Cart
   │
   ▼
Checkout
   │
   ├── Not Logged In ──► Login ──► Return to Checkout
   │
   ▼
Enter Recipient Information
   │
   ▼
Select Payment Method
   │
   ▼
Process Checkout
   │
   ├── Save transaction
   ├── Save transaction details
   └── Clear shopping cart
   │
   ▼
Transaction Successful
   │
   ▼
View Transaction History
```

---

## 🔄 Admin Flow

```text
Admin Login
     │
     ▼
Dashboard
     │
     ├──► Medicine Management
     │      ├── Add
     │      ├── Edit
     │      └── Delete
     │
     ├──► Transaction Management
     │      ├── View
     │      ├── Details
     │      ├── Add
     │      └── Delete
     │
     ├──► Customer Management
     │      ├── Search
     │      ├── Details
     │      └── Manage
     │
     ├──► Sales Reports
     │      └── Date Filter & Print
     │
     └──► Message Management
            ├── View Details
            └── Delete
```

---

## ⭐ Project Highlights

### 1. Complete CRUD Functionality

The project does more than display data. It implements **Create, Read, Update, and Delete (CRUD)** operations, particularly for medicine, customer, transaction, and message management.

### 2. Separate User and Admin Areas

The application provides two different sides with different responsibilities:

- **Users:** Focus on browsing and purchasing medicines, managing accounts, and viewing transaction history.
- **Administrators:** Focus on managing pharmacy operations and application data.

### 3. Database-Integrated Transactions

The checkout process is connected to the database. Transaction data and purchased item details are stored and can later be accessed from both the user's transaction history and the admin panel.

### 4. Session-Based Shopping Cart

The shopping cart uses PHP Session, allowing users to add products before completing the checkout process.

### 5. Data-Driven Admin Dashboard

The dashboard calculates application statistics directly from the database, including medicine count, transaction count, customer count, and revenue.

### 6. Date-Based Sales Reporting

Administrators can select a date range to analyze transactions and revenue for a specific period.

### 7. Responsive and Interactive Interface

The frontend uses separate CSS and JavaScript files to provide a responsive and interactive user experience, including navigation, shopping cart interactions, animations, and other interface elements.

### 8. Password Hashing

User passwords are not stored as plain text. The application uses:

```php
password_hash()
```

Password verification during login uses:

```php
password_verify()
```

---

## 🚀 Getting Started

### 1. Requirements

Make sure you have the following installed:

- XAMPP
- Apache
- MySQL
- PHP
- A modern web browser

### 2. Copy the Project

Place the project folder inside:

```text
C:\xampp\htdocs\
```

For example:

```text
C:\xampp\htdocs\Apotek Hidup\
```

### 3. Start XAMPP

Start the following services:

```text
Apache
MySQL
```

### 4. Create the Database

Open **phpMyAdmin** and create a database named:

```text
db_apotekhidup
```

> The project requires tables such as `users`, `obat`, `pelanggan`, `transaksi`, `detail_transaksi`, and `contact`, based on the database queries used by the application.

### 5. Configure the Database Connection

The database configuration is located at:

```text
config/database.php
```

Example configuration:

```php
$conn = new mysqli(
    "localhost",
    "root",
    "",
    "db_apotekhidup"
);
```

Update the host, username, password, or database name if your MySQL configuration is different.

### 6. Run the Application

Open the following URL in your browser:

```text
http://localhost/Apotek%20Hidup/pages/home.php
```

Adjust the URL if your project folder has a different name.

---

## 📌 Future Improvements

This project is built with Native PHP and currently uses a relatively simple application structure. Several areas can be improved in future development:

- Migrate the backend to Laravel or another modern framework.
- Use environment variables through `.env` files for database configuration.
- Add CSRF protection.
- Improve validation and sanitization for all user inputs.
- Use prepared statements consistently across all database queries.
- Add pagination for products, customers, and transactions.
- Add transaction notifications.
- Integrate a real payment gateway.
- Improve automatic stock management, including transaction cancellation handling.
- Add PDF and Excel report exports.
- Expand the transaction status workflow.
- Separate business logic further to improve maintainability and scalability.

---

## 🎯 Project Objectives

Apotek Hidup was developed to demonstrate practical implementation of several web development concepts:

- Frontend development.
- Backend development.
- Database management.
- Authentication and authorization.
- CRUD operations.
- Session management.
- Shopping cart implementation.
- Checkout and transaction processing.
- File uploads.
- Search and filtering.
- Administrative dashboards.
- Sales reporting.

---

## 👨‍💻 Developer Role

**Full-Stack Web Developer**

This project covers both frontend and backend development, including user interface implementation, database integration, authentication, shopping cart functionality, checkout processing, transaction management, and the administrative dashboard.

---

## 📄 License

This project was created for educational, portfolio, and web development learning purposes.

---

**Apotek Hidup — An Online Pharmacy E-Commerce System Built with Native PHP & MySQL**
