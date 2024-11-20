<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository
{
    protected Company $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }
}
