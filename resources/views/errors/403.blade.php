{{-- @extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden')) --}}

<x-custom-layout>
    <div class="text-center">
        <h1>Forbidden (403)</h1>
        You do not have any of the necessary access rights.
    </div>
</x-custom-layout>
