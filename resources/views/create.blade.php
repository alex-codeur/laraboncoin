@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Déposer une annonce</h1>
        <hr>

        <form method="POST" action="{{ route('ad.store') }}">
            @csrf

            <div class="form-group">
              <label for="title">Titre de l'annonce</label>
              <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title">

              @error('title')
                    <div class="invalid-feedback">{{ $errors->first('title') }}</div>
                @enderror
            </div>

            <div class="form-group">
              <label for="description">Description de l'annonce</label>
              <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="6" name="description"></textarea>

              @error('description')
                    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="localisation">Localisation</label>
                <input type="text" name="localisation" class="form-control @error('localisation') is-invalid @enderror" id="localisation">

                @error('localisation')
                    <div class="invalid-feedback">{{ $errors->first('localisation') }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Prix</label>
                <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="price">

                @error('price')
                    <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                @enderror
            </div>

            @guest
                <h1>Vos Informations</h1>
                <hr>

                <div class="form-group">
                    <label for="name">Votre nom</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="title">

                    @error('name')
                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @enderror
                </div>  
                <div class="form-group">
                    <label for="email">Votre email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email">

                    @error('email')
                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                    @enderror
                </div>  
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">

                    @error('password')
                        <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                    @enderror
                </div>  
                <div class="form-group">
                    <label for="password_confirmation">Confirmer votre mot de passe</label>
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation">

                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
                    @enderror
                </div>   
            @endguest

            <button type="submit" class="btn btn-primary">Soumettre notre annonce</button>
          </form>
    </div>
@endsection