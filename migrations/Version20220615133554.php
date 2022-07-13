<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615133554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comments_actu (id INT AUTO_INCREMENT NOT NULL, actu_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, email VARCHAR(150) NOT NULL, avis LONGTEXT NOT NULL, etat TINYINT(1) NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7A22EE5F77EEF58 (actu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comments_blog (id INT AUTO_INCREMENT NOT NULL, blog_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, email VARCHAR(150) NOT NULL, avis LONGTEXT NOT NULL, etat TINYINT(1) NOT NULL, date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_44C47CE4DAE07E97 (blog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE faq (id INT AUTO_INCREMENT NOT NULL, parent_id INT NOT NULL, question VARCHAR(255) NOT NULL, reponse LONGTEXT NOT NULL, INDEX IDX_E8FF75CC727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, actualites_id INT DEFAULT NULL, blog_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_E01FBE6A2EDF1993 (actualites_id), INDEX IDX_E01FBE6ADAE07E97 (blog_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comments_actu ADD CONSTRAINT FK_7A22EE5F77EEF58 FOREIGN KEY (actu_id) REFERENCES actualites (id)');
        $this->addSql('ALTER TABLE comments_blog ADD CONSTRAINT FK_44C47CE4DAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)');
        $this->addSql('ALTER TABLE faq ADD CONSTRAINT FK_E8FF75CC727ACA70 FOREIGN KEY (parent_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A2EDF1993 FOREIGN KEY (actualites_id) REFERENCES actualites (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6ADAE07E97 FOREIGN KEY (blog_id) REFERENCES blog (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE comments_actu');
        $this->addSql('DROP TABLE comments_blog');
        $this->addSql('DROP TABLE faq');
        $this->addSql('DROP TABLE images');
    }
}
