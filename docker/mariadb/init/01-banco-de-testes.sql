-- Banco separado para os testes automatizados (phpunit.xml), com o mesmo usuário da aplicação.
CREATE DATABASE IF NOT EXISTS b2bsafe_testes CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
GRANT ALL PRIVILEGES ON b2bsafe_testes.* TO 'b2bsafe'@'%';
FLUSH PRIVILEGES;
