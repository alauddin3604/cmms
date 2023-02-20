<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiController;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AssetController extends ApiController
{
    public function index()
    {
        $assets = Asset::all();

        return $this->successResponse('Assets retrieved successfully', $assets);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'barcode'     => 'required|digits_between:3,9',
            'name'        => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse('Validation error.', $validator->errors(), 400);
        }

        $asset = Asset::firstOrNew(
            ['barcode' => $request->input('barcode')],
            ['name' => $request->input('name'), 'description' => $request->input('description')]
        );

        if ($asset->exists) {
            return $this->errorResponse('Barcode already exists.', $asset, 400);
        } else {
            $asset->save();

            return $this->successResponse('Asset is added successfully.', $asset, 201);
        }
    }

    public function show($id)
    {
        if ($asset = Asset::find($id)) {
            return response()->json([
                'success' => true,
                'message' => 'Asset retrieved successfully',
                'data' => $asset
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Asset is not found',
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $asset = Asset::find($id);

        if (!$asset) {
            return $this->errorResponse('Asset is not found', null, 404);
        }
        
        $barcode = $request->barcode;

        $existingAsset = Asset::where('barcode', $barcode)->except($id)->get();

        if ($existingAsset) {
            return $this->errorResponse('Barcode already exists', $existingAsset, 400);
        }

        $asset->update($request->all());

        return $this->successResponse('Asset has been updated successfully.', $asset);
    }

    public function destroy($id)
    {
        if (Asset::has('workOrders')->find($id)) {
            return $this->errorResponse('The asset exists in work order and cannot be deleted', null, 400);
        } else {
            $asset = Asset::find($id);

            if ($asset->delete())
                return $this->successResponse('Asset has been deleted successfully.', $asset);
            else
                return $this->errorResponse('Error on deleting asset', null, 400);
        }
    }

    public function multiDelete($assets)
    {
        return $assets;
        $assetsArray = explode(',', $assets);

        foreach ($assetsArray as $assetId) {
            if (Asset::has('workOrders')->find($assetId))
                return response()->json('exists');
        }
        Asset::whereKey($assetsArray)->delete();
        return response()->noContent();
    }
}
