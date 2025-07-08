<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>SPBE - Pemerintah Kota Bandar Lampung</title>
    <style>
        .table-container {
            padding: 24px;

        }

        .download-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 20px;
            color: #001e74;
            margin: 30px 30px 10px;
            display: inline-block;
            padding-bottom: 4px;
        }

        table {
            width: 95%;
            border-collapse: collapse;
            background-color: white;
            margin: auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #001e74;
            color: white;
            font-size: 16px;
        }

        td{
            font-size: 15px;
        }

        tr:nth-child(even) {
            background-color: #eee;
        }

        .btn-download {
            background-color: #007bff;
            display: inline-block;
            color: white;
            padding: 6px 8px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            border: none;
            outline: none;
        }

        .btn-download:hover {
            transform: scale(1.03);
        }
    </style>
</head>
<body>
@section('navbar', true)
@extends('layouts.layout_user')

@section('content')

     <div class="table-container">
        <div class="download-header">
            <h1>Daftar Dokumen yang dapat di download</h1>
        </div>
        <table>
            <thead>
                <tr>
                    <th style="width: 15%;">Category</th>
                    <th style="width: 23%;">Title</th>
                    <th style="width: 50%;">Content</th>
                    <th style="width: 12%;">File</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($downloads as $d)
                    <tr>
                        <td>{{ $d->category }}</td>
                        <td>{{ $d->title }}</td>
                        <td>{{ $d->content }}</td>
                        <td>
                            <a href="{{ route('admin.download.file', $d->file_path) }}" class="btn-download">Download</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>

@endsection

</body>
</html>
