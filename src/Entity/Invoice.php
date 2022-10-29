<?php

namespace App\Entity;

use App\Repository\InvoiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InvoiceRepository::class)]
class Invoice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @var InvoiceSubjectInterface
     */
    #[ORM\ManyToOne(targetEntity: InvoiceSubjectInterface::class)]
    protected InvoiceSubjectInterface $subject;

    public function getSubject(): InvoiceSubjectInterface
    {
        return $this->subject;
    }

    public function setSubject(InvoiceSubjectInterface $subj): void
    {
        $this->subject = $subj;
    }
}
