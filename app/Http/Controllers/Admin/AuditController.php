<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class AuditController extends Controller
{
    public function show($id, Request $request) {

        $auditable_id = $request->auditable_id;
        $auditable_type = $request->auditable_type;

        // return $auditable_type;

        $audits = Audit::where([['auditable_id', $auditable_id],['auditable_type', $auditable_type]])->get();

        return view('admin.audits.show',compact('audits'));
    }
}
