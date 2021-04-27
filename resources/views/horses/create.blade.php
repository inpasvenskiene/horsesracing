@extends('layouts.app')
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">Sukurkime arklį:</div>
               <div class="card-body">
                   <form action="{{ route('horses.store') }}" method="POST">
                       @csrf
                       <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                           <label>Vardas: </label>
                           <input type="" name="name" class="form-control">

                           <small class="text-danger">{{ $errors->first('name') }}</small>
                       </div>
                       <div class="form-group{{ $errors->has('runs') ? ' has-error' : '' }}">
                           <label>Bėgimai: </label>
                           <input type="number" name="runs" class="form-control"> 

                           <small class="text-danger">{{ $errors->first('runs') }}</small>
                       </div>
                       <div class="form-group{{ $errors->has('wins') ? ' has-error' : '' }}">
                           <label>Laimėjimai: </label>
                           <input id="number" name="wins" class="form-control">

                           <small class="text-danger">{{ $errors->first('wins') }}</small>
                       </div>
                       <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                           <label>Aprašymas: </label>
                           <textarea id="mce" name="about" rows=10 cols=100 class="form-control"></textarea>

                           <small class="text-danger">{{ $errors->first('about') }}</small>
                       </div>
                       <button type="submit" class="btn btn-primary">Submit</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection
