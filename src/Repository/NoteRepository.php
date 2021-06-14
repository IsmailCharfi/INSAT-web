<?php

namespace App\Repository;

use App\Entity\Note;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Note|null find($id, $lockMode = null, $lockVersion = null)
 * @method Note|null findOneBy(array $criteria, array $orderBy = null)
 * @method Note[]    findAll()
 * @method Note[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Note::class);
    }

    public function findByMatiere($matiere, $anneeScolaire){
        return $this->findBy(['matiere'=>$matiere, 'anneScolaire'=>$anneeScolaire]);
    }

    public function findByEtudiant($etudiant, $anneeScolaire, $semestre){
        /*return $this->findBy(['etudiant'=>$etudiant,
            'anneScolaire'=>$anneeScolaire,
            //'matiere[semestre]' =>$semestre,

        ]);*/

        $query = $this->createQueryBuilder('n')
            ->leftJoin('n.etudiant', 'e')
            ->leftJoin('n.matiere','m')
            ->where('m.semestre = ?1 and e.id = ?2 and n.anneScolaire = ?3 ')
            ->setParameter(1, $semestre)
            ->setParameter(2, $etudiant)
            ->setParameter(3, $anneeScolaire);
        dd($query->getQuery()->getResult());
    }

        // /**
    //  * @return Note[] Returns an array of Note objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Note
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
