```markdown
# 🚀 Project Alpha - SaaS Proje ve Görev Yönetim Sistemi

Project Alpha, yazılım ekipleri ve şirketler için tasarlanmış, çok kiracılı (multi-tenant) yapıyı desteklemeye hazır, modern ve güvenli bir Kanban tabanlı proje yönetim platformudur. 

Rol tabanlı erişim kontrolü (RBAC), sürükle-bırak Kanban panoları, görev içi canlı sohbet ve gelişmiş bir Admin konsolu ile ekiplerin verimliliğini artırmayı hedefler.

## ✨ Temel Özellikler

- **🔒 Güvenli Kimlik Doğrulama:** Şifreleme (bcrypt) ve oturum (session) yönetimi ile güvenli giriş/kayıt sistemi.
- **👥 Rol Tabanlı Erişim (RBAC):** Admin, Product Manager (PM) ve Developer rolleri ile yetkilendirme.
- **📋 Kanban Board:** Vanilla JavaScript ve HTML5 Drag & Drop API ile akıcı görev taşıma deneyimi.
- **💬 Görev İçi İletişim:** Görev kartlarına tıklandığında açılan özel modallar üzerinden takım içi anlık yorumlaşma ve tartışma (Chat) sistemi.
- **🏢 Çalışma Alanı (Workspace) Yönetimi:** Proje oluşturma, projeye takım üyesi atama ve projeleri yönetme.
- **⚙️ Gelişmiş Admin Konsolu:** - Kullanıcı yetkilerini (rollerini) anında değiştirme.
  - Personel işten ayrıldığında verileri bozmadan hesabı askıya alma (Soft Delete / Deactivate).
  - Silinen/Kapatılan projeleri arşivleme ve panodan gizleme.
- **🎨 Modern Arayüz:** Bootstrap 5 ile geliştirilmiş, tamamen duyarlı (responsive) Dark Mode tasarımı.

## 🛠️ Kullanılan Teknolojiler

**Frontend:**
- HTML5 & CSS3
- Bootstrap 5.3
- Vanilla JavaScript (ES6+)
- Fetch API (Asenkron veri iletişimi)

**Backend:**
- PHP 8.x (Nesne Yönelimli ve PDO kullanılarak)
- Mimarisi: Özel Router (index.php üzerinden) ve Micro-Controller yapısı

**Veritabanı:**
- MySQL / MariaDB
- İlişkisel veritabanı tasarımı (Foreign Keys, Cascade Deletes)

## 📁 Proje Yapısı

```text
project-alpha/
│
├── config/
│   └── db.php                 # Veritabanı PDO bağlantı ayarları
│
├── controllers/               # Asenkron (Fetch) işlemleri işleyen API dosyaları
│   ├── auth_process.php       # Giriş ve kayıt işlemleri
│   ├── create_project.php     # Yeni proje oluşturma ve takım atama
│   ├── update_task.php        # Kanban sürükle-bırak durum güncellemeleri
│   ├── add_comment.php        # Görev içi yorum ekleme
│   ├── update_role.php        # (Admin) Kullanıcı yetki değiştirme
│   └── ...
│
├── public/
│   ├── css/
│   │   └── style.css          # Özel CSS ve Dark Theme ayarları
│   └── js/
│       └── script.js          # Modal kontrolleri, Drag & Drop ve Fetch istekleri
│
├── views/                     # Kullanıcı arayüzü dosyaları
│   ├── login.php
│   ├── register.php
│   ├── dashboard.php          # Aktif projelerin listelendiği ana sayfa
│   ├── kanban.php             # Sürükle-bırak görev panosu
│   ├── backlog.php            # Bekleyen görevler listesi
│   └── admin.php              # Yetkili yönetim konsolu
│
├── database.sql               # Veritabanı tabloları ve örnek veriler (İçe aktarılacak)
└── index.php                  # Ana Router ve Güvenlik Middleware'i

```

## 🚀 Kurulum Adımları

Projeyi kendi yerel ortamınızda (Localhost) çalıştırmak için aşağıdaki adımları izleyin:

### 1. Gereksinimler

* PHP 8.0 veya üzeri bir sunucu (XAMPP, MAMP, Laragon vb.)
* MySQL Veritabanı

### 2. Adımlar

1. **Repoyu Klonlayın:**
```bash
git clone [https://github.com/kullanici-adiniz/project-alpha.git](https://github.com/kullanici-adiniz/project-alpha.git)
cd project-alpha

```


2. **Veritabanını Hazırlayın:**
* MySQL'de `project_alpha` (veya dilediğiniz bir isimde) yeni bir veritabanı oluşturun.
* Proje ana dizinindeki `database.sql` (eğer dışa aktardıysanız) dosyasını bu veritabanına import edin.


3. **Veritabanı Bağlantısını Ayarlayın:**
* `config/db.php` dosyasını açın.
* Veritabanı adı, kullanıcı adı ve şifre bilgilerinizi kendi sisteminize göre güncelleyin.


4. **Uygulamayı Çalıştırın:**
* Sunucunuzu başlatın ve tarayıcınızda uygulamanın bulunduğu dizine gidin (örneğin: `http://localhost/project-alpha`).



### 👑 İlk Admin Hesabını Oluşturma

Sistem güvenlik gereği dışarıdan doğrudan "Admin" kaydına izin vermez. Sistemin tüm özelliklerini test etmek için:

1. Uygulama üzerinden normal bir hesap (Register) oluşturun.
2. MySQL veritabanınıza (phpMyAdmin vb.) girin.
3. `users` tablosunu açın ve kendi hesabınızın `system_role` sütununu `developer` yerine `admin` olarak değiştirin.
4. Sayfayı yenilediğinizde üst menüde kırmızı renkli **Admin Console** butonunu göreceksiniz.

## 📸 Ekran Görüntüleri

## 📄 Lisans

Bu proje [MIT Lisansı](https://www.google.com/search?q=LICENSE) altında lisanslanmıştır. Dilediğiniz gibi kullanabilir, geliştirebilir ve paylaşabilirsiniz.

```

```
# 🚀 Project Alpha - SaaS Project and Task Management System

Project Alpha is a modern and secure Kanban-based project management platform designed for software teams and companies, ready to support multi-tenant architecture. 

It aims to increase team productivity with Role-Based Access Control (RBAC), drag-and-drop Kanban boards, in-task live chat, and an advanced Admin console.

## ✨ Key Features

- **🔒 Secure Authentication:** Secure login/registration system with encryption (bcrypt) and session management.
- **👥 Role-Based Access Control (RBAC):** Authorization with Admin, Product Manager (PM), and Developer roles.
- **📋 Kanban Board:** Fluid task movement experience with Vanilla JavaScript and HTML5 Drag & Drop API.
- **💬 In-Task Communication:** Real-time team commenting and discussion (Chat) system via custom modals triggered by clicking on task cards.
- **🏢 Workspace Management:** Project creation, team member assignment, and project management.
- **⚙️ Advanced Admin Console:** - Instantly change user permissions (roles).
  - Suspend accounts without corrupting data when an employee leaves (Soft Delete / Deactivate).
  - Archive deleted/closed projects and hide them from the dashboard.
- **🎨 Modern Interface:** Fully responsive Dark Mode design built with Bootstrap 5.

## 🛠️ Technologies Used

**Frontend:**
- HTML5 & CSS3
- Bootstrap 5.3
- Vanilla JavaScript (ES6+)
- Fetch API (Asynchronous data communication)

**Backend:**
- PHP 8.x (Object-Oriented using PDO)
- Architecture: Custom Router (via index.php) and Micro-Controller structure

**Database:**
- MySQL / MariaDB
- Relational database design (Foreign Keys, Cascade Deletes)

## 📁 Project Structure

```text
project-alpha/
│
├── config/
│   └── db.php                 # Database PDO connection settings
│
├── controllers/               # API files handling asynchronous (Fetch) operations
│   ├── auth_process.php       # Login and registration processes
│   ├── create_project.php     # New project creation and team assignment
│   ├── update_task.php        # Kanban drag-and-drop status updates
│   ├── add_comment.php        # Adding in-task comments
│   ├── update_role.php        # (Admin) Changing user roles
│   └── ...
│
├── public/
│   ├── css/
│   │   └── style.css          # Custom CSS and Dark Theme adjustments
│   └── js/
│       └── script.js          # Modal controls, Drag & Drop, and Fetch requests
│
├── views/                     # User interface files
│   ├── login.php
│   ├── register.php
│   ├── dashboard.php          # Main page listing active projects
│   ├── kanban.php             # Drag-and-drop task board
│   ├── backlog.php            # Pending tasks list
│   └── admin.php              # Authorized management console
│
├── database.sql               # Database tables and sample data (To be imported)
└── index.php                  # Main Router and Security Middleware
