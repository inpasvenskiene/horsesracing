@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pakeiskime arklio informaciją</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('horses.update', $horse->id) }}">
                        @csrf @method("PUT")
                        <div class="form-group">
                            <label for="">Vardas: </label>
                            <input type="text" name="name" class="form-control" value="{{ $horse->name }}">

                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="">Arklių bėgimai: </label>
                            <input type="number" name="runs" class="form-control" value="{{ $horse->runs }}">

                            <small class="text-danger">{{ $errors->first('runs') }}</small>
                        </div>
                        <div class="form-group">
                            <label>Laimėjimai: </label>
                            <input type="number" name="wins" class="form-control" value="{{ $horse->wins }}">

                            <small class="text-danger">{{ $errors->first('wins') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="">Aprašymas: </label>
                            <textarea id="mce" name="about" rows=10 cols=100 
                            class="form-control">{{ $horse->about }}</textarea>

                            <small class="text-danger">{{ $errors->first('about') }}</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Pakeisti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
