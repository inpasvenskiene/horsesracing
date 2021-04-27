@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Sukurkime lažybininką:</div>
               <div class="card-body">
                   <form action="{{ route('betters.store') }}" method="POST">
                       @csrf
                       <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                           <label>Vardas: </label>
                           <input type="text" name="name" class="form-control">

                           <small class="text-danger">{{ $errors->first('name') }}</small>
                       </div>
                       <div class="form-group{{ $errors->has('surname') ? ' has-error' : '' }}">
                           <label>Pavardė: </label>
                           <input type="text" name="surname" class="form-control"> 

                           <small class="text-danger">{{ $errors->first('surname') }}</small>
                       </div>
                       <div class="form-group{{ $errors->has('bet') ? ' has-error' : '' }}">
                           <label>Statymo suma: </label>
                           <input type="number" name="bet" class="form-control"> 

                           <small class="text-danger">{{ $errors->first('bet') }}</small>
                       </div>
                       <div class="form-group{{ $errors->has('horse_id') ? ' has-error' : '' }}">
                           <label>Arklys: </label>
                           <select name="horse_id" id="" class="form-control">
                                <option value="" selected disabled>Pasirinkite arkį</option>
                                @foreach ($horses as $horse)
                                <option value="{{ $horse->id }}">{{ $horse->name }}</option>
                                @endforeach
                           </select>

                           <small class="text-danger">{{ $errors->first('horse_id') }}</small>
                       </div>
                       <button type="submit" class="btn btn-primary">Submit</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

