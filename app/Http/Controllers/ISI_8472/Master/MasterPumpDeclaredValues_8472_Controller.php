<?php

namespace App\Http\Controllers\ISI_8472\Master;

use App\Http\Controllers\Controller;
use App\Models\ISI_8472\Master\isi_8472_MasterPumpType;
use Exception;
use Illuminate\Http\Request;

class MasterPumpDeclaredValues_8472_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $pumpType = null)
    {
        try {
            if ($pumpType) {
                $allPumps = isi_8472_MasterPumpType::where('fldptype', '=', $pumpType)->get();
                $allPumpsDD = isi_8472_MasterPumpType::pluck('fldptype');
                return view('8472.master.pumpDeclaredValues', compact('allPumps', 'allPumpsDD'));
            }

            $allPumps = isi_8472_MasterPumpType::all();
            $allPumpsDD = isi_8472_MasterPumpType::pluck('fldptype');
            return view('8472.master.pumpDeclaredValues', compact('allPumps', 'allPumpsDD'));
        } catch (Exception $ex) {
            return redirect()->back()->with('status', 'Internal Error! ' . $ex->__toString());
        }
    }

    public function entry(Request $request)
    {
        try {
            if ($request->isMethod('post') && $request->input('_token')) {


                if (str_contains($request->input('pumpType'), '/')) {
                    return redirect()->back()->with('status', 'Invalid Pump Type Format!');
                }

                $pump_type = new isi_8472_MasterPumpType();
                $pump_type->fldsno = $request->input('serialNo');
                $pump_type->fldptype = $request->input('pumpType');
                $pump_type->fldhp = $request->input('hpkw');
                $pump_type->fldssize = $request->input('suctionSize');
                $pump_type->flddsize = $request->input('deliverySize');
                $pump_type->fldphase = $request->input('phase');
                $pump_type->fldthead = $request->input('totalHead');
                $pump_type->fldip = $request->input('ipow');
                $pump_type->flddis = $request->input('discharge');
                $pump_type->fldmcurr = $request->input('maxCurr');
                $pump_type->fldvolt = $request->input('voltage');
                $pump_type->fldheadr1 = $request->input('headRange1');
                $pump_type->fldheadr2 = $request->input('headRange2');
                $pump_type->fldfreq = $request->input('frequency');
                $pump_type->fldsptime = $request->input('selfPrTime');
                $pump_type->save();
                return redirect()->route('8472_masterPumpDeclaredValues')->with('status', 'Pump type added successfully!');
            } else return redirect()->back()->with('status', 'Invalid request!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function update(Request $request)
    {
        try {

            if ($request->isMethod('post') && $request->input('_token')) {

                if (str_contains($request->input('pumpType'), '/')) {
                    return redirect()->back()->with('status', 'Invalid Pump Type Format!');
                }

                $pump_type = isi_8472_MasterPumpType::findOrFail($request->input('id'));

                // $pump_type->fldsno = $request->input('serialNo');
                // $pump_type->fldptype = $request->input('pumpType');
                $pump_type->fldhp = $request->input('hpkw');
                $pump_type->fldssize = $request->input('suctionSize');
                $pump_type->flddsize = $request->input('deliverySize');
                $pump_type->fldphase = $request->input('phase');
                $pump_type->fldthead = $request->input('totalHead');
                $pump_type->fldip = $request->input('ipow');
                $pump_type->flddis = $request->input('discharge');
                $pump_type->fldmcurr = $request->input('maxCurr');
                $pump_type->fldvolt = $request->input('voltage');
                $pump_type->fldheadr1 = $request->input('headRange1');
                $pump_type->fldheadr2 = $request->input('headRange2');
                $pump_type->fldfreq = $request->input('frequency');
                $pump_type->fldsptime = $request->input('selfPrTime');

                $pump_type->save();

                return redirect()->route('8472_masterPumpDeclaredValues')->with('status', 'Pump Values Updated Successfully!');
            } else return redirect()->back()->with('status', 'Invalid request!');
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }
}