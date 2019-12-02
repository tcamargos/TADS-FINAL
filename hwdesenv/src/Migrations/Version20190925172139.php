<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190925172139 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE mensagem_medico (id INT AUTO_INCREMENT NOT NULL, empresa_id INT NOT NULL, texto LONGTEXT NOT NULL, status TINYINT(1) NOT NULL, INDEX IDX_699DDE67521E1991 (empresa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mensagem_empresa (id INT AUTO_INCREMENT NOT NULL, empresa_id INT NOT NULL, texto LONGTEXT NOT NULL, status TINYINT(1) NOT NULL, INDEX IDX_1436DB5F521E1991 (empresa_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_empresa (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, nome VARCHAR(255) NOT NULL, cnpj VARCHAR(14) NOT NULL, endereco VARCHAR(255) NOT NULL, servico VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E0DA445ADB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL, senha VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_medico (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, nome VARCHAR(255) NOT NULL, crm VARCHAR(25) NOT NULL, endereco VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_51B78A71DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_pessoa (id INT AUTO_INCREMENT NOT NULL, usuario_id INT NOT NULL, nome VARCHAR(255) NOT NULL, cpf VARCHAR(11) NOT NULL, UNIQUE INDEX UNIQ_798DB0BFDB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mensagem_medico ADD CONSTRAINT FK_699DDE67521E1991 FOREIGN KEY (empresa_id) REFERENCES user_medico (id)');
        $this->addSql('ALTER TABLE mensagem_empresa ADD CONSTRAINT FK_1436DB5F521E1991 FOREIGN KEY (empresa_id) REFERENCES user_empresa (id)');
        $this->addSql('ALTER TABLE user_empresa ADD CONSTRAINT FK_E0DA445ADB38439E FOREIGN KEY (usuario_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_medico ADD CONSTRAINT FK_51B78A71DB38439E FOREIGN KEY (usuario_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_pessoa ADD CONSTRAINT FK_798DB0BFDB38439E FOREIGN KEY (usuario_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mensagem_empresa DROP FOREIGN KEY FK_1436DB5F521E1991');
        $this->addSql('ALTER TABLE user_empresa DROP FOREIGN KEY FK_E0DA445ADB38439E');
        $this->addSql('ALTER TABLE user_medico DROP FOREIGN KEY FK_51B78A71DB38439E');
        $this->addSql('ALTER TABLE user_pessoa DROP FOREIGN KEY FK_798DB0BFDB38439E');
        $this->addSql('ALTER TABLE mensagem_medico DROP FOREIGN KEY FK_699DDE67521E1991');
        $this->addSql('DROP TABLE mensagem_medico');
        $this->addSql('DROP TABLE mensagem_empresa');
        $this->addSql('DROP TABLE user_empresa');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_medico');
        $this->addSql('DROP TABLE user_pessoa');
    }
}
