<?php

namespace App\Data;

use Spatie\LaravelData\Attributes\Validation\Email;
use Spatie\LaravelData\Data;

// DTO
class ProcessSubmissionData extends Data
{
    public function __construct(
        public string $name,
        #[Email(Email::RfcValidation)]
        public string $email,
        public string $message
    ) {}
}
