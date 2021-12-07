<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211206024649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cita (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', doctor_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', tipo_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', estado_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', paciente_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', fecha_hora DATETIME NOT NULL, descripcion LONGTEXT NOT NULL, INDEX IDX_3E379A6287F4FB17 (doctor_id), INDEX IDX_3E379A62A9276E6C (tipo_id), INDEX IDX_3E379A629F5A440B (estado_id), INDEX IDX_3E379A627310DAD4 (paciente_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultorio (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', nombre VARCHAR(200) NOT NULL, UNIQUE INDEX UNIQ_A41553833A909126 (nombre), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE doctor (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', especialidad_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', consultorio_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', secretaria_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', email VARCHAR(180) NOT NULL, UNIQUE INDEX UNIQ_1FC0F36AE7927C74 (email), UNIQUE INDEX UNIQ_1FC0F36AA76ED395 (user_id), INDEX IDX_1FC0F36A16A490EC (especialidad_id), INDEX IDX_1FC0F36A79798A31 (consultorio_id), INDEX IDX_1FC0F36A584CC12E (secretaria_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE especialidad (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', nombre VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estado_cita (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', nombre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE paciente (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', nombre VARCHAR(200) NOT NULL, apellidos VARCHAR(200) NOT NULL, correo VARCHAR(100) DEFAULT NULL, telefono BIGINT NOT NULL, fecha_registro DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secretaria (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', user_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', UNIQUE INDEX UNIQ_C39D81C2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo_cita (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', nombre VARCHAR(200) NOT NULL, precio SMALLINT NOT NULL, UNIQUE INDEX UNIQ_34184D273A909126 (nombre), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', username VARCHAR(180) NOT NULL, nombre VARCHAR(180) NOT NULL, apellidos VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A6287F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id)');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A62A9276E6C FOREIGN KEY (tipo_id) REFERENCES tipo_cita (id)');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A629F5A440B FOREIGN KEY (estado_id) REFERENCES estado_cita (id)');
        $this->addSql('ALTER TABLE cita ADD CONSTRAINT FK_3E379A627310DAD4 FOREIGN KEY (paciente_id) REFERENCES paciente (id)');
        $this->addSql('ALTER TABLE doctor ADD CONSTRAINT FK_1FC0F36AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE doctor ADD CONSTRAINT FK_1FC0F36A16A490EC FOREIGN KEY (especialidad_id) REFERENCES especialidad (id)');
        $this->addSql('ALTER TABLE doctor ADD CONSTRAINT FK_1FC0F36A79798A31 FOREIGN KEY (consultorio_id) REFERENCES consultorio (id)');
        $this->addSql('ALTER TABLE doctor ADD CONSTRAINT FK_1FC0F36A584CC12E FOREIGN KEY (secretaria_id) REFERENCES secretaria (id)');
        $this->addSql('ALTER TABLE secretaria ADD CONSTRAINT FK_C39D81C2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE doctor DROP FOREIGN KEY FK_1FC0F36A79798A31');
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A6287F4FB17');
        $this->addSql('ALTER TABLE doctor DROP FOREIGN KEY FK_1FC0F36A16A490EC');
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A629F5A440B');
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A627310DAD4');
        $this->addSql('ALTER TABLE doctor DROP FOREIGN KEY FK_1FC0F36A584CC12E');
        $this->addSql('ALTER TABLE cita DROP FOREIGN KEY FK_3E379A62A9276E6C');
        $this->addSql('ALTER TABLE doctor DROP FOREIGN KEY FK_1FC0F36AA76ED395');
        $this->addSql('ALTER TABLE secretaria DROP FOREIGN KEY FK_C39D81C2A76ED395');
        $this->addSql('DROP TABLE cita');
        $this->addSql('DROP TABLE consultorio');
        $this->addSql('DROP TABLE doctor');
        $this->addSql('DROP TABLE especialidad');
        $this->addSql('DROP TABLE estado_cita');
        $this->addSql('DROP TABLE paciente');
        $this->addSql('DROP TABLE secretaria');
        $this->addSql('DROP TABLE tipo_cita');
        $this->addSql('DROP TABLE user');
    }
}
