@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{ route('ad.search') }}" onsubmit="search(event)" id="searchForm">
                    @csrf

                    <input type="text" class="form-control mb-2" id="words">
                    <button type="submit" class="btn btn-primary mb-2">Rechercher</button>
                </form>

                @foreach($ads as $ad)
                    <div class="card w-100 mb-3" style="width: 18rem;">
                        <img src="https://via.placeholder.com/350x200">
                        <div class="card-body">
                            <h5 class="card-title">{{ $ad->title }}</h5>
                            <small>{{ Carbon\Carbon::parse($ad->created_at)->diffForHumans() }}</small>
                            <p class="card-text text-info">{{ $ad->localisation }}</p>
                            <p class="card-text">{{ $ad->description }}</p>
                            <a href="#" class="btn btn-primary">voir l'annonce</a>
                        </div>
                    </div>
                @endforeach
                {{  $ads->links()  }}
            </div>
        </div>
    </div>
@endsection

@section('extra-js')
    <script>

        function search(event) {
            event.preventDefault()
            const words = document.querySelector('#words').value
            const url = document.querySelector('#searchForm').getAttribute('action')

            //console.log(`${url}`);
            axios.post(`${url}`, {
                words: words,
            })
            .then(function (response) {
                console.log(response)
            })
            .catch(function (error) {
                console.log(error)
            });
        }
    </script>
@endsection