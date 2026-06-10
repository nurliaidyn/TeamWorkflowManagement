<div align="center">

# 🚀 Project Alpha

### SaaS Proje & Görev Yönetim Sistemi

[![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?logo=php&logoColor=white)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?logo=mysql&logoColor=white)](https://mysql.com)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![Lisans](https://img.shields.io/badge/Lisans-MIT-green.svg)](LICENSE)

<p align="center">
  <img src="https://github.com/user-attachments/assets/de36fcb6-37f8-4548-8ce7-720d8e28f2ab" width="80%" alt="Dashboard Önizleme" />
</p>

**Yazılım ekipleri için modern, güvenli, Kanban tabanlı proje yönetim platformu.**

[Özellikler](#-özellikler) • [Ekran Görüntüleri](#-ekran-görüntüleri) • [Kurulum](#-kurulum) • [Kullanım](#-kullanım) • [Katkıda Bulunma](#-katkıda-bulunma)

</div>

---

## 📋 İçindekiler

- [Hakkında](#-hakkında)
- [Özellikler](#-özellikler)
- [Teknolojiler](#-teknolojiler)
- [Mimari](#-mimari)
- [Ekran Görüntüleri](#-ekran-görüntüleri)
- [Kurulum](#-kurulum)
- [Yapılandırma](#-yapılandırma)
- [Kullanım](#-kullanım)
- [API Uç Noktaları](#-api-uç-noktaları)
- [Veritabanı Şeması](#-veritabanı-şeması)
- [Güvenlik](#-güvenlik)
- [Katkıda Bulunma](#-katkıda-bulunma)
- [Lisans](#-lisans)

---

## 🎯 Hakkında

**Project Alpha**, yazılım ekipleri ve şirketler için tasarlanmış, çok kiracılı (multi-tenant) yapıya hazır, rol tabanlı proje yönetim sistemidir.

**Güvenlik**, **kullanılabilirlik** ve **performans** odaklı olarak geliştirilmiştir. Projeleri, görevleri ve ekip iletişimini tek bir yerden yönetmenizi sağlar.

### Neden Project Alpha?

- 🔒 **Güvenlik Öncelikli** — bcrypt şifreleme, oturum yönetimi ve RBAC
- ⚡ **Hafif** — Ağır framework yok, saf PHP + vanilla JS
- 🎨 **Modern Arayüz** — Karanlık mod, duyarlı tasarım, sezgisel UX
- 🏗️ **Ölçeklenebilir** — Çok kiracılı mimari, SaaS dağıtımına hazır

---

## ✨ Özellikler

### 🔐 Kimlik Doğrulama & Yetkilendirme
- **bcrypt** ile güvenli giriş/kayıt sistemi
- Güvenlik middleware'i ile oturum tabanlı kimlik doğrulama
- Üç rol ile **Rol Tabanlı Erişim Kontrolü (RBAC)**:
  | Rol | Yetkiler |
  |------|------------|
  | 👑 **Admin** | Tam sistem erişimi, kullanıcı yönetimi, proje arşivleme |
  | 📊 **Product Manager** | Proje oluşturma, ekip atama, görev denetimi |
  | 💻 **Developer** | Görev yönetimi, yorum yapma, Kanban panosu erişimi |

### 📋 Kanban Panosu
- Yerel **HTML5 Drag & Drop API** ile sürükle-bırak görev yönetimi
- Gerçek zamanlı durum güncellemeleri (Yapılacak → Devam Ediyor → Tamamlandı)
- Akıcı vanilla JavaScript animasyonları
- Görev önceliği ve atama görselleştirmesi

### 💬 Gerçek Zamanlı İşbirliği
- Özel modal pencereler üzerinden **görev içi sohbet sistemi**
- Belirli görevlere bağlı ekip tartışmaları
- Zaman damgalı yorum geçmişi

### 🏢 Çalışma Alanı Yönetimi
- Birden fazla proje oluşturma ve yönetme
- Projelere ekip üyesi atama
- Proje arşivleme ve soft-delete işlevselliği

### ⚙️ Admin Konsolu
- **Kullanıcı Yönetimi**: Kullanıcı rollerini anında değiştirme
- **Hesap Askıya Alma**: Veri kaybı olmadan soft delete/devre dışı bırakma
- **Proje Arşivleme**: Kapatılan projeleri panodan gizleme
- **Sistem Genel Bakış**: Tüm projeleri ve kullanıcıları izleme

### 🎨 Arayüz/UX
- Tamamen duyarlı **Karanlık Mod** tasarımı
- Bootstrap 5.3 ile özel tema
- Mobil uyumlu arayüz
- Temiz, modern estetik

---

## 🛠️ Teknolojiler

### Frontend
| Teknoloji | Amaç |
|-----------|---------|
| HTML5 & CSS3 | Yapı ve stil |
| Bootstrap 5.3 | UI framework'ü |
| Vanilla JavaScript (ES6+) | Etkileşim, Sürükle-Bırak, Fetch API |
| Fetch API | Asenkron sunucu iletişimi |

### Backend
| Teknoloji | Amaç |
|-----------|---------|
| PHP 8.x | Sunucu tarafı mantığı (OOP + PDO) |
| Özel Router | `index.php` üzerinden URL yönlendirme |
| Mikro-Kontrolör | Hafif mimari |
| Oturum Yönetimi | Güvenli kimlik doğrulama |

### Veritabanı
| Teknoloji | Amaç |
|-----------|---------|
| MySQL / MariaDB | İlişkisel veri depolama |
| PDO | Güvenli veritabanı soyutlama |
| Foreign Keys | Veri bütünlüğü |
| Cascade Deletes | Otomatik temizlik |

---

## 🏗️ Mimari

```
project-alpha/
│
├── 📁 config/
│   └── db.php                    # PDO veritabanı bağlantısı
│
├── 📁 controllers/               # API uç noktaları (asenkron işleyiciler)
│   ├── auth_process.php          # Giriş & kayıt
│   ├── create_project.php        # Proje oluşturma & ekip atama
│   ├── update_task.php           # Kanban sürükle-bırak güncellemeleri
│   ├── add_comment.php           # Görev yorumları
│   ├── update_role.php           # Admin: rol yönetimi
│   └── ...
│
├── 📁 public/
│   ├── 📁 css/
│   │   └── style.css             # Özel CSS + Karanlık Tema
│   └── 📁 js/
│       └── script.js             # Modallar, Sürükle-Bırak, Fetch
│
├── 📁 views/                      # UI şablonları
│   ├── login.php
│   ├── register.php
│   ├── dashboard.php             # Aktif projeler
│   ├── kanban.php                # Görev panosu
│   ├── backlog.php               # Bekleyen görevler
│   └── admin.php                 # Admin konsolu
│
├── database.sql                   # Şema + örnek veriler
├── index.php                      # Router + Güvenlik Middleware'i
└── LICENSE
```

---

## 📸 Video Linki
https://drive.google.com/file/d/1ZK-hAz7mF4bmEyc4bh_eWj3xySJTgSM-/view?usp=sharing

## 📸 Ekran Görüntüleri

<div align="center">

| Dashboard | Kanban Panosu | Admin Konsolu |
|:---------:|:----------:|:-------------:|
| <img src="https://github.com/user-attachments/assets/de36fcb6-37f8-4548-8ce7-720d8e28f2ab" width="250" /> | <img src="https://github.com/user-attachments/assets/c1505823-a050-47ac-8539-9c2be3b6838d" width="250" /> | <img src="https://github.com/user-attachments/assets/82d5d763-2916-4a86-8326-2235b7e793ae" width="250" /> |
| **Proje Genel Bakış** | **Sürükle & Bırak Görevler** | **Kullanıcı Yönetimi** |

| Görev Modalı |
|:----------:|
| <img src="https://github.com/user-attachments/assets/8e72e160-abed-43ce-8ecd-4b27f16da247" width="500" /> |
| **Görev İçi Sohbet & Detaylar** |

</div>

---

## 🚀 Kurulum

### Gereksinimler

- PHP 8.0+ (XAMPP, MAMP, Laragon veya herhangi bir PHP sunucusu)
- MySQL 5.7+ veya MariaDB 10.3+
- Web tarayıcısı (Chrome, Firefox, Safari, Edge)

### Adım Adım Kurulum

#### 1. Repoyu Klonlayın

```bash
git clone https://github.com/kullanici-adiniz/project-alpha.git
cd project-alpha
```

#### 2. Veritabanını Oluşturun

```sql
-- MySQL CLI veya phpMyAdmin kullanarak
CREATE DATABASE project_alpha CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

#### 3. Şemayı İçe Aktarın

```bash
# MySQL CLI kullanarak
mysql -u root -p project_alpha < database.sql

# Veya phpMyAdmin GUI üzerinden içe aktarın
```

#### 4. Veritabanı Bağlantısını Yapılandırın

`config/db.php` dosyasını düzenleyin:

```php
<?php
$host = 'localhost';
$db   = 'project_alpha';
$user = 'root';        // MySQL kullanıcı adınız
$pass = '';            // MySQL şifreniz
$charset = 'utf8mb4';

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
```

#### 5. İzinleri Ayarlayın (Linux/Mac)

```bash
chmod 755 -R project-alpha/
chmod 777 -R project-alpha/public/uploads/  # Dosya yükleme kullanıyorsanız
```

#### 6. Sunucuyu Başlatın

```bash
# PHP yerleşik sunucusunu kullanarak
php -S localhost:8000

# Veya XAMPP/MAMP üzerinden erişin:
# http://localhost/project-alpha
```

---

## ⚙️ Yapılandırma

### Ortam Değişkenleri (İsteğe Bağlı)

Kök dizinde `.env` dosyası oluşturun:

```env
DB_HOST=localhost
DB_NAME=project_alpha
DB_USER=root
DB_PASS=sifreniz
APP_ENV=development
APP_URL=http://localhost:8000
```

### Güvenlik Ayarları

- Oturum zaman aşımı: 30 dakika (`index.php`'de yapılandırılabilir)
- Minimum şifre uzunluğu: 8 karakter
- Tüm formlarda CSRF koruması etkin
- SQL enjeksiyon önleme: hazır ifadeler (prepared statements)

---

## 💡 Kullanım

### İlk Admin Hesabını Oluşturma

> ⚠️ **Güvenlik Uyarısı:** Güvenlik nedeniyle doğrudan admin kaydına izin verilmez.

1. **Web arayüzü üzerinden normal bir hesap** oluşturun
2. **Veritabanınıza erişin** (phpMyAdmin veya MySQL CLI)
3. **Kullanıcı rolünü güncelleyin:**

```sql
UPDATE users 
SET system_role = 'admin' 
WHERE email = 'eposta@ornek.com';
```

4. **Sayfayı yenileyin** — navigasyonda 🔴 **Admin Konsolu** butonu belirecektir

### Kullanıcı İş Akışları

#### 👑 Admin
```
Dashboard → Admin Konsolu → Kullanıcı/Proje Yönetimi
```

#### 📊 Product Manager
```
Dashboard → Proje Oluştur → Ekip Ata → İlerlemeyi İzle
```

#### 💻 Developer
```
Dashboard → Proje Seç → Kanban Panosu → Sürükle & Bırak Görevler → Yorum Yap
```

---

## 🔌 API Uç Noktaları

| Uç Nokta | Metod | Açıklama | Yetki Gerekli |
|----------|--------|-------------|---------------|
| `/controllers/auth_process.php` | POST | Giriş / Kayıt | Hayır |
| `/controllers/create_project.php` | POST | Yeni proje oluştur | PM+ |
| `/controllers/update_task.php` | POST | Görev durumunu güncelle | Dev+ |
| `/controllers/add_comment.php` | POST | Göreve yorum ekle | Dev+ |
| `/controllers/update_role.php` | POST | Kullanıcı rolünü değiştir | Admin |
| `/controllers/archive_project.php` | POST | Projeyi arşivle | Admin |
| `/controllers/deactivate_user.php` | POST | Kullanıcıyı soft delete | Admin |

---

## 🗄️ Veritabanı Şeması

### Temel Tablolar

```sql
-- Kullanıcılar
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    system_role ENUM('admin', 'pm', 'developer') DEFAULT 'developer',
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Projeler
CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200) NOT NULL,
    description TEXT,
    created_by INT,
    is_archived BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id)
);

-- Proje Üyeleri
CREATE TABLE project_members (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT,
    user_id INT,
    role ENUM('owner', 'member') DEFAULT 'member',
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Görevler
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_id INT,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    status ENUM('todo', 'in_progress', 'done') DEFAULT 'todo',
    priority ENUM('low', 'medium', 'high') DEFAULT 'medium',
    assigned_to INT,
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (assigned_to) REFERENCES users(id),
    FOREIGN KEY (created_by) REFERENCES users(id)
);

-- Yorumlar
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_id INT,
    user_id INT,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (task_id) REFERENCES tasks(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

---

## 🔒 Güvenlik

- ✅ **Şifre Hash'leme**: bcrypt, maliyet faktörü 12
- ✅ **SQL Enjeksiyon Önleme**: PDO hazır ifadeleri
- ✅ **XSS Koruması**: Tüm görünümlerde çıktı kodlama
- ✅ **CSRF Token'ları**: Tüm durum değiştiren formlarda uygulandı
- ✅ **Oturum Güvenliği**: ID yenileme, güvenli bayraklar, zaman aşımı
- ✅ **Rol Doğrulama**: Her istekte sunucu tarafı yetki kontrolü
- ✅ **Girdi Doğrulama**: Katı tip kontrolü ve sanitizasyon

---

## 🤝 Katkıda Bulunma

Katkılarınızı bekliyoruz! Lütfen şu adımları izleyin:

1. **Fork** yapın
2. **Branch oluşturun**: `git checkout -b feature/harika-ozellik`
3. **Değişiklikleri commit edin**: `git commit -m 'Harika özellik ekle'`
4. **Branch'e push yapın**: `git push origin feature/harika-ozellik`
5. **Pull Request açın**

### Kod Standartları

- PSR-12 kodlama standartlarını takip edin
- Anlamlı değişken isimleri kullanın
- Karmaşık mantığı yorumlayın
- Güvenli kod yazın (tüm girdileri doğrulayın)

---

## 📝 Lisans

Bu proje **MIT Lisansı** altında lisanslanmıştır — detaylar için [LICENSE](LICENSE) dosyasına bakın.

Şunları yapmakta özgürsünüz:
- ✅ Ticari kullanım
- ✅ Değiştirme ve dağıtma
- ✅ Özel kullanım
- ✅ Alt lisanslama

---

## 🙏 Teşekkürler

- [Bootstrap](https://getbootstrap.com) — Mükemmel UI framework'ü için
- [Font Awesome](https://fontawesome.com) — İkonlar için
- [GitHub](https://github.com) — Açık kaynağı barındırdığı için

---

<div align="center">

**Yazılım ekipleri için ❤️ ile yapıldı**

[⬆ Başa Dön](#-project-alpha)

</div>
