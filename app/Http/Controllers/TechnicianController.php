<?php

namespace App\Http\Controllers;

use App\Http\Resources\TechnicianResource;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TechnicianController extends Controller
{
    public function index()
    {
        $technicians = Technician::all();
        return TechnicianResource::collection($technicians);
    }

    public function add(Request $request)
    {
        $supervisor = Technician::where('ic_number', $request->ic_number)->orWhere('email', $request->email)->orWhere('phone_number', $request->phone_number);

        if ($supervisor->exists()) {
            return response()->json('exists');
        } else {
            Technician::create([
                'name' => $request->name,
                'ic_number' => $request->ic_number,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'password' => Hash::make($request->ic_number)
            ]);
        }
    }

    public function edit($id)
    {
        $technician = Technician::find($id);

        return response()->json($technician);
    }

    public function update(Request $request, $id)
    {
        $technician = Technician::find($id);
        
        $technician->update($request->all());

        return response()->json('Data updated');
    }

    public function multiDelete($technicians)
    {
        $techniciansArray = explode(',', $technicians);

        foreach ($techniciansArray as $technicianId) {
            if (Technician::has('workOrders')->find($technicianId))
                return response()->json('exists');
        }

        Technician::whereKey($techniciansArray)->delete();
        return response()->noContent();
    }
}
