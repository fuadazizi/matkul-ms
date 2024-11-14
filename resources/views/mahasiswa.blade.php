@extends('layout')

@section('content')
<section class="header">
    <h1> API Mahasiswa </h1>
    <a href="/"> Back </a>
</section>

<div class="text-container create">
    <p>API Create</p>
    <table>
        <tr>
            <td>Method</td>
            <td class="method">POST</td>
        </tr>
        <tr>
            <td>URL API</td>
            <td>/api/mahasiswa </td>
        </tr>
        <tr>
            <td>JSON </td>
            <td>
                <pre class="code">
{
    "nama": (string),
    "jurusan": (string),
    "angkatan": (string)
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
            <td> /api/mahasiswa </td>
        </tr>
        <tr>
            <td>JSON</td>
            <td> -</td>
        </tr>
        <tr>
            <td>TEST Api</td>
            <td>
                <a href="/api/mahasiswa" target="_blank">Get All</a><br>
                <select id="get-selector">
                    @foreach($listmhs as $mhs)
                    <option value="{{ $mhs->id }}">{{ $mhs->id }}. {{ $mhs->nama }}</option>
                    @endforeach
                </select>
                @if($listmhs->first())
                <a id="get-link" href="/api/mahasiswa/{{ $listmhs->first()->id }}" target="_blank">Get by Id</a>
                @endif
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
            <td> /api/mahasiswa/{id} </td>
        </tr>
        <tr>
            <td>JSON</td>
            <td>
                <pre class="code">
{
    "nama": (string),
    "jurusan": (string),
    "angkatan": (string)
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
            <td> /api/mahasiswa/{id} </td>
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
        document.getElementById('get-link').href = '/api/mahasiswa/' + id;
    });
</script>
@endsection