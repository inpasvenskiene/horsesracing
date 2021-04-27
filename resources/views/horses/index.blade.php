@extends('layouts.app')
@section('content')
<h1 style="text-align:center">Arkliai</h1>
<div class="card-body">
@if (session('message'))
  <div class="alert alert-success">
    <p style="color: green"><b>{{ session('message') }}</b></p>
  </div>
  @endif
  
    <table class="table">
        <tr>
            <th>Pavadinimas</th>
            <th>Bėgimai</th>
            <th>Laimėjimai</th>
            <th>Aprašymas</th>
            <th>Veiksmai</th>
        </tr>
        @if($errors->any())
    	<h4 style="color: red">{{$errors->first()}}</h4>
        @endif
        
        @foreach ($horses as $horse)
        <tr>
            <td>{{ $horse->name }}</td>
            <td>{{ $horse->runs }}</td>
            <td>{{ $horse->wins }}</td>
            <td>{!! $horse->about !!}</td>
            <td>
                <form action={{ route('horses.destroy', $horse->id) }} method="POST">
                    <a class="btn btn-success" href={{ route('horses.edit', $horse->id) }}>Redaguoti</a>
                    @csrf @method('delete')
                    <input type="submit" class="btn btn-danger" value="Trinti"/>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div>
        <a href="{{ route('horses.create') }}" class="btn btn-success">Pridėti</a>
    </div>
</div>
@endsection
