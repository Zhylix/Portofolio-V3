@extends('errors.layout')

@section('title', '419 // Session Expired')
@section('code', '419')
@section('badge', 'ERR_CSRF_TOKEN_MISMATCH')
@section('status-dot', 'bg-amber-500')
@section('message', 'Security Token Expired')

@section('description')
    The cryptographic CSRF token for this form or session has expired due to inactivity. Reloading the page will establish a fresh token payload and allow you to continue.
@endsection

@section('diagnostic')
    <span class="text-[#E47A2E]">$</span> session-lifecycle: TIMEOUT_REACHED<br>
    <span class="text-[#E47A2E]">$</span> csrf-status: TOKEN_EXPIRED_OR_ABSENT<br>
    <span class="text-[#E47A2E]">$</span> action: window.location.reload()
@endsection

@section('actions')
    <button 
        type="button"
        onclick="window.location.reload()" 
        class="px-6 py-3 rounded-xl bg-[#C45A19] hover:bg-[#E47A2E] text-white font-mono text-xs uppercase tracking-wider font-semibold transition-all duration-200 shadow-lg shadow-[#C45A19]/25 flex items-center gap-2 cursor-pointer"
    >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
        <span>Reload Session</span>
    </button>
@endsection
