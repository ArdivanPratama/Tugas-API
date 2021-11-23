<?php

namespace App\Http\Controllers;

use App\Models\JenisBarang;
use Database\Seeders\jenis_barang_seeder;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JenisController extends Controller
{

    public function index()
    {
        $jenis = JenisBarang::all();
        $response = [
            'pesan' => 'data jenis barang',
            'data' => $jenis
        ];
        return response()->json($response, 200);
    }





    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama_jenis_barang' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $jenis = JenisBarang::create($request->all());
            $response = [
                'pesan' => "Jenis Barang Ditambahkan",
                'data' => $jenis,
            ];

            return response()->json($response, 200);
        } catch (QueryException $e) {
            return response()->json([
                'pesan' => "Failed " . $e->errorInfo,
            ]);
        }
    }


    public function show($id)
    {
        $jenis = JenisBarang::findOrFail($id);
        $response = [
            'pesan' => 'data jenis barang dengan id ' . $id,
            'data' => $jenis
        ];
        return response()->json($response, 200);
    }





    public function update(Request $request, $id)
    {
        $jenis = JenisBarang::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama_jenis_barang' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $jenis->update($request->all());
            $response = [
                'pesan' => "Jenis Barang diperbarui",
                'data' => $jenis,
            ];

            return response()->json($response, 200);
        } catch (QueryException $e) {
            return response()->json([
                'pesan' => "Failed " . $e->errorInfo,
            ]);
        }
    }


    public function destroy($id)
    {
        $jenis = JenisBarang::findOrFail($id);
        try {
            $jenis->delete();
            $response = [
                'pesan' => "Jenis Barang Dihapus",
            ];
            return response()->json($response, 200);
        } catch (QueryException $e) {
            return response()->json([
                'pesan' => "Failed " . $e->errorInfo,
            ]);
        }
    }
}
