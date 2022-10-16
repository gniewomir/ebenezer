<?php

declare(strict_types=1);

namespace Enraged\Ebenezer\Domain;

use DateTimeInterface;
use Symfony\Component\Uid\UuidV4;

class Asset
{
    private ?DateTimeInterface $updated_at = null;
    private ?DateTimeInterface $deleted_at = null;

    public function __construct(
        private readonly UuidV4 $id,
        private readonly DateTimeInterface $created_at,
    ) {
    }

    public function getId(): UuidV4
    {
        return $this->id;
    }

    public function getCreatedAt(): DateTimeInterface
    {
        return $this->created_at;
    }
}
