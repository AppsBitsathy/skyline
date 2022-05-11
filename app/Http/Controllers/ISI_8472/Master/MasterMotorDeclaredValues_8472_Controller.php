<?php

namespace App\Http\Controllers\ISI_8472\Master;

use App\Http\Controllers\Controller;
use App\Models\ISI_8472\Master\isi_8472_MasterMotorType;
use Exception;
use Illuminate\Http\Request;

class MasterMotorDeclaredValues_8472_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $motorType = null)
    {
        try {
            if ($motorType) {
                $allMotors = isi_8472_MasterMotorType::where('fldmtype', '=', $motorType)->get();
                $allMotorsDD = isi_8472_MasterMotorType::pluck('fldmtype');
                return view('8472.master.motorDeclaredValues', compact('allMotors', 'allMotorsDD'));
            }

            $allMotors = isi_8472_MasterMotorType::all();
            $allMotorsDD = isi_8472_MasterMotorType::pluck('fldmtype');
            return view('8472.master.motorDeclaredValues', compact('allMotors', 'allMotorsDD'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->isMethod('POST') && $request->input('_token')) {

                $motorType = new isi_8472_MasterMotorType();
                $motorType->fldsno = $request->input('serialNo');
                $motorType->fldmtype = $request->input('motorType');
                $motorType->fldvoltage = $request->input('ratedVoltage');
                $motorType->flddradius = $request->input('drumRadius');
                $motorType->fldbthickness = $request->input('beltThickness');
                $motorType->fldpower = $request->input('power');
                $motorType->fldspeed = $request->input('ratedFullLoadSpeed');
                $motorType->fldarmlength = $request->input('lengthOfArm');
                $motorType->save();
                return redirect()->route('8472_masterMotorDeclaredValues')->with('status', 'Motor type added successfully!');
            } else return redirect()->back()->with('status', 'Invalid request!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function update(Request $request)
    {
        try {
            if ($request->isMethod('POST') && $request->input('_token')) {
                $motorType = isi_8472_MasterMotorType::findOrFail($request->input('id'));

                $motorType->fldvoltage = $request->input('ratedVoltage');
                $motorType->flddradius = $request->input('drumRadius');
                $motorType->fldbthickness = $request->input('beltThickness');
                $motorType->fldpower = $request->input('power');
                $motorType->fldspeed = $request->input('ratedFullLoadSpeed');
                $motorType->fldarmlength = $request->input('lengthOfArm');

                $motorType->save();

                return redirect()->route('8472_masterMotorDeclaredValues')->with('status', 'Motor values updated successfully!');
            } else return redirect()->back()->with('status', 'Invalid request!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }
}