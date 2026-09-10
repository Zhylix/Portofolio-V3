@extends('errors.layout')

@section('title', '429 // Rate Limit Exceeded')
@section('code', '429')
@section('badge', 'ERR_THROTTLE_LIMIT_REACHED')
@section('status-dot', 'bg-orange-500')
@section('message', 'Traffic Rate Limit Triggered')

@section('description')
    Too many requests were transmitted from this client IP address within a short interval. The system firewall and rate limiting middleware have temporarily paused processing to preserve server availability.
@endsection

@section('diagnostic')
    <span class="text-[#E47A2E]">$</span> limiter-status: THROTTLED<br>
    <span class="text-[#E47A2E]">$</span> middleware: Illuminate\Routing\Middleware\ThrottleRequests<br>
    <span class="text-[#E47A2E]">$</span> recommendation: wait 60 seconds before issuing subsequent requests
@endsection
