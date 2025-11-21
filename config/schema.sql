-- Base users and auth
CREATE TABLE IF NOT EXISTS roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(255) DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    `key` VARCHAR(100) NOT NULL UNIQUE,
    description VARCHAR(255) DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS role_permissions (
    role_id INT NOT NULL,
    permission_id INT NOT NULL,
    PRIMARY KEY (role_id, permission_id),
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS sectors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    status ENUM('active','suspended') DEFAULT 'active',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    sector_id INT DEFAULT NULL,
    role_id INT DEFAULT NULL,
    status ENUM('active','suspended') DEFAULT 'active',
    profile_picture_path VARCHAR(255) DEFAULT NULL,
    theme_preference VARCHAR(50) DEFAULT 'light',
    language VARCHAR(10) DEFAULT 'en',
    date_format VARCHAR(20) DEFAULT 'Y-m-d',
    time_format VARCHAR(20) DEFAULT 'H:i',
    failed_login_attempts INT DEFAULT 0,
    lockout_until DATETIME DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (sector_id) REFERENCES sectors(id) ON DELETE SET NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS user_permissions_override (
    user_id INT NOT NULL,
    permission_id INT NOT NULL,
    allow TINYINT(1) NOT NULL DEFAULT 1,
    PRIMARY KEY (user_id, permission_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    message VARCHAR(255) NOT NULL,
    link VARCHAR(255) DEFAULT NULL,
    type ENUM('info','warning','success','error') DEFAULT 'info',
    is_read TINYINT(1) DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS user_preferences (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    pref_key VARCHAR(100) NOT NULL,
    pref_value TEXT,
    UNIQUE KEY unique_pref (user_id, pref_key),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS themes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    primary_color VARCHAR(20) DEFAULT '#2d6cdf',
    accent_color VARCHAR(20) DEFAULT '#f1c40f',
    background VARCHAR(20) DEFAULT '#ffffff',
    is_active TINYINT(1) DEFAULT 1
);

-- Activity log
CREATE TABLE IF NOT EXISTS activity_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    action_type VARCHAR(50) NOT NULL,
    module VARCHAR(100) NOT NULL,
    record_id INT DEFAULT NULL,
    description VARCHAR(255) DEFAULT NULL,
    old_data JSON DEFAULT NULL,
    new_data JSON DEFAULT NULL,
    ip VARCHAR(45) DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Lost and Found
CREATE TABLE IF NOT EXISTS lost_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    description TEXT NOT NULL,
    category VARCHAR(100) DEFAULT NULL,
    found_by VARCHAR(100) DEFAULT NULL,
    found_date DATE DEFAULT NULL,
    location TEXT DEFAULT NULL,
    tags VARCHAR(255) DEFAULT NULL,
    high_value TINYINT(1) DEFAULT 0,
    possible_owner VARCHAR(120) DEFAULT NULL,
    reservation_reference VARCHAR(120) DEFAULT NULL,
    state ENUM('New','Under review','Stored','Pending release','Released','Archived') DEFAULT 'New',
    archived TINYINT(1) DEFAULT 0,
    photo_paths JSON DEFAULT NULL,
    created_by INT DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    deleted_at DATETIME DEFAULT NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS lost_item_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    user_id INT NOT NULL,
    action VARCHAR(50) NOT NULL,
    note TEXT DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (item_id) REFERENCES lost_items(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS lost_item_releases (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    recipient_name VARCHAR(120) NOT NULL,
    recipient_id VARCHAR(50) DEFAULT NULL,
    contact VARCHAR(50) DEFAULT NULL,
    staff_name VARCHAR(120) DEFAULT NULL,
    released_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    staff_signature_path VARCHAR(255) DEFAULT NULL,
    recipient_signature_path VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (item_id) REFERENCES lost_items(id) ON DELETE CASCADE
);

-- Taxi log
CREATE TABLE IF NOT EXISTS taxi_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ride_time DATETIME NOT NULL,
    start_location VARCHAR(120) NOT NULL,
    destination VARCHAR(120) NOT NULL,
    guest_name VARCHAR(120) DEFAULT NULL,
    room_number VARCHAR(50) DEFAULT NULL,
    driver_name VARCHAR(120) DEFAULT NULL,
    price DECIMAL(10,2) DEFAULT 0,
    notes TEXT DEFAULT NULL,
    deleted_at DATETIME DEFAULT NULL,
    created_by INT DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);

-- Inventory
CREATE TABLE IF NOT EXISTS inventory_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    sku VARCHAR(100) DEFAULT NULL,
    category VARCHAR(100) DEFAULT NULL,
    location VARCHAR(150) DEFAULT NULL,
    quantity_on_hand INT DEFAULT 0,
    min_stock INT DEFAULT 0,
    max_stock INT DEFAULT 0,
    `condition` ENUM('new','used','damaged') DEFAULT 'new',
    status ENUM('active','archived','in_use','in_repair','scrapped') DEFAULT 'active',
    notes TEXT DEFAULT NULL,
    created_by INT DEFAULT NULL,
    deleted_at DATETIME DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS inventory_movements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    moved_at DATETIME NOT NULL,
    from_location VARCHAR(150) DEFAULT NULL,
    to_location VARCHAR(150) DEFAULT NULL,
    quantity_moved INT NOT NULL,
    reason VARCHAR(120) DEFAULT NULL,
    moved_by INT DEFAULT NULL,
    notes TEXT DEFAULT NULL,
    issued_signature_path VARCHAR(255) DEFAULT NULL,
    received_signature_path VARCHAR(255) DEFAULT NULL,
    deleted_at DATETIME DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (item_id) REFERENCES inventory_items(id) ON DELETE CASCADE,
    FOREIGN KEY (moved_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS stocktakes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    location VARCHAR(150) DEFAULT NULL,
    session_date DATE NOT NULL,
    created_by INT DEFAULT NULL,
    status ENUM('open','closed') DEFAULT 'open',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS stocktake_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    stocktake_id INT NOT NULL,
    item_id INT NOT NULL,
    expected_qty INT DEFAULT 0,
    counted_qty INT DEFAULT 0,
    FOREIGN KEY (stocktake_id) REFERENCES stocktakes(id) ON DELETE CASCADE,
    FOREIGN KEY (item_id) REFERENCES inventory_items(id) ON DELETE CASCADE
);

-- Doctor log
CREATE TABLE IF NOT EXISTS doctor_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    room_number VARCHAR(50) NOT NULL,
    time_called DATETIME NOT NULL,
    time_arrived DATETIME DEFAULT NULL,
    doctor_name VARCHAR(120) NOT NULL,
    reason TEXT DEFAULT NULL,
    status ENUM('open','closed') DEFAULT 'open',
    deleted_at DATETIME DEFAULT NULL,
    created_by INT DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL
);

-- Notes
CREATE TABLE IF NOT EXISTS notes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    body TEXT NOT NULL,
    note_type ENUM('Personal','Team','Task','Reminder') DEFAULT 'Personal',
    tags VARCHAR(255) DEFAULT NULL,
    reminder_at DATETIME DEFAULT NULL,
    pinned TINYINT(1) DEFAULT 0,
    is_deleted TINYINT(1) DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS note_comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    note_id INT NOT NULL,
    user_id INT NOT NULL,
    comment TEXT NOT NULL,
    is_deleted TINYINT(1) DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (note_id) REFERENCES notes(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS note_shares (
    id INT AUTO_INCREMENT PRIMARY KEY,
    note_id INT NOT NULL,
    shared_with_user_id INT DEFAULT NULL,
    shared_with_sector_id INT DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (note_id) REFERENCES notes(id) ON DELETE CASCADE,
    FOREIGN KEY (shared_with_user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (shared_with_sector_id) REFERENCES sectors(id) ON DELETE CASCADE
);

-- User sessions history
CREATE TABLE IF NOT EXISTS login_history (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    ip VARCHAR(45) DEFAULT NULL,
    user_agent VARCHAR(255) DEFAULT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- CMS settings
CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT DEFAULT NULL,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Seed basic roles
INSERT INTO roles (id, name, description) VALUES
    (1, 'app_owner', 'Full access')
    ON DUPLICATE KEY UPDATE name = VALUES(name);

-- Seed default admin user (password: password)
INSERT INTO users (id, name, email, password_hash, role_id, status)
VALUES (1, 'App Owner', 'owner@example.com', '$2y$10$CdKyfZxfb/3Tbt5JGLO9e.aEux8io3gn.IVosLygE0Lp7Ox48HoZu', 1, 'active')
ON DUPLICATE KEY UPDATE email = VALUES(email);
