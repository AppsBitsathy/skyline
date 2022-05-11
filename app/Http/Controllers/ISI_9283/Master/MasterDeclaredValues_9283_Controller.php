<?php

namespace App\Http\Controllers\ISI_9283\Master;

use App\Http\Controllers\Controller;
use App\Models\ISI_9283\Master\isi_9283_MasterDelaredValues;
use Exception;
use Illuminate\Http\Request;

class MasterDeclaredValues_9283_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $motorType = null)
    {
        try {
            if ($motorType) {
                $allMotors = isi_9283_MasterDelaredValues::where('fldmtype', '=', $motorType)->get();
                $allMotorsDD = isi_9283_MasterDelaredValues::pluck('fldmtype');
                return view('9283.master.declaredValues', compact('allMotors', 'allMotorsDD'));
            }

            $allMotors = isi_9283_MasterDelaredValues::all();
            $allMotorsDD = isi_9283_MasterDelaredValues::pluck('fldmtype');
            return view('9283.master.declaredValues', compact('allMotors', 'allMotorsDD'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error! ' . $ex->__toString());
        }
    }

    public function entry(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->_token) {

                if (str_contains($request->pumpType, '/')) {
                    return redirect()->back()->with('status', 'Invalid Pump Type Format!');
                }

                if ($request->phase != 'SINGLE' && $request->phase != 'THREE') return redirect()->back()->with('status', 'Invalid Phase');

                if ($request->id) {
                    $pump_type = isi_9283_MasterDelaredValues::findOrFail($request->id);
                    $msg = 'Declared values updated successfully!';
                } else {
                    $pump_type = new isi_9283_MasterDelaredValues();
                    $msg = 'Declared values added successfully!';
                    $pump_type->fldsno = $request->serialNo;
                    $pump_type->fldmtype = $request->motorType;
                }

                $pump_type->fldbore = $request->boreSize;
                $pump_type->fldhp = $request->hp;
                $pump_type->fldkw = $request->kw;
                $pump_type->fldphase = $request->phase;
                $pump_type->fldmeff = $request->minEff;
                $pump_type->fldfspeed = $request->minFullLoadSpeed;
                $pump_type->fldfcur = $request->minFullLoadCurr;
                $pump_type->fldstorque = $request->maxStartTorque;
                $pump_type->fldlcur = $request->maxLeakCurr;
                $pump_type->flddshaft = $request->diaShaft;
                $pump_type->fldext = $request->shaftExtRunout;
                $pump_type->fldsdia = $request->spigotDia;
                $pump_type->fldcon = $request->concentricity;
                $pump_type->fldodia = $request->outsideDia;
                $pump_type->fldper = $request->perpendicularity;

                $pump_type->save();

                return redirect()->route('9283_masterDeclaredValues')->with('status', $msg);
            } else return redirect()->back()->with('status', 'Invalid request!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }
}