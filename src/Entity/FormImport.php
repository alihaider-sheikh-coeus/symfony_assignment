<?php

namespace App\Entity;

use App\Repository\FormImportRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormImportRepository::class)
 */
class FormImport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $completion_rate;

    /**
     * @ORM\Column(type="integer")
     */
    private $open_rate;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_default;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_default_form_of_default_survey;

    /**
     * @ORM\Column(type="integer")
     */
    private $account_id;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $downloaded_at;

    /**
     * @ORM\Column(type="integer")
     */
    private $form_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCompletionRate(): ?int
    {
        return $this->completion_rate;
    }

    public function setCompletionRate(int $completion_rate): self
    {
        $this->completion_rate = $completion_rate;

        return $this;
    }

    public function getOpenRate(): ?int
    {
        return $this->open_rate;
    }

    public function setOpenRate(int $open_rate): self
    {
        $this->open_rate = $open_rate;

        return $this;
    }

    public function getIsDefault(): ?bool
    {
        return $this->is_default;
    }

    public function setIsDefault(bool $is_default): self
    {
        $this->is_default = $is_default;

        return $this;
    }

    public function getIsDefaultFormOfDefaultSurvey(): ?bool
    {
        return $this->is_default_form_of_default_survey;
    }

    public function setIsDefaultFormOfDefaultSurvey(bool $is_default_form_of_default_survey): self
    {
        $this->is_default_form_of_default_survey = $is_default_form_of_default_survey;

        return $this;
    }

    public function getAccountId(): ?int
    {
        return $this->account_id;
    }

    public function setAccountId(int $account_id): self
    {
        $this->account_id = $account_id;

        return $this;
    }

    public function getDownloadedAt(): ?\DateTimeImmutable
    {
        return $this->downloaded_at;
    }

    public function setDownloadedAt(\DateTimeImmutable $downloaded_at): self
    {
        $this->downloaded_at = $downloaded_at;

        return $this;
    }

    public function getFormId(): ?int
    {
        return $this->form_id;
    }

    public function setFormId(int $form_id): self
    {
        $this->form_id = $form_id;

        return $this;
    }
}
