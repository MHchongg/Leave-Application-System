<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    public function create() {
        return Inertia::render('Leave/Create');
    }

    public function store(Request $request) {
        $validatedAttr = $request->validate([
            'type' => [Rule::in(['Sick Leave', 'Annual Leave', 'Maternity Leave', 'Unpaid Leave', 'Bereavement Leave', 'Others'])],
            'date' => ['date'],
            'reason' => [Rule::requiredIf($request->input('type') === 'Others')]
        ]);

        $validatedAttr['user_id'] = Auth::id();

        Leave::create($validatedAttr);

        return Inertia::location(route('user.home'));
    }

    public function show(Leave $leave) {
        $leave['applicant'] = $leave->user->email;
        $leave['can_delete'] = Auth::user()->can('delete_leave', $leave);

        return Inertia::render('Leave/Show', ['leave' => $leave]);
    }

    public function destroy(Leave $leave) {
        $leave->delete();
        return Inertia::location(route('user.home'));
    }

    public function approve(Leave $leave) {
        $leave->update(['status' => 'Approved']);
        return Inertia::location(route('leave.show', ['leave' => $leave]));
    }

    public function reject(Leave $leave) {
        $leave->update(['status' => 'Rejected']);
        return Inertia::location(route('leave.show', ['leave' => $leave]));
    }
}
