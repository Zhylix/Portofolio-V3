@extends('errors.layout')

@section('title', '404 // Route Unmapped')
@section('code', '404')
@section('badge', 'ERR_ROUTE_NOT_FOUND')
@section('status-dot', 'bg-amber-500')
@section('message', 'Route Unmapped in System Cluster')

@section('description')
    The requested URI does not resolve to an active endpoint, service model, or publication. It may have been deprecated, migrated to a new namespace, or never compiled into this deployment.
@endsection

@section('diagnostic')
    <span class="text-[#E47A2E]">$</span> request-uri: {{ request()->path() }}<br>
    <span class="text-[#E47A2E]">$</span> status: 404 NOT_FOUND [Kernel::TERMINATE]<br>
    <span class="text-[#E47A2E]">$</span> recommendation: verify path slug or trigger global search (Ctrl + K)
@endsection
