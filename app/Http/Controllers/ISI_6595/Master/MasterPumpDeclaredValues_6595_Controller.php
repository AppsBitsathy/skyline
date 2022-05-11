<?php

namespace App\Http\Controllers\ISI_6595\Master;

use App\Http\Controllers\Controller;
use App\Models\ISI_6595\Master\isi_6595_MasterPumpType;
use Exception;
use Illuminate\Http\Request;

class MasterPumpDeclaredValues_6595_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $pumpType = null)
    {
        try {
            if ($pumpType) {
                $allPumps = isi_6595_MasterPumpType::where('fldptype', '=', $pumpType)->get();
                $allPumpsDD = isi_6595_MasterPumpType::pluck('fldptype');
                return view('6595.master.pumpDeclaredValues', compact('allPumps', 'allPumpsDD'));
            }

            $allPumps = isi_6595_MasterPumpType::all();
            $allPumpsDD = isi_6595_MasterPumpType::pluck('fldptype');
            return view('6595.master.pumpDeclaredValues', compact('allPumps', 'allPumpsDD'));
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

                if ($request->id) {
                    $pump_type = isi_6595_MasterPumpType::findOrFail($request->id);
                    $msg = 'Pump Values Updated Successfully!';
                } else {
                    $pump_type = new isi_6595_MasterPumpType();
                    $msg = 'Pump type added successfully!';
                    $pump_type->fldsno = $request->serialNo;
                    $pump_type->fldptype = $request->pumpType;
                }

                $pump_type->fldhp = $request->hpkw;
                $pump_type->fldssize = $request->suctionSize;
                $pump_type->flddsize = $request->deliverySize;
                $pump_type->fldphase = $request->phase;
                $pump_type->fldvolt = $request->voltage;
                $pump_type->fldrtemp = $request->roomTemp;
                $pump_type->fldmcurr = $request->maxCurr;
                $pump_type->fldthead = $request->totalHead;
                $pump_type->flddis = $request->discharge;
                $pump_type->fldoeff = $request->eff;
                $pump_type->fldheadr1 = $request->headRange1;
                $pump_type->fldheadr2 = $request->headRange2;
                $pump_type->fldfreq = $request->frequency;
                $pump_type->fldtol = $request->efficiencyCalc;

                $pump_type->save();
                return redirect()->route('6595_masterPumpDeclaredValues')->with('status', $msg);
            } else return redirect()->back()->with('status', 'Invalid request!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }
}