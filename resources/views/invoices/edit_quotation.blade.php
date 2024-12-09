@extends('layouts.app')
@section('content')
<div class="container-fluid p-0">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class=" float-left mb-0 tw-text-black tw-pr-3">Edit Quotation</h2>
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/get-quotations">Quotations</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Forms</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div>
        @livewire('add-quotation',['status' => 'edit','quotation' => $quotation])
    </div>


</div>
@stop


<script src="{{ asset('/event_components/jquery.min.js')}}"></script>
 