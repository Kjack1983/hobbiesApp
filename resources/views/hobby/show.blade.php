@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">Hobby detail</div>

                <div class="card-body">
                   <ul class="list-group">
                    <b>{{$hobby->name}}</b>
                    <p>{{$hobby->description}}</p>
                   </ul>
                </div>
                <div class="mt-2 ml-3 mb-2 d-flex">
                    <a href="{{ URL::previous() }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-arrow-circle-up"></i>
                        Back to overview
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
