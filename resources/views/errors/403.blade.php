@extends('errors.layout')

@section('title', '403 // Access Restricted')
@section('code', '403')
@section('badge', 'ERR_ACCESS_FORBIDDEN')
@section('status-dot', 'bg-rose-500')
@section('message', 'Subsystem Access Restricted')

@section('description')
    Access to this protected module or operational endpoint requires elevated administrative privileges or signed verification tokens.
@endsection

@section('diagnostic')
    <span class="text-[#E47A2E]">$</span> auth-level: guest_unauthorized<br>
    <span class="text-[#E47A2E]">$</span> policy-evaluation: DENY_ALL<br>
    <span class="text-[#E47A2E]">$</span> recommendation: authenticate through the administrative portal or return home
@endsection

@section('actions')
    <a 
        href="/admin/login" 
        class="px-6 py-3 rounded-xl bg-[#1E1A17] hover:bg-[#2A2520] text-[#E47A2E] border border-[#2A2520] hover:border-[#C45A19] font-mono text-xs uppercase tracking-wider font-semibold transition-all duration-200"
    >
        Admin Login &rarr;
    </a>
@endsection
