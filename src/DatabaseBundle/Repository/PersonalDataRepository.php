<?php

namespace DatabaseBundle\Repository;

use DatabaseBundle\Entity\PersonalData;
use Doctrine\ORM\EntityRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;

/**
 * PersonalDataRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PersonalDataRepository extends EntityRepository {

    public function savePerson(PersonalData $personalData, boolean $edit = null): int {
        $em = $this->getEntityManager();
        if ($edit)
            $em->merge($personalData);
        $em->persist($personalData);
        try {
            $em->flush();
        } catch (UniqueConstraintViolationException $e) {
            return \DatabaseBundle\Controller\People\AddPersonController::DUPLICATED_ENTRY;
        }
        return $personalData->getId();
    }

    public function getAll($currentPage = 1, $limit = 20)
    {
        $personalData = $this->createQueryBuilder('c')
                ->orderBy('c.surname', 'ASC');
        $paginator = \DatabaseBundle\Repository\PaginatorRepository::paginate($personalData, $currentPage, $limit);
        return array('paginator' => $paginator, 
                    'personalData' => $personalData);
    }
}
