<?php

namespace \ObisConcept\FlowJwtAuth\Domain\Model;

use \TYPO3\Flow\Annotations as Flow;
use \Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class JsonWebToken {

    // @ToDo add JWT property and 1:1 relation to account entity

    /**
     * Get identifier
     *
     * @return string
     */
    public function getId() {

        return $this->Persistence_Object_Identifier;

    }

}