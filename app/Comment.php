<?php

namespace nrk63;

use Exception;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Validation;

class Comment
{
    /**
     * @throws Exception if validation in not passed
     */
    public function __construct(User $user, string $text)
    {
        $validator = Validation::createValidator();
        $violations = $validator->validate($text, [ new Constraints\NotBlank() ]);

        if (count($violations) > 0) {
            throw new Exception((string) $violations);
        }

        $this->user = $user;
        $this->text = $text;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getText(): string
    {
        return $this->text;
    }

    private User $user;
    private string $text;
}