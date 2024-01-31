<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <form method="POST" action="{{ route('objectoftrades.store') }}">
            @csrf
            <textarea
                name="message"
                placeholder="{{ __('What\'s on your mind?') }}"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            >{{ old('message') }}</textarea>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
            <x-primary-button class="mt-4">{{ __('Chirp') }}</x-primary-button>
        </form>

        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach($myobjects as $myobject)
                <div>
                    <div class="card mb-3" style="max-width: 1300px; max-height: 130px;">
                        <div class="row g-1">
                            <div class="col-md-2">
                                <img src="{{$myobject->imagesPath}}" width="130" height="130"  class="img-fluid mt-3 pl-2 rounded-start" alt="Furniture">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body" style="height: 200px">
                                    <h5 class="card-title"><a href="/page?id={{$myobject->id}}">{{$myobject->name}}</a></h5>
                                    <p class="card-text" ><small class="text-muted">
                                <span class="d-inline-block text-truncate text-wrap" style="max-width: 100%; max-height: 80px">
                                {{$myobject->description}}
                                </span>
                                        </small></p>
                                </div>
                            </div>
                            <div class="col-md-1 mt-5 ml-5">
                                <h4>{{$myobject->price}}грн</h4>
                            </div>
                            @if(!$myorders)
                                <div class="col-md-1 mt-5 ml-5">
                                    <a href="/page?id={{$myobject->id}}&order=true" class="btn rounded-circle btn-outline-success bg-info" aria-label="Добавить товар" data-first-add="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="35" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                                            <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
