# 🐴 PetNature

> Dynamic website for a pedigree animal breeder, where users can register, browse animals and accessories, fill a shopping cart and place orders. Developed as a university project for the **Web Technologies** course (Academic Year 2023/2024, Group 07) at the University of Salerno (Unisa).

---

## 👥 Collaborators
- **Anzivino Giuseppe Fabrizio** — [@GiuseppeAnzivino](https://github.com/GiuseppeAnzivino)
- **Petrone Gianluca**
- **Trofimets Antonio**

---

## 📋 Table of Contents
- [About the Project](#about)
- [Pages & Features](#features)
- [Tech Stack](#tech-stack)
- [Development Environment](#environment)
- [Database](#database)
- [Repository Structure](#structure)
- [How to Run](#run)
- [License](#license)

---

<a id="about"></a>
## 🚀 About the Project
PetNature is a website that facilitates the interaction between potential customers and a breeder of pedigree animals. Users register, learn more about the business, select animals and care accessories and place an order; after the order, they are contacted by email to arrange the pickup.

The complete report (in Italian) is available in [`docs/`](docs/).

---

<a id="features"></a>
## ✨ Pages & Features
The site is made of dynamic pages, each with a header, a footer and a side bar showing account information (or an invitation to log in or register):

| Page | Description |
|---|---|
| **Home** | Slider with video backgrounds, used as the main navigation to the other pages |
| **About Us** | Presentation of the business: values, availability and family-run tradition |
| **Animals / Accessories** | Flip cards with image, price, description and "add to cart" button |
| **Cart** | Table of the selected products, item removal and order confirmation |
| **Login / Register** | Forms with animated inputs, password visibility toggle and error alerts |

**Main features:**
- **User registration and login**, with encrypted passwords and unique emails.
- **Anonymous access:** images, prices and descriptions are blurred and adding to the cart is disabled for users who are not logged in.
- **Shopping cart:** add and remove products, confirm the order and save it in the database.
- **Alerts** for invalid or already used emails, non-existent accounts and wrong passwords.
- **Responsive layout** for different screen sizes, with CSS animations (`@keyframes`) and JavaScript-driven effects (slider, flip cards, fade-in, side bar).
- A **wireframe** was used in the design phase to plan the structure and navigation.

---

<a id="tech-stack"></a>
## 🛠️ Tech Stack
- **Front end:** HTML, CSS, JavaScript ([Boxicons](https://boxicons.com/) for icons, loaded from a CDN)
- **Back end:** PHP
- **Database:** PostgreSQL
- **Style sheets:** one per area of the site (`header`, `footer`, `mynav`, `home`, `chisiamo`, `shop`, `carrello`, `sign_or_log`), with `@media` rules for responsiveness
- **Deployment:** Docker Compose (PHP with Apache, and PostgreSQL)

---

<a id="environment"></a>
## 💻 Development Environment
### Original university setup
The website was developed on **Windows** with:
- **Visual Studio Code** as code editor
- **XAMPP** (Apache and PHP) as local web server
- a local **PostgreSQL** installation as database, managed separately from XAMPP

With this setup, running the project meant installing and configuring all these tools, creating the database and importing the data by hand.

### This repository: Docker version
To make the project easy to view on any machine, a **Docker** configuration was added after the course. A single command starts both a PHP/Apache web server and a PostgreSQL database that is created and populated automatically from [`database/backup.sql`](database/backup.sql), with nothing else to install.

The application code is the same as the original one. The only change is in `src/db/connectDb.php`, where the connection settings are now read from environment variables (`DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASS`), with the values of a local PostgreSQL as defaults (`localhost`, port `5432`, database `Gruppo07`, user `postgres`).

| | Original setup | Docker version |
|---|---|---|
| **Tools** | VS Code, XAMPP, PostgreSQL | Docker |
| **Web server** | XAMPP (Apache + PHP) | PHP + Apache container |
| **Database** | Local PostgreSQL, set up by hand | PostgreSQL container, set up automatically |

---

<a id="database"></a>
## 🗄️ Database
The database is made of three tables:

| Table | Content |
|---|---|
| `utente` | Account data: first name, last name, encrypted password and email (primary key, so that each email can register only one account) |
| `ordine_generale` | Order data: order id (primary key), user email, date and total amount |
| `ordine_dettagliato` | Products of each order: product id (primary key), order id, product and price |

Orders are split into two tables so that a single order can contain several products: rows in `ordine_dettagliato` with the same order id belong to the same order.

The database dump is in [`database/backup.sql`](database/backup.sql).

---

<a id="structure"></a>
## 📂 Repository Structure
```
.
├── README.md
├── LICENSE
├── .gitignore
├── Dockerfile
├── docker-compose.yml
├── docker/
│   └── 00-roles.sql            database role created before the import
├── docs/
│   └── Relazione_Web.pdf       full project report (in Italian)
├── database/
│   └── backup.sql              PostgreSQL dump
└── src/
    ├── php/                    server-side pages and scripts
    ├── css/                    style sheets
    ├── javascript/             client-side scripts
    ├── db/                     database connection and account/order scripts
    ├── immagini/               images
    └── video/                  slider background videos
```

---

<a id="run"></a>
## ⚙️ How to Run
The website runs with **Docker**: the only requirement is having Docker installed.

### 1. Install Docker
- **Windows / macOS:** download and install [Docker Desktop](https://www.docker.com/products/docker-desktop/). On Windows the installer enables WSL 2 if needed (a restart may be required). Start Docker Desktop and wait until it reports that Docker is running.
- **Linux (Ubuntu/Debian):** follow the [official guide](https://docs.docker.com/engine/install/). Then add your user to the `docker` group, so that you can run Docker without `sudo`:
  ```bash
  sudo usermod -aG docker $USER
  ```
  and log out and back in.

Check the installation:
```bash
docker --version
docker compose version
```

### 2. Get the project
```bash
git clone https://github.com/GiuseppeAnzivino/petnature-website.git
cd petnature-website
```

### 3. Start the website
```bash
docker compose up --build
```
The first run downloads the images and may take a few minutes. When the logs settle, open <http://localhost:8080/php/home.php> in your browser.

### 4. Stop the website
- Press `Ctrl+C` in the terminal where it is running.
- To reset the database to its initial state, run `docker compose down -v`.

> The database credentials in `docker-compose.yml` are for local testing only.

### Troubleshooting
| Problem | Solution |
|---|---|
| `permission denied` when running Docker (Linux) | Run `sudo usermod -aG docker $USER` and log in again |
| Port 8080 already in use | Change `"8080:80"` in `docker-compose.yml` (e.g. `"8081:80"`) and use the new port in the URL |
| Icons are missing | An internet connection is required: icons are loaded from a CDN |
| The database does not reflect changes to `backup.sql` | The dump is imported only on first start: run `docker compose down -v` and start again |

---

<a id="license"></a>
## 📄 License
All rights reserved. This repository is published for viewing and educational reference only. See [`LICENSE`](LICENSE) for details.