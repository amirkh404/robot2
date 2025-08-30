<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Point\PointServiceInterface;
use App\Models\User;
use App\Http\Requests\Admin\StoreManualPointRequest;

class PointController extends Controller
{
    public function __construct(protected PointServiceInterface $pointService) {}

    public function index()
    {
        $users = User::where('role', 'user')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function addPoints(StoreManualPointRequest $request, User $user)
    {
        $this->pointService->addManualPoints(
        $user,
        $request->validated()['points'],
        $request->validated()['description'] ?? null
        );

        return redirect()->back()->with('success', 'امتیاز با موفقیت افزوده شد.');
    }
    
}
