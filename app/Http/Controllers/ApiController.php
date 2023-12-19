<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calonical;

class ApiController extends Controller
{
    public function calonicalindex($website = '')
    {
        if ($website != '') {
            $calonical = Calonical::where('website', $website)->get();
        } else {
            $calonical = Calonical::all();
        }

        return response()->json(['data' => $calonical]);
    }

    public function calonicalview($id)
    {
        parse_str($id, $data);

        $all_id = $data['id'];

        $calonical = Calonical::whereIn('id', $all_id)->get();

        return response()->json(['data' => $calonical]);
    }


    public function calonicalstore(Request $request)
    {
        $calonical = Calonical::create($request->all());
        return response()->json(['data' => $calonical]);
    }

    public function calonicalupdate(Request $request)
    {
        $ids = $request->id;
        $updatedCalonicals = [];

        foreach ($ids as $index => $id) {
            $calonical = Calonical::findOrFail($id);
            $calonical->update([
                'domain' => $request->domain[$index],
                'title' => $request->title[$index],
                'description' => $request->description[$index]
            ]);

            $updatedCalonicals[] = $calonical;
        }

        return response()->json(['data' => $updatedCalonicals]);
    }

    public function calonicaldestroy(Request $request)
    {

        $ids = $request->ids;

        if (!is_array($ids)) {
            $ids = [$ids];
        }

        Calonical::whereIn('id', $ids)->delete();
        $calonical = Calonical::all();
        return response()->json(['data' => $calonical]);
    }
}
