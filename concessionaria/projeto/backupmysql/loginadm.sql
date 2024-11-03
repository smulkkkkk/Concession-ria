ALTER TABLE usuarios
ADD COLUMN e_admin TINYINT(1) DEFAULT 0;
UPDATE usuarios


SET e_admin = 1
WHERE email = 'adm@gmail.com';