<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180626074221 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bookcopy ADD comments_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bookcopy ADD CONSTRAINT FK_519E74D063379586 FOREIGN KEY (comments_id) REFERENCES comment (id)');
        $this->addSql('CREATE INDEX IDX_519E74D063379586 ON bookcopy (comments_id)');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C3B550FE4');
        $this->addSql('DROP INDEX IDX_9474526C3B550FE4 ON comment');
        $this->addSql('ALTER TABLE comment DROP book_copy_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE bookCopy DROP FOREIGN KEY FK_519E74D063379586');
        $this->addSql('DROP INDEX IDX_519E74D063379586 ON bookCopy');
        $this->addSql('ALTER TABLE bookCopy DROP comments_id');
        $this->addSql('ALTER TABLE comment ADD book_copy_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C3B550FE4 FOREIGN KEY (book_copy_id) REFERENCES bookcopy (id)');
        $this->addSql('CREATE INDEX IDX_9474526C3B550FE4 ON comment (book_copy_id)');
    }
}
