@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pakeiskime lažybininko informaciją</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('betters.update', $better->id) }}">
                        @csrf @method("PUT")
                        <div class="form-group">
                            <label for="">Vardas: </label>
                            <input type="text" name="name" class="form-control" value="{{ $better->name }}">

                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="">Pavardė : </label>
                            <input type="text" name="surname" class="form-control" value="{{ $better->surname }}">

                            <small class="text-danger">{{ $errors->first('surname') }}</small>
                        </div>
                        <div class="form-group">
                            <label for="">Statymo suma : </label>
                            <input type="number" name="bet" class="form-control" value="{{ $better->bet }}">

                            <small class="text-danger">{{ $errors->first('bet') }}</small>
                        </div>
                        <div class="form-group">
                            <label>Arklys: </label>
                            <select name="horse_id" id="" class="form-control">
                                @foreach ($horses as $horse)
                                <option value="{{ $horse->id }}" @if($horse->id == $better->horse_id) selected="selected" @endif>{{ $horse->name }}</option>
                                @endforeach
                            </select>

                            <small class="text-danger">{{ $errors->first('horse_id') }}</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Pakeisti</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
