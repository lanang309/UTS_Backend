<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;

class PatientController extends Controller
{
    # method index / get all reorce patient
    public function index(){
         # menggunakan model Patient untuk select data
         $patients = Patient::all();

         if ($patients) {
             $data = [
                 'message' => 'Get All Resource',
                 'data' => $patients,
             ];

             # json status code 200
             return response()->json($data, 200);
         } else {
             $data = [
                 'message' => 'Data is Empty',
             ];

             # json status code 200
             return response()->json($data, 200);
         }
    }

    # menambahkan resource Patient
        # membuat method store
        public function store(Request $request)
        {
            # membuat validasi
            $validatedData = $request->validate([
                # kolom => rules|rules
                'name' => 'required',
                'phone' => 'numeric|required',
                'address' => 'required',
                'status' => 'required',
                'in_date_at' => 'date|required',
                'out_date_at' => 'date|required',
            ]);
    
            # menggunakan Patient untuk insert data
            $patient = Patient::create($validatedData);
    
            $data = [
                'message' => 'Resource is Added Successfully',
                'data' => $patient,
            ];
    
            # (json) status code 201
            return response()->json($data, 201);
        }

     # mendapatkan detail resource Patient
        # method show
        public function show($id)
        {
            # mencari data Patient
            $patient = Patient::find($id);
    
            if ($patient) {
                $data = [
                    'message' => 'Get Detail Resource',
                    'data' => $patient,
                ];
    
                # json status code 200
                return response()->json($data, 200);
            } else {
                $data = [
                    'message' => 'Resource Not Found',
                ];
    
                # json status code 404
                return response()->json($data, 404);
            }
        }

    
        # update resource Patient
        # method update
        public function update(Request $request, $id)
        {
            # mencari data Patient yg ingin diupdate
            $patient = Patient::find($id);

            if ($patient) {
                # mendapatkan data request
                $input = [
                    'name' => $request->name ?? $patient->name,
                    'phone' => $request->phone ?? $patient->phone,
                    'address' => $request->address ?? $patient->address,
                    'status' => $request->status ?? $patient->status,
                    'in_date_at' => $request->in_date_at ?? $patient->in_date_at,
                    'out_date_at' => $request->out_date_at ?? $patient->out_date_at,
                ];

                # mengupdate data
                $patient->update($input);
    
                $data = [
                    'message' => 'Resource is Update Successfully',
                    'data' => $patient,
                ];

                # json dengan status code 200
                return response()->json($data, 200);
            } else {
                $data = [
                    'message' => 'Resource Not Found',
                ];

                # json status code 404
                return response()->json($data, 404);
            }
        }

     # menghapus resource Patient
        # method menghapus data
        public function destroy($id)
        {
            # cari data Patient yg ingin dihapus
            $patient = Patient::find($id);
    
            if ($patient) {
                # hapus data Patient
                $patient->delete();
    
                $data = [
                    'message' => 'Resource is Delete Successfully',
                ];
    
                # json status code 200
                return response()->json($data, 200);
            } else {
                $data = [
                    'message' => 'Resource Not Found',
                ];
    
                # json status code 404
                return response()->json($data, 404);
            }
        }

      # mencari data resource Patient
        # method mencari data
        public function search($name)
        {
            $patient = Patient::where("name","like","%".$name."%")->get();

            if (count($patient)) {
                $data = [
                    'message' => 'Get Searched Resource',
                    'data' => $patient,
                ];

                # json status code 200

                return response()->json($data, 200);
            } else {
                $data = [
                    'message' => 'Resource Not Found',
                ];

                # json status code 404
                return response()->json($data, 404);
            }
        }

        public function status($status)
        {
            $patients = Patient::where("status","like","%".$status."%")->get();
    
            $data = [
                'message' => 'Get all status resource',
                'data' => $patients,
            ];

            return response()->json($data, 200);
        }

        public function positive()
        {
            $patients = Patient::where("status","positive")->get();

            $data = [
                'message' => 'Get Positive Resource',
                'data' => $patients,
            ];

            return response()->json($data, 200);
        }

        public function recovered()
        {
            $patients = Patient::where("status","recovered")->get();

            $data = [
                'message' => 'Get Recovered Resource',
                'data' => $patients,
            ];

            return response()->json($data, 200);
        }

        public function dead()
        {
            $patients = Patient::where("status","dead")->get();

            $data = [
                'message' => 'Get Dead Resource',
                'data' => $patients,
            ];

            return response()->json($data, 200);
        }
}
