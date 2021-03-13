@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">All the hobbies</div>

                <div class="card-body">
                   <ul class="list-group">
                       @foreach($hobbies as $hobby)
                        <li class="list-group-item">
                            <a title="Show details" href="/hobby/{{ $hobby->id }}">{{ $hobby->name }}</a> : {{ $hobby->description }}
                            
                            @auth
                            <a href="/hobby/{{ $hobby->id }}/edit" class="btn btn-sm btn-light ml-2 float-right">
                                <i class="fas fa-edit"></i>
                                Edit
                            </a>
                            @endauth

                            <span class="mx-2">Posted by:{{ $hobby->user->name }}</span>

                            @auth
                            <form class="float-right" style="display:inline" action="/hobby/{{ $hobby->id }}" method="post">
                                @csrf
                                @method("DELETE")
                                <input type="submit" class="btn btn-sm btn-outline-danger" value="Delete">
                            </form>
                            @endauth
                            <span class="float-right mx-2">{{ $hobby->created_at->diffForHumans() }}</span>
                        </li>
                       @endforeach
                   </ul>
                </div>

                <div class="mt-3">
                    {{ $hobbies->links() }}
                </div>

                @auth
                <div class="mt-2 ml-3 mb-2">
                    <a href="/hobby/create " class="btn btn-success btn-sm">
                        <i class="fas fa-plus-circle"></i>
                        Create new hobby
                    </a>
                </div>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
