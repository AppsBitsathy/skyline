<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MasterMotorType;
use Exception;
use Illuminate\Http\Request;

class MasterMotorDeclaredValuesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($motorType = null)
    {
        if ($motorType) {
            $allMotors = MasterMotorType::where('fldmtype', '=', $motorType)->get();
            $allMotorsDD = MasterMotorType::pluck('fldmtype');
            return view('master.motorDeclaredValues', compact('allMotors', 'allMotorsDD'));
        }

        $allMotors = MasterMotorType::all();
        $allMotorsDD = MasterMotorType::pluck('fldmtype');
        return view('master.motorDeclaredValues', compact('allMotors', 'allMotorsDD'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if ($request->isMethod('POST')) {
                $motorType = new MasterMotorType();
                $motorType->fldsno = $request->input('serialNo');
                $motorType->fldmtype = $request->input('motorType');
                $motorType->fldvoltage = $request->input('ratedVoltage');
                $motorType->flddradius = $request->input('drumRadius');
                $motorType->fldbthickness = $request->input('beltThickness');
                $motorType->fldpower = $request->input('power');
                $motorType->fldspeed = $request->input('ratedFullLoadSpeed');
                $motorType->fldarmlength = $request->input('lengthOfArm');
                $motorType->save();
                return redirect()->back()->with('status', 'Motor type added successfully!');
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $motor = MasterMotorType::findOrFail($request->input('id'));

        $extract = $request->all();

        $motor->fldsno = $extract['serialNo'];
        $motor->fldmtype = $extract['motorType'];
        $motor->flddradius = $extract['drumRadius'];
        $motor->fldbthickness = $extract['beltThickness'];
        $motor->fldvoltage = $extract['ratedVoltage'];
        $motor->fldpower = $extract['power'];
        $motor->fldspeed = $extract['ratedFullLoadSpeed'];
        $motor->fldarmlength = $extract['lengthOfArm'];

        $motor->save();

        return redirect()->back()->with('status', 'Motor values updated successfully!');
    }
}
