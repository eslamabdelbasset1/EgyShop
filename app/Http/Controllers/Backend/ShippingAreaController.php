<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{
    public function divisionView(){
        $divisions = ShipDivision::orderBy('id','DESC')->get();
        return view('backend.ship.division.view_division',compact('divisions'));

    }


    public function divisionStore(Request $request){

        $request->validate([
            'division_name' => 'required',

        ]);


        ShipDivision::create([
            'division_name' => $request->division_name,
        ]);

        $notification = array(
            'message' => 'Division Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end method
    public function divisionEdit($id){

        $divisions = ShipDivision::findOrFail($id);
        return view('backend.ship.division.edit_division',compact('divisions'));
    }
    public function divisionUpdate(Request $request,$id){

        ShipDivision::findOrFail($id)->update([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Division Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage-division')->with($notification);


    } // end mehtod


    public function divisionDelete($id){

        ShipDivision::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Division Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    } // end method

    //// Start Ship District

    public function districtView(){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::with('division')->orderBy('id','DESC')->get();
        return view('backend.ship.district.view_district',compact('division','district'));
    }

    public function DistrictStore(Request $request){

        $request->validate([
            'division_id' => 'required',
            'district_name' => 'required',

        ]);


        ShipDistrict::create([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
        ]);

        $notification = array(
            'message' => 'District Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end method

    public function districtEdit($id){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::findOrFail($id);
        return view('backend.ship.district.edit_district',compact('district','division'));
    }

    public function districtUpdate(Request $request,$id){

        ShipDistrict::findOrFail($id)->update([

            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'District Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage-district')->with($notification);


    } // end mehtod
    public function districtDelete($id){

        ShipDistrict::findOrFail($id)->delete();

        $notification = array(
            'message' => 'District Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);

    } // end method
    //// End Ship District


    ////////////////// Ship State //////////
    public function stateView(){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::orderBy('district_name','ASC')->get();
        $state = ShipState::with('division','district')->orderBy('id','DESC')->get();
        return view('backend.ship.state.view_state',
            compact('division','district','state'));
    }

    public function stateStore(Request $request){

        $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'state_name' => 'required',

        ]);


        ShipState::create([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
        ]);

        $notification = array(
            'message' => 'State Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // end method


    public function stateEdit($id){
        $division = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::orderBy('district_name','ASC')->get();
        $state = ShipState::findOrFail($id);
        return view('backend.ship.state.edit_state',compact('division','district','state'));
    }

    public function stateUpdate(Request $request,$id){

        ShipState::findOrFail($id)->update([

            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'State Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage-state')->with($notification);


    } // end mehtod


    public function stateDelete($id){

        ShipState::findOrFail($id)->delete();

        $notification = array(
            'message' => 'State Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    } // end method

    //////////////// End Ship State ////////////
}
