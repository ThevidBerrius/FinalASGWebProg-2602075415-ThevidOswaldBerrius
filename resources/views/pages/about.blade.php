@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center">@lang('lang.about_us')</h1>
                <p class="text-center">@lang('lang.welcome_message')</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <h3>@lang('lang.our_mission')</h3>
                <p>@lang('lang.mission_description')</p>
            </div>
            <div class="col-md-6">
                <h3>@lang('lang.what_we_do')</h3>
                <p>@lang('lang.what_we_do_description')</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <h3>@lang('lang.contact_us')</h3>
                <p>@lang('lang.contact_message')</p>
            </div>
        </div>
    </div>
@endsection
