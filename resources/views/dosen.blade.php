@extends('layout')

@section('content')
<section class="header">
    <h1> API Dosen </h1>
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
            <td> /api/dosen </td>
        </tr>
        <tr>
            <td>JSON</td>
            <td>
                <pre class="code">
{
    "nama": (string),
    "id_matkul": (string)
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
            <td> /api/dosen </td>
        </tr>
        <tr>
            <td>JSON</td>
            <td> -</td>
        </tr>
        <tr style="border-bottom: 0;">
            <td>TEST Api</td>
            <td>
                <a href="/api/dosen" target="_blank">Get All</a> <br>
                <select id="get-selector">
                    @foreach($listdosen as $dosen)
                    <option value="{{ $dosen->id }}">{{ $dosen->id }}. {{ $dosen->nama }}</option>
                    @endforeach
                </select>
                <a id="get-link" href="/api/dosen/{{ $listdosen->first()->id }}" target="_blank">Get by Id</a>
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
            <td> /api/dosen/{id} </td>
        </tr>
        <tr>
            <td>JSON</td>
            <td>
                <pre class="code">
{
    "nama": (string),
    "id_matkul": (string)
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
            <td> /api/dosen/{id} </td>
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
        document.getElementById('get-link').href = '/api/dosen/' + id;
    });
</script>
@endsection