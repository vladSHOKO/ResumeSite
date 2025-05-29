<?php

namespace App\Repository;

use App\DTO\MailDTO;
use App\Entity\Letter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Letter>
 */
class LetterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Letter::class);
    }

    public function saveLetter(MailDTO $formDTO): void
    {
        $letter = new Letter($formDTO->senderName, $formDTO->email, $formDTO->subject, $formDTO->message);
        $this->getEntityManager()->persist($letter);
        $this->getEntityManager()->flush();
    }
}
