<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{

    public function index()
    {
        $booking = Booking::all();
        $response = [
            'pesan' => 'data booking',
            'data' => $booking
        ];
        return response()->json($response, 200);
    }





    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'jenis_barang_id' => 'required',
            'ukuran' => 'required',
            'harga' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $booking = Booking::create($request->all());
            $response = [
                'pesan' => "Booking Barang Ditambahkan",
                'data' => $booking,
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
        $booking = Booking::findOrFail($id);
        $response = [
            'pesan' => ' id ' . $id,
            'data' => $booking
        ];
        return response()->json($response, 200);
    }





    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'jenis_barang_id' => 'required',
            'ukuran' => 'required',
            'harga' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $booking->update($request->all());
            $response = [
                'pesan' => "Booking Barang diperbarui",
                'data' => $booking,
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
        $booking = Booking::findOrFail($id);
        try {
            $booking->delete();
            $response = [
                'pesan' => "Booking Barang Dihapus",
            ];
            return response()->json($response, 200);
        } catch (QueryException $e) {
            return response()->json([
                'pesan' => "Failed " . $e->errorInfo,
            ]);
        }
    }
}
