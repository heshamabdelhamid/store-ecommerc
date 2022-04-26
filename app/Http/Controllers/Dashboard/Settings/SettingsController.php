<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{


    public function editShippingsMethods(string $type)
    {

        if ($type === 'free')
            $shippingmethod = Setting::where('key', 'free_shipping_label')->first();

        elseif ($type === 'inner')
            $shippingmethod = Setting::where('key', 'local_label')->first();

        elseif ($type === 'outer')
            $shippingmethod = Setting::where('key', 'outer_shipping_label')->first();

        // else ' sorry this shipping not found '; //make view errors sittings

        return view('dashboard.settings.shippings.edit', compact('shippingmethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSettingRequest  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function updateShippingsMethods(UpdateSettingRequest $request, $id)
    {
        try {
            $shipping_method = Setting::findOrfail($id);

            DB::beginTransaction();
            $shipping_method->update(['plain_value' => $request->plain_value]);

            $shipping_method->value = $request->value;
            $shipping_method->save();

            DB::commit();
            return redirect()->back()->with(['success' => 'تم التعديل بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->back()->with(['error' => 'هناك خطأ']);
            DB::rollBack();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}