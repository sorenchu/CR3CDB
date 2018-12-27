<?php

namespace DatabaseBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PlayerDataRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PlayerDataRepository extends EntityRepository
{
    public function getCategory($id, $season)
    {
       $query = $this->createQueryBuilder('players')
                ->join('players.personalData', 'person')
                ->join('players.season', 'season')
                ->where('person.id = :id')
                ->andWhere('season.id = :seasonId')
                ->setParameter('id', $id)
                ->setParameter('seasonId', $season)
                ->getQuery();
        return $query->getOneOrNullResult();
    }
}
