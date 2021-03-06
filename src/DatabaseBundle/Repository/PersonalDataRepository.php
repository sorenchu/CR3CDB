<?php

namespace DatabaseBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PersonalDataRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PersonalDataRepository extends EntityRepository
{
    public function savePerson($personalData, $edit)
    {
        $em = $this->getEntityManager();
        if ($edit)
            $em->merge($personalData);
        $em->persist($personalData);
        $em->flush();
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
