-- after creating a new database(blank)

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  role ENUM('admin', 'mandir_org') NOT NULL,
  name VARCHAR(255),
  email VARCHAR(255) UNIQUE,
  password VARCHAR(255),
  created_at DATETIME,
  updated_at DATETIME
);

CREATE TABLE mandirs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  description VARCHAR(255),
  slug VARCHAR(255) UNIQUE,
  content TEXT,
  about_content TEXT,

  address_lat DOUBLE,
  address_long DOUBLE,

  website VARCHAR(255) NULL,
  facebook VARCHAR(255) NULL,
  youtube VARCHAR(255) NULL,

  cover_image VARCHAR(255) NULL,
  logo VARCHAR(255) NULL,

  primary_contact VARCHAR(50),
  secondary_contact VARCHAR(50) NULL,

  created_by INT,
  created_at DATETIME,
  updated_at DATETIME,

  CONSTRAINT fk_mandirs_created_by
    FOREIGN KEY (created_by) REFERENCES users(id)
);

CREATE TABLE campaigns (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  description VARCHAR(255),
  content TEXT,
  target_amount DOUBLE,
  type ENUM('event', 'campaign') NOT NULL,
  created_by_mandir INT,
  created_at DATETIME,
  updated_at DATETIME,

  CONSTRAINT fk_campaigns_mandir
    FOREIGN KEY (created_by_mandir) REFERENCES mandirs(id)
);

CREATE TABLE donations (
  id INT AUTO_INCREMENT PRIMARY KEY,
  amount_paid DOUBLE,
  payment_method VARCHAR(50),
  status VARCHAR(50),
  payment_metadata JSON,
  mandir_id INT NULL,
  campaign_id INT NULL,
  created_at DATETIME,

  CONSTRAINT fk_donations_mandir
    FOREIGN KEY (mandir_id) REFERENCES mandirs(id),
  CONSTRAINT fk_donations_campaign
    FOREIGN KEY (campaign_id) REFERENCES campaigns(id)
);

CREATE TABLE images (
  id INT AUTO_INCREMENT PRIMARY KEY,
  image_name VARCHAR(255),
  url VARCHAR(255),
  mandir_id INT NULL,

  CONSTRAINT fk_images_mandir
    FOREIGN KEY (mandir_id) REFERENCES mandirs(id)
);

CREATE TABLE announcements (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  image VARCHAR(255) NULL,
  description VARCHAR(255),
  start_date DATETIME,
  end_date DATETIME,
  redirect_url VARCHAR(255) NULL,

  created_by_mandir INT,
  verified BOOLEAN,
  verified_by INT NULL,

  created_at DATETIME,
  updated_at DATETIME,

  CONSTRAINT fk_announcements_mandir
    FOREIGN KEY (created_by_mandir) REFERENCES mandirs(id),
  CONSTRAINT fk_announcements_verified_by
    FOREIGN KEY (verified_by) REFERENCES users(id)
);

CREATE TABLE kyc_verifications (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mandir_id INT,
  document_url VARCHAR(255),
  document_type VARCHAR(50),
  status VARCHAR(50),
  submitted_at DATETIME,
  verified_at DATETIME NULL,
  verified_by INT NULL,

  CONSTRAINT fk_kyc_mandir
    FOREIGN KEY (mandir_id) REFERENCES mandirs(id),
  CONSTRAINT fk_kyc_verified_by
    FOREIGN KEY (verified_by) REFERENCES users(id)
);

CREATE TABLE faqs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question VARCHAR(255),
  answer VARCHAR(255),
  created_by_mandir INT,

  CONSTRAINT fk_faqs_mandir
    FOREIGN KEY (created_by_mandir) REFERENCES mandirs(id)
);
