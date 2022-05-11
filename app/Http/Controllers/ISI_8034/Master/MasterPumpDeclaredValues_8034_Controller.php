<?php

namespace App\Http\Controllers\ISI_8034\Master;

use App\Http\Controllers\Controller;
use App\Models\ISI_8034\Master\isi_8034_MasterPumpTypes;
use Exception;
use Illuminate\Http\Request;

class MasterPumpDeclaredValues_8034_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $pumpType = null)
    {
        try {
            if ($pumpType) {
                $allPumps = isi_8034_MasterPumpTypes::where('fldptype', '=', $pumpType)->get();
                $allPumpsDD = isi_8034_MasterPumpTypes::pluck('fldptype');
                return view('8034.master.pumpDeclaredValues', compact('allPumps', 'allPumpsDD'));
            }

            $allPumps = isi_8034_MasterPumpTypes::all();
            $allPumpsDD = isi_8034_MasterPumpTypes::pluck('fldptype');
            return view('8034.master.pumpDeclaredValues', compact('allPumps', 'allPumpsDD'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error! ' . $ex->__toString());
        }
    }

    public function entry(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {

                if (str_contains($request->input('pumpType'), '/')) return redirect()->back()->with('status', 'Invalid Pump Type Format!');

                if ($request->input('id')) {
                    $pump_type = isi_8034_MasterPumpTypes::findOrFail($request->id);
                    $msg = 'Pump Values Updated Successfully!';
                } else {
                    $pump_type = new isi_8034_MasterPumpTypes();
                    $msg = 'Pump type added successfully!';
                    $pump_type->fldsno = $request->serialNo;
                    $pump_type->fldptype = $request->pumpType;
                }

                $pump_type->fldhp = $request->hp;
                $pump_type->fldkw = $request->kw;
                $pump_type->fldphase = $request->phase;
                $pump_type->flddsize = $request->deliverySize;
                $pump_type->fldthead = $request->totalHead;
                $pump_type->fldoeff = $request->oeff;
                $pump_type->flddis = $request->discharge;
                $pump_type->fldmcurr = $request->maxCurr;
                $pump_type->fldvolt = $request->voltage;
                $pump_type->fldstage = $request->stage;
                $pump_type->fldheadr1 = $request->headRange1;
                $pump_type->fldheadr2 = $request->headRange2;
                $pump_type->fldfreq = $request->frequency;
                $pump_type->fldtol = $request->efficiencyCalc;
                $pump_type->fldbdia = $request->bsize;
                $pump_type->fldsub = $request->sub;
                $pump_type->fldmtype = $request->motorType;
                $pump_type->flddia = $request->pumpDia;
                $pump_type->fldcat = $request->catg;
                $pump_type->save();
                return redirect()->route('8034_masterPumpDeclaredValues')->with('status', $msg);
            } else return redirect()->back()->with('status', 'Invalid request!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }
}