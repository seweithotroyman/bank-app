# Banking Application - Test

## 📋 Project Description
Simple banking web application for managing customers, accounts, and basic transactions.

---

## ✨ Features

- Customer Management (CRUD)
- Account Management (CRUD)
- Deposit, Withdraw, and Transfer Transactions
- Prevent Overdrafts (Negative Balance)
- Transaction History and Filtering
- Authentication System (Login/Register)
- Responsive UI using Tailwind CSS
- Security Measures (Input Validation, SQL Injection Prevention)

---

## 🛠️ Tech Stack

- PHP 8.x
- Laravel 11.x
- MySQL
- Tailwind CSS
- Laravel Jetstream

---

## ⚙️ Installation Instructions

1. Clone the repository
```bash
git clone https://github.com/seweithotroyman/banking-app.git
cd banking-app
```

2. Install dependencies
```bash
composer install
npm install && npm run dev
```

3. Create environment file
```bash
cp .env.example .env
```

4. Configure your database in `.env`:
```
DB_DATABASE=banking_app
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

5. Generate application key
```bash
php artisan key:generate
```

6. Run migration
```bash
php artisan migrate
```

7. Run the application
```bash
php artisan serve
```
Access the app at: `http://localhost:8000`

---

## 🗄️ Database Design

### Tables
- **customers**: id, name, id_number, cif_number, address, email, date_of_birth, timestamps
- **accounts**: id, customer_id, account_number, account_type (saving, deposit), balance, timestamps
- **transactions**: id, account_id, type (deposit, withdraw, transfer), amount, target_account_id (nullable), timestamps

### Relationships
- Customer `hasMany` Accounts
- Account `belongsTo` Customer
- Account `hasMany` Transactions
- Transaction `belongsTo` Account
- Transaction (optional) `belongsTo` Target Account

---

## 🛡️ Security Measures

- Authentication required to access system.
- Input validation on all forms.
- Protection against SQL Injection.
- Confirmations for destructive actions (delete).

---

## 📋 Additional Notes

- Transactions automatically log to database.
- Transfers will update both source and target account balances.
- Withdraw and Transfer operations prevent account from overdrafting.

---

