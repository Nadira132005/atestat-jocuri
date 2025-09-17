# Atestat Jocuri - Online Games Platform

**Note:** This project is developed in Romanian, with code files, comments, and user-facing text primarily in Romanian. The README is provided in English for broader accessibility

## Description
The "Atestat Jocuri" project is a simple web application built with PHP, designed to provide a platform for managing and accessing online games. It is likely a school or thesis project ("atestat" in Romanian educational context), featuring authentication, game listings, and reviews. The application includes a responsive design, images for popular games (e.g., Among Us, Angry Birds, Chess), and a modular structure for components.

## Technologies Used
- **Backend:** PHP (version 7+ or 8+)
- **Frontend:** HTML, CSS (files in `style/`), JavaScript (if implemented)
- **Database:** MySQL for accounts and reviews (based on login and account creation files)

## Main Features
- **Authentication:** Pages for login (`login.php`) and account creation (`creeaza-cont.php` – "create account" in Romanian).
- **Games List:** Display games with images (`jocuri.php` – "games" in Romanian).
- **Reviews:** Review system for games (`review.php`).
- **Navigation:** Navbar component for menu (`components/navbar/`).
- **Static Pages:** Main index (`index.php`) and additional pages in `pages/`.
- **Utilities:** Utility files in `utils/`.

## Folder Structure
```
atestat-jocuri/
├── creeaza-cont.php      # Account creation form
├── index.php             # Main page
├── jocuri.php            # Games list
├── login.php             # Login form
├── review.php            # Reviews page
├── components/           # Reusable components
│   └── navbar/           # Navbar HTML/CSS/JS
├── images/               # Game images
│   ├── among-us.jpg
│   ├── angry-birds.jpg
│   ├── chess.jpg
│   └── ... (other game images)
├── pages/                # Additional pages
├── style/                # CSS files
└── utils/                # PHP utility functions
```

## Installation and Setup
1. **Clone Repository:**
   ```
   git clone <repository-URL> atestat-jocuri
   cd atestat-jocuri
   ```

2. **Web Server Setup:**
   - Install a local server: XAMPP, WAMP, or MAMP (for PHP + Apache + MySQL).
   - Place the folder in the htdocs directory (e.g., `/opt/lampp/htdocs/atestat-jocuri` for XAMPP on Linux).
   - Ensure PHP extensions are enabled (e.g., `pdo_mysql` for database).

3. **Database:**
   - Create a MySQL database (e.g., `atestat_jocuri`).
   - Configure the connection in PHP files (e.g., add a `config.php` in `utils/` with DB details: host, user, pass, dbname).

5. **Run the Application:**
   - Start the Apache server (e.g., `sudo /opt/lampp/lampp start`).
   - Access `http://localhost/atestat-jocuri/` in your browser.
