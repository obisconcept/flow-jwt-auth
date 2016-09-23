<?php
namespace TYPO3\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs! This block will be used as the migration description if getDescription() is not used.
 */
class Version20160923122323 extends AbstractMigration {

    /**
     * @return string
     */
    public function getDescription() {

        return '';

    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function up(Schema $schema) {

        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');
        
        $this->addSql('CREATE TABLE obisconcept_flowjwtauth_domain_model_jsonwebtoken (persistence_object_identifier VARCHAR(40) NOT NULL, account VARCHAR(40) DEFAULT NULL, jwt VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_C0DF70EC7D3656A4 (account), PRIMARY KEY(persistence_object_identifier)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE obisconcept_flowjwtauth_domain_model_jsonwebtoken ADD CONSTRAINT FK_C0DF70EC7D3656A4 FOREIGN KEY (account) REFERENCES typo3_flow_security_account (persistence_object_identifier)');

    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function down(Schema $schema) {

        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on "mysql".');
        
        $this->addSql('DROP TABLE obisconcept_flowjwtauth_domain_model_jsonwebtoken');

    }

}