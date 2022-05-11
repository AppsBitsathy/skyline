<?php

namespace App\Http\Controllers;

use App\Models\MasterPumpType;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterPumpDeclaredValuesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $pumpType = null)
    {
        if ($pumpType) {
            $allPumps = MasterPumpType::where('fldPtype', '=', $pumpType)->get();
            $allPumpsDD = MasterPumpType::pluck('fldPtype');
            return view('master.pumpDeclaredValues', compact('allPumps', 'allPumpsDD'));
        }

        $allPumps = MasterPumpType::all();
        $allPumpsDD = MasterPumpType::pluck('fldPtype');
        return view('master.pumpDeclaredValues', compact('allPumps','allPumpsDD'));
    }

    public function entry(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                $pump_type = new MasterPumpType();
                $pump_type->fldsno = $request->input('serialNo');
                $pump_type->fldPtype = $request->input('pumpType');
                $pump_type->fldhp = $request->input('hpkw');
                $pump_type->fldSsize = $request->input('suctionSize');
                $pump_type->fldDsize = $request->input('deliverySize');
                $pump_type->fldPhase = $request->input('phase');
                $pump_type->fldVolt = $request->input('voltage');
                $pump_type->fldRtemp = $request->input('roomTemp');
                $pump_type->fldThead = $request->input('totalHead');
                $pump_type->flddis = $request->input('discharge');
                $pump_type->fldoeff = $request->input('overallEfficiency');
                $pump_type->fldMcurr = $request->input('maxCurr');
                $pump_type->fldHeadr1 = $request->input('headRange1');
                $pump_type->fldHeadr2 = $request->input('headRange2');
                $pump_type->fldFreq = $request->input('frequency');
                $pump_type->fldtol = $request->input('efficiencyCalc');
                $pump_type->save();
                return redirect()->back()->with('status', 'Pump type added successfully!');
            }
        } catch (Exception $ex) {
            return redirect()->back()->with('status', $ex->__toString());
        }
    }

    public function update(Request $request)
    {
        $pump = MasterPumpType::findOrFail($request->input('id'));

        $extract = $request->all();

        $pump->fldsno = $extract['serialNo'];
        $pump->fldPtype = $extract['pumpType'];
        $pump->fldhp = $extract['hpkw'];
        $pump->fldSsize = $extract['suctionSize'];
        $pump->fldDsize = $extract['deliverySize'];
        $pump->fldPhase = $extract['phase'];
        $pump->fldVolt = $extract['voltage'];
        $pump->fldRtemp = $extract['roomTemp'];
        $pump->fldThead = $extract['totalHead'];
        $pump->flddis = $extract['discharge'];
        $pump->fldoeff = $extract['overallEfficiency'];
        $pump->fldMcurr = $extract['maxCurr'];
        $pump->fldHeadr1 = $extract['headRange1'];
        $pump->fldHeadr2 = $extract['headRange2'];
        $pump->fldFreq = $extract['frequency'];
        $pump->fldtol = $extract['efficiencyCalc'];

        $pump->save();

        return redirect()->back()->with('status', 'Pump values updated successfully!');
    }

    // public function listAll(Request $request)
    // {
    //     $users = User::all();
    //     return view('master.pumpDeclaredValues', compact('users'));
    // }
}
