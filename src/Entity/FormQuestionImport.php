<?php

namespace App\Entity;

use App\Repository\FormQuestionImportRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormQuestionImportRepository::class)
 */
class FormQuestionImport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $question_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $question_label;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $question_type;

    /**
     * @ORM\Column(type="integer")
     */
    private $parent_id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_required;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="integer")
     */
    private $account_id;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $downloaded_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_conditional_question;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $min_range;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $max_range;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestionId(): ?int
    {
        return $this->question_id;
    }

    public function setQuestionId(int $question_id): self
    {
        $this->question_id = $question_id;

        return $this;
    }

    public function getQuestionLabel(): ?string
    {
        return $this->question_label;
    }

    public function setQuestionLabel(string $question_label): self
    {
        $this->question_label = $question_label;

        return $this;
    }

    public function getQuestionType(): ?string
    {
        return $this->question_type;
    }

    public function setQuestionType(string $question_type): self
    {
        $this->question_type = $question_type;

        return $this;
    }

    public function getParentId(): ?int
    {
        return $this->parent_id;
    }

    public function setParentId(int $parent_id): self
    {
        $this->parent_id = $parent_id;

        return $this;
    }

    public function getIsRequired(): ?bool
    {
        return $this->is_required;
    }

    public function setIsRequired(bool $is_required): self
    {
        $this->is_required = $is_required;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

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

    public function getIsConditionalQuestion(): ?bool
    {
        return $this->is_conditional_question;
    }

    public function setIsConditionalQuestion(bool $is_conditional_question): self
    {
        $this->is_conditional_question = $is_conditional_question;

        return $this;
    }

    public function getMinRange(): ?int
    {
        return $this->min_range;
    }

    public function setMinRange(?int $min_range): self
    {
        $this->min_range = $min_range;

        return $this;
    }

    public function getMaxRange(): ?int
    {
        return $this->max_range;
    }

    public function setMaxRange(?int $max_range): self
    {
        $this->max_range = $max_range;

        return $this;
    }
}
