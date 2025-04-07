<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil data packages hanya untuk member yang sedang login
        $packages = Package::with('outlet')
            ->where('member_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('member.packages.index', compact('packages'));
    }
}