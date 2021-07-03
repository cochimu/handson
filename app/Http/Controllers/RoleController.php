<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('roles.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();
        if ($user->role->id !== 1) {
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->route('roles.create')
                ->withErrors($validator)
                ->withInput();
        }

        $role = new Role();
        $role->fill(
            $request->all()
        )->save();

        return redirect()->route('roles.show', compact('role'));
    }

    /**
     * @param Role $role
     * @return View
     */
    public function show(Role $role): View
    {
        return view('roles.show', compact('role'));
    }

    /**
     * @param Role $role
     * @return View
     */
    public function edit(Role $role): View
    {
        return view('roles.edit', compact('role'));
    }

    /**
     * @param Request $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();
        if ($user->role->id !== 1) {
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string'
        ]);
        if ($validator->fails()) {
            return redirect()
                ->route('roles.create')
                ->withErrors($validator)
                ->withInput();
        }

        $role->fill(
            $request->all()
        )->save();

        return redirect()->route('roles.show', compact('role'));
    }

    /**
     * @param Role $role
     * @return RedirectResponse
     */
    public function destroy(Role $role): RedirectResponse
    {
        $role->delete();
        return redirect()->route('roles.index');
    }
}
