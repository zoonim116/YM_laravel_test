<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Services\CompanyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends \Illuminate\Routing\Controller
{

    protected CompanyService $companyService;
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
        $this->middleware('auth:api');
    }

    public function index(): JsonResponse
    {
        try {
            $result = $this->companyService->all();
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage(),
            ], $exception->getCode());
        }

        return response()->json([
            'data' => $result,
        ]);
    }

    public function store(CompanyRequest $request): JsonResponse
    {
        try {
            $result = $this->companyService->save($request->all());
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage(),
            ], 500);
        }

        return response()->json([
            'data' => $result,
        ]);
    }
}
