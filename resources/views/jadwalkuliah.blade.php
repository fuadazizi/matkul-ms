@extends('layout')

@section('content')
<section class="header">
    <h1> API Matakuliah </h1>
    <a href="/"> Back </a>
</section>

<div class="text-container create">
    <p>API Create</p>
    <table>
        <tr>
            <td>Method</td>
            <td class="method"> POST</td>
        </tr>
        <tr>
            <td>URL API</td>
            <td> /api/jadwalkuliah </td>
        </tr>
        <tr>
            <td>JSON</td>
            <td>
                <pre class="code">{
    "id_dosen": {string},
    "hari": {enum['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']},
    "jam": {time},
    "ruang_kuliah": {string},
    "durasi": {int},
    "list_mhs": {array of int}
}</pre>
            </td>
        </tr>
    </table>
</div>

<div class="text-container read">
    <p>API Read</p>
    <table>
        <tr>
            <td>Method</td>
            <td class="method"> GET</td>
        </tr>
        <tr>
            <td>URL API</td>
            <td> /api/jadwalkuliah | /api/jadwalkuliah/{id} </td>
        </tr>
        <tr>
            <td>JSON</td>
            <td> -</td>
        </tr>
        <tr>
            <td>TEST Api</td>
            <td>
                <a href="/api/jadwalkuliah" target="_blank">Get All</a><br>
                <select id="get-selector">
                    @foreach($listjadwal as $jadwal)
                    <option value="{{ $jadwal->id }}">
                        {{ $jadwal->id }}. {{ $jadwal->dosen->nama }} -
                    </option>
                    @endforeach
                </select>
                <a id="get-link" href="/api/jadwalkuliah/{{ $listjadwal->first()->id }}" target="_blank">Get by Id</a>
            </td>
        </tr>
    </table>
</div>

<div class="text-container update">
    <p>API Update</p>
    <table>
        <tr>
            <td>Method</td>
            <td class="method"> PUT</td>
        </tr>
        <tr>
            <td>URL API</td>
            <td> /api/jadwalkuliah/{id} </td>
        </tr>
        <tr>
            <td>JSON</td>
            <td>
                <pre class="code">
{
    "id_dosen": {string},
    "hari": {enum['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu']},
    "jam": {time},
    "ruang_kuliah": {string},
    "durasi": {int},
    "list_mhs": {array of int}
}</pre>
            </td>
        </tr>
    </table>
</div>

<div class="text-container delete">
    <p>API Delete</p>
    <table>
        <tr>
            <td>Method</td>
            <td class="method"> DELETE</td>
        </tr>
        <tr>
            <td>URL API</td>
            <td> /api/jadwalkuliah/{id} </td>
        </tr>
        <tr>
            <td>JSON</td>
            <td> -</td>
        </tr>
    </table>
</div>

<script>
    document.getElementById('get-selector').addEventListener('change', function() {
        const id = this.value;
        document.getElementById('get-link').href = '/api/jadwalkuliah/' + id;
    });
</script>
@endsection