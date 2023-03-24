<?php

namespace nrk63;

use Exception;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\Validation;

class User
{
    /**
     * @throws Exception if validation in not passed
     */
    public function __construct(int $id, string $name, string $email, string $password)
    {
        $validator = Validation::createValidator();
        $violations = $validator->validate($id, [ new Constraints\PositiveOrZero() ]);
        $violations->addAll($validator->validate($name, [ new Constraints\NotBlank(), new Constraints\Length(min: 3) ]));
        $violations->addAll($validator->validate($email, [ new Constraints\Email() ]));
        $violations->addAll($validator->validate($password, [ new Constraints\NotCompromisedPassword() ]));

        if (count($violations) > 0) {
            throw new Exception((string) $violations);
        }

        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->creationDate = date("Y-m-d h:i:sa");
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private string $creationDate;
}
