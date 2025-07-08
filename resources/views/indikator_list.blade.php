@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Indikator SPBE</h1>

    <div class="filters">
        <form method="GET">
            <select name="domain_id" onchange="this.form.submit()">
                <option value="">Semua Domain</option>
                @foreach($domains as $domain)
                    <option value="{{ $domain->id }}" {{ request('domain_id') == $domain->id ? 'selected' : '' }}>
                        {{ $domain->nama }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Domain</th>
                <th>Aspek</th>
                <th>Indikator</th>
                <th>Penjelasan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($indikators as $index => $indikator)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $indikator->aspect->domain->nama }}</td>
                <td>{{ $indikator->aspect->nama }}</td>
                <td>{{ $indikator->nama }}</td>
                <td>{!! nl2br(e($indikator->penjelasan)) !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
