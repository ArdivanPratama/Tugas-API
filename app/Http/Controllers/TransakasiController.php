<?php

namespace App\Http\Controllers;

use App\Models\Transakasi;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransakasiController extends Controller
{

    public function index()
    {
        $transaksi = Transakasi::all();
        $response = [
            'pesan' => 'Data Transaksi',
            'data' => $transaksi
        ];
        return response()->json($response, 200);
    }





    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_transaksi' => 'required',
            'nama_user' => 'required',
            'id_user' => 'required',
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
            'ukuran' => 'required',
            'no_telpon_user' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $transaksi = Transakasi::create($request->all());
            $response = [
                'pesan' => "Transaksi Barang Ditambahkan",
                'data' => $transaksi,
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
        $transaksi = Transakasi::findOrFail($id);
        $response = [
            'pesan' => ' id ' . $id,
            'data' => $transaksi
        ];
        return response()->json($response, 200);
    }





    public function update(Request $request, $id)
    {
        $transaksi = Transakasi::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama_transaksi' => 'required',
            'nama_user' => 'required',
            'id_user' => 'required',
            'nama_barang' => 'required',
            'jenis_barang' => 'required',
            'ukuran' => 'required',
            'no_telpon_user' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $transaksi->update($request->all());
            $response = [
                'pesan' => "Transaksi Barang diperbarui",
                'data' => $transaksi,
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
        $transaksi = Transakasi::findOrFail($id);
        try {
            $transaksi->delete();
            $response = [
                'pesan' => "Transaksi Barang Dihapus",
            ];
            return response()->json($response, 200);
        } catch (QueryException $e) {
            return response()->json([
                'pesan' => "Failed " . $e->errorInfo,
            ]);
        }
    }
}
