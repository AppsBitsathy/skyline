<?php

namespace App\Http\Controllers\ISI_12225;

use App\Http\Controllers\Controller;
use App\Models\isi_12225_MasterPumpType;
use Exception;
use Illuminate\Http\Request;

class MasterPumpDeclaredValues_12225_Controller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $pumpType = null)
    {
        if ($pumpType) {
            $allPumps = isi_12225_MasterPumpType::where('fldptype', '=', $pumpType)->get();
            $allPumpsDD = isi_12225_MasterPumpType::pluck('fldptype');
            return view('12225.master.pumpDeclaredValues', compact('allPumps', 'allPumpsDD'));
        }

        $allPumps = isi_12225_MasterPumpType::all();
        $allPumpsDD = isi_12225_MasterPumpType::pluck('fldptype');
        return view('12225.master.pumpDeclaredValues', compact('allPumps', 'allPumpsDD'));
    }

    public function entry(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                if ($request->input('_token')) {

                    if (str_contains($request->input('pumpType'), '/')) {
                        return redirect()->back()->with('status', 'Invalid Pump Type Format!');
                    }

                    $pump_type = new isi_12225_MasterPumpType();
                    $pump_type->fldsno = $request->input('serialNo');
                    $pump_type->fldptype = $request->input('pumpType');
                    $pump_type->fldhp = $request->input('hpkw');
                    $pump_type->flddsize = $request->input('suctionSize');
                    $pump_type->flddisize = $request->input('dischargeSize');
                    $pump_type->fldpsize = $request->input('pressureSize');
                    $pump_type->fldthead = $request->input('totalHead');
                    $pump_type->flddlwl = $request->input('dlwl');
                    $pump_type->fldpi = $request->input('powerInput');
                    $pump_type->flddis = $request->input('discharge');
                    $pump_type->fldmcurr = $request->input('maxCurr');
                    $pump_type->fldvolt = $request->input('voltage');
                    $pump_type->flddlwl1 = $request->input('dlwlRange1');
                    $pump_type->flddlwl2 = $request->input('dlwlRange2');
                    $pump_type->fldmop = $request->input('minOpertingPressure');
                    $pump_type->fldfreq = $request->input('frequency');
                    $pump_type->fldsub = $request->input('submergence');
                    $pump_type->fldphase = $request->input('phase');
                    $pump_type->save();
                    return redirect()->back()->with('status', 'Pump type added successfully!');
                } else {
                    return redirect()->back()->with('status', 'Invalid token!');
                }
            } else {
                return redirect()->back()->with('status', 'Invalid request!');
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function update(Request $request)
    {
        try {

            if ($request->isMethod('post')) {
                if ($request->input('_token')) {
                    if (str_contains($request->input('pumpType'), '/')) {
                        return redirect()->back()->with('status', 'Invalid Pump Type Format!');
                    }

                    $pump_type = isi_12225_MasterPumpType::findOrFail($request->input('id'));

                    // $pump_type->fldsno = $request->input('serialNo');
                    // $pump_type->fldptype = $request->input('pumpType');
                    $pump_type->fldhp = $request->input('hpkw');
                    $pump_type->flddsize = $request->input('suctionSize');
                    $pump_type->flddisize = $request->input('dischargeSize');
                    $pump_type->fldpsize = $request->input('pressureSize');
                    $pump_type->fldthead = $request->input('totalHead');
                    $pump_type->flddlwl = $request->input('dlwl');
                    $pump_type->fldpi = $request->input('powerInput');
                    $pump_type->flddis = $request->input('discharge');
                    $pump_type->fldmcurr = $request->input('maxCurr');
                    $pump_type->fldvolt = $request->input('voltage');
                    $pump_type->flddlwl1 = $request->input('dlwlRange1');
                    $pump_type->flddlwl2 = $request->input('dlwlRange2');
                    $pump_type->fldmop = $request->input('minOpertingPressure');
                    $pump_type->fldfreq = $request->input('frequency');
                    $pump_type->fldsub = $request->input('submergence');
                    $pump_type->fldphase = $request->input('phase');

                    $pump_type->save();

                    return redirect()->back()->with('status', 'Pump Values Updated Successfully!');
                } else {
                    return redirect()->back()->with('status', 'Invalid token!');
                }
            } else {
                return redirect()->back()->with('status', 'Invalid request!');
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }
}