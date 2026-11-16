<?php

namespace App\Http\Controllers;

use App\Models\Lecturers as Lecturer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class LecturerController extends Controller
{
    public function index()
    {
        $lecturers = Lecturer::with('user')
            ->withCount('courses')
            ->where('is_active', '1')
            ->get();

        return view('lecturers.index', compact('lecturers'));
    }

    public function create()
    {
        $users = User::whereDoesntHave('lecturer')
            ->orderBy('name')
            ->get();

        return view('lecturers.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:lecturers,user_id',
            'employee_number' => 'required|string|max:255|unique:lecturers,employee_number',
            'department' => 'required|string|max:255',
            'academic_rank' => 'required|string|max:255',
            'office_room' => 'required|string|max:255',
            'is_active' => 'required|in:0,1',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('lecturers', 'public');
        }

        Lecturer::create($validated);

        return redirect()->route('lecturers.index')
            ->with('success', 'Lecturer created successfully.');
    }

    public function show(string $id)
    {
        $lecturer = Lecturer::with(['user', 'courses'])->findOrFail($id);

        return view('lecturers.show', compact('lecturer'));
    }

    public function edit(string $id)
    {
        $lecturer = Lecturer::findOrFail($id);

        $users = User::whereDoesntHave('lecturer')
            ->orWhere('id', $lecturer->user_id)
            ->orderBy('name')
            ->get();

        return view('lecturers.edit', compact('lecturer', 'users'));
    }

    public function update(Request $request, string $id)
    {
        $lecturer = Lecturer::findOrFail($id);

        $validated = $request->validate([
            'user_id' => [
                'required',
                'exists:users,id',
                Rule::unique('lecturers', 'user_id')->ignore($lecturer->id),
            ],
            'employee_number' => [
                'required',
                'string',
                'max:255',
                Rule::unique('lecturers', 'employee_number')->ignore($lecturer->id),
            ],
            'department' => 'required|string|max:255',
            'academic_rank' => 'required|string|max:255',
            'office_room' => 'required|string|max:255',
            'is_active' => 'required|in:0,1',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $oldPhoto = $lecturer->photo;
            $validated['photo'] = $request->file('photo')->store('lecturers', 'public');

            $lecturer->update($validated);

            if ($oldPhoto) {
                Storage::disk('public')->delete($oldPhoto);
            }
        } else {
            unset($validated['photo']);
            $lecturer->update($validated);
        }

        return redirect()->route('lecturers.index')
            ->with('success', 'Lecturer updated successfully.');
    }

    public function destroy(string $id)
    {
        $lecturer = Lecturer::findOrFail($id);

        if ($lecturer->courses()->exists()) {
            return redirect()->route('lecturers.index')
                ->with('error', 'This lecturer has assigned courses and cannot be deleted.');
        }

        // Soft delete: يبقي سجل المحاضر وصورته محفوظين
        $lecturer->delete();

        return redirect()->route('lecturers.index')
            ->with('success', 'Lecturer deleted successfully.');
    }
}