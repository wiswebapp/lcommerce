@extends('layouts.app')

@section('content')
<section class="ftco-section ftco-no-pb ftco-no-pt bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-12 wrap-about ftco-animate">
                <div class="heading-section-bold mb-4 mt-md-5">
                    <div class="ml-md-0">
                        <h2 class="mb-4">{{$data->page_title}}</h2>
                    </div>
                </div>
                <div class="pb-md-5">
                    <div>{!!$data->page_description!!}</div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection