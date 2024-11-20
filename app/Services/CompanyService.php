<?php

namespace App\Services;

use App\Models\Company;
use App\Repositories\CompanyRepository;

class CompanyService
{
    protected $companyRepository;

    public function __construct(CompanyRepository $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function save(array $data): Company {
        return Company::create($data);
    }

    public function all() :array {
        $result = Company::where('user_id', auth()->id())->get();
        if($result->isEmpty()){
            throw new \Exception('Data not found', 400);
        }
        return $result->toArray();
    }
}
