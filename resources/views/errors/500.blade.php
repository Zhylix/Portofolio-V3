@extends('errors.layout')

@section('title', '500 // Server Anomaly')
@section('code', '500')
@section('badge', 'ERR_INTERNAL_SERVER_ANOMALY')
@section('status-dot', 'bg-red-500')
@section('message', 'Internal Server State Anomaly')

@section('description')
    An unhandled exception occurred during transaction lifecycle or response compilation. A diagnostic event has been dispatched to system logging channels for investigation.
@endsection

@section('diagnostic')
    <span class="text-[#E47A2E]">$</span> kernel-exception: DISPATCHED_TO_STACK_LOGGER<br>
    <span class="text-[#E47A2E]">$</span> telemetry-state: INCIDENT_LOGGED<br>
    <span class="text-[#E47A2E]">$</span> recommendation: retry operation or reach out directly via contact form
@endsection

@section('actions')
    <a 
        href="{{ route('contact.index') }}" 
        class="px-6 py-3 rounded-xl bg-[#1E1A17] hover:bg-[#2A2520] text-[#E47A2E] border border-[#2A2520] hover:border-[#C45A19] font-mono text-xs uppercase tracking-wider font-semibold transition-all duration-200"
    >
        Report Issue via Contact &rarr;
    </a>
@endsection
