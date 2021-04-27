@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
<div class="col-md-10">
       <h1 style="text-align: center;">Lažybininkai</h1>
          <div class="card-body">
              <form class="form-inline" action="{{ route('betters.index') }}" method="GET">
                   @if (session('message'))
                      <div class="alert alert-success">
                         <p style="color: green"><b>{{ session('message') }}</b></p>
                       </div>
                   @endif
  
        <select name="horse_id" id="" class="form-control">
            <option value="" selected disabled>Pasirinkite arklį lažybininkų filtravimui:</option>
            @foreach ($horses as $horse)
            <option value="{{ $horse->id }}" 
                @if($horse->id == app('request')->input('horse_id')) 
                    selected="selected" 
                @endif>{{ $horse->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary">Filtruoti</button>
        <a class="btn btn-success" href={{ route('betters.index') }}>Rodyti visus</a>
    </form>
</div>

<div class="card-body">
    <table class="table">
        <tr>
            <th>Vardas</th>
            <th>Pavardė</th>
            <th>Statymo suma</th>
            <th>Arklys</th>
            <th>Veikmai</th>
        </tr>
        @foreach ($betters as $better)
        <tr>
            <td>{{ $better->name }}</td>
            <td>{{ $better->surname }}</td>
            <td>{{ $better->bet }}</td>
            <td>{{ $better->horse->name }}</td>
            <td>
                <form action={{ route('betters.destroy', $better->id) }} method="POST">
                    <a class="btn btn-success" href={{ route('betters.edit', $better->id) }}>Redaguoti</a>
                    @csrf @method('delete')
                    <input type="submit" class="btn btn-danger" value="Trinti"/>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <div>
        <a href="{{ route('betters.create') }}" class="btn btn-success">Pridėti</a>
    </div>
</div>
</div>
</div>
@endsection
