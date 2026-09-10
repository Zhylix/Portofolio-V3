<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Contracts\View\View;

class CertificateController extends Controller
{
    public function index(): View
    {
        $certificates = Certificate::with(['skills', 'experiences'])->ordered()->paginate(12)->withQueryString();

        return view('pages.certificates.index', compact('certificates'));
    }
}
