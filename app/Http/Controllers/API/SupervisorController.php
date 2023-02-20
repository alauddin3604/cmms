<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiController;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SupervisorController extends ApiController
{
    public function index()
    {
        $supervisors = Supervisor::all();

        return $this->successResponse('Supervisors retrieved successfully', $supervisors);
    }

    public function store(Request $request)
    {
        $validator = $this->validateInput();

        if ($validator->fails()) {
            return $this->errorResponse('Validation error.', $validator->messages(), 400);
        }

        $supervisor = Supervisor::create([
            'name' => $request->name,
            'ic_number' => $request->ic_number,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'password' => Hash::make($request->ic_number)
        ]);

        return $this->successResponse('Supervisor is created successfully.', $supervisor, 201);
    }

    public function show($id)
    {
        if ($supervisor = Supervisor::find($id)) {
            return $this->successResponse('Supervisor is retrieved successfully.', $supervisor);
        } else {
            return $this->errorResponse('Supervisor not found.', null, 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = $this->validateInput();

        if ($validator->fails()) {
            return $this->errorResponse('Validation error.', $validator->messages(), 400);
        }

        $supervisor = Supervisor::find($id);
        $supervisor->update($request->all());

        return response()->json('Data updated');
    }

    public function destroy(Supervisor $supervisor)
    {
        $supervisor->delete();

        return $this->successResponse('Supervisor has been deleted successfully.', $supervisor);
    }

    public function massDestroy($supervisors)
    {
        $supervisorsArray = explode(',', $supervisors);

        foreach ($supervisorsArray as $supervisorId) {
            if (Supervisor::has('workOrders')->find($supervisorId))
                return response()->json('exists');
        }

        Supervisor::whereKey($supervisorsArray)->delete();
        return response()->noContent();
    }

    public function validateInput()
    {
        return Validator::make(request()->all(), [
            'name' => ['required', 'max:255'],
            'ic_number' => ['required', 'numeric', 'unique:supervisors'],
            'email' => ['required', 'email', 'unique:supervisors'],
            'phone_number' => ['required', 'numeric'],
            'address' => ['nullable', 'max:255'],
        ]);
    }
}
