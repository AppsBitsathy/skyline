<?php

namespace App\Http\Controllers\ISI_12225;

use App\Http\Controllers\Controller;
use App\Models\isi_12225_MasterMotorType;
use Exception;
use Illuminate\Http\Request;

class MasterMotorDeclaredValues_12225_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $motorType = null)
    {
        try {
            if ($motorType) {
                $allMotors = isi_12225_MasterMotorType::where('fldmtype', '=', $motorType)->get();
                $allMotorsDD = isi_12225_MasterMotorType::pluck('fldmtype');
                return view('12225.master.motorDeclaredValues', compact('allMotors', 'allMotorsDD'));
            }

            $allMotors = isi_12225_MasterMotorType::all();
            $allMotorsDD = isi_12225_MasterMotorType::pluck('fldmtype');
            return view('12225.master.motorDeclaredValues', compact('allMotors', 'allMotorsDD'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function store(Request $request)
    {
        try {
            if ($request->isMethod('POST')) {
                if ($request->input('_token')) {
                    $motorType = new isi_12225_MasterMotorType();
                    $motorType->fldmtype = $request->input('motorType');
                    $motorType->fldvoltage = $request->input('ratedVoltage');
                    $motorType->fldhp = $request->input('hp');
                    $motorType->fldpower = $request->input('power');
                    $motorType->fldspeed = $request->input('ratedFullLoadSpeed');
                    $motorType->fldarmlength = $request->input('lengthOfArm');
                    $motorType->save();
                    return redirect()->back()->with('status', 'Motor type added successfully!');
                } else return redirect()->back()->with('status', 'Invalid token!');
            } else return redirect()->back()->with('status', 'Invalid request!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function update(Request $request)
    {
        try {
            if ($request->isMethod('POST')) {
                if ($request->input('_token')) {
                    $motor = isi_12225_MasterMotorType::findOrFail($request->input('id'));

                    $extract = $request->all();

                    $motor->fldmtype = $extract['motorType'];
                    $motor->fldvoltage = $extract['ratedVoltage'];
                    $motor->fldhp = $extract['hp'];
                    $motor->fldpower = $extract['power'];
                    $motor->fldspeed = $extract['ratedFullLoadSpeed'];
                    $motor->fldarmlength = $extract['lengthOfArm'];

                    $motor->save();

                    return redirect()->back()->with('status', 'Motor values updated successfully!');
                } else return redirect()->back()->with('status', 'Invalid token!');
            } else return redirect()->back()->with('status', 'Invalid request!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }
}