<?php

namespace App\Http\Controllers\Branch;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class SearchBranchController extends Controller
{
    public function __invoke(Request $request): View|JsonResponse
    {
        $request->validate([
            'branch_id' => ['sometimes', 'integer', 'min:0'],
            'search' => ['sometimes', 'string']
        ]);

        if ($branchId = $request->input('branch_id')) {
            return new JsonResponse(Branch::query()->find($branchId));
        }

        $searchTerm = $request->input('search');

        $branches = Branch::query()
            ->where('id', $searchTerm)
            ->orWhere('name', 'like', "%{$searchTerm}%")
            ->orWhere('address', 'like', "%{$searchTerm}%")
            ->orWhere('phone', 'like', "%{$searchTerm}%")
            ->get();

        return view('bewama::pages.dashboard.branch.result', compact('branches'));
    }
}
