<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah File</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

                header {
            background-color: #001e74;
            color: white;
            padding: 16px 24px;
            font-size: 20px;
            font-weight: bold;
        }

        .manage-label {
            font-size: 16px;
            font-weight: 600;
            color: #FFC31D;
            margin-bottom: 6px;
        }

        .nav-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: white;
            padding: 10px 30px;
            border-bottom: 1px solid #ccc;
            list-style: none;
        }

        .nav-bar img {
            height: 80px;
        }

        .nav-menu {
            display: flex;
            gap: 50px;
            font-size: 20px;
            text-decoration: none;
        }

        .nav-menu a {
            text-decoration: none;
            color: #001e74;
            font-weight: bold;

        }

        .nav-menu a.active {
            border-bottom: 5px solid #FFC31D;
            padding-bottom: 20px;
            color: #FFC31D;
            transition: width 0.3s ease;
        }

        .nav-menu li a {
            position: relative;
            color: #001e74;
            text-decoration: none;
            font-weight: bold;
            padding-bottom: 24px;
        }

        .nav-menu li a::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 5px;
            width: 0;
            background-color: #FFC31D;
            transition: width 0.3s ease;
        }

        .nav-menu li a:hover::after {
            width: 100%;
        }

        .nav-menu li a:hover {
            color: #facc15;
        }

        .form-container {
            max-width: 700px;
            margin: 50px auto;
            background: white;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #001e74;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .form-control {
            width: 100%;
            margin-bottom: 20px;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
            font-size: 16px;
        }

        .form-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: bold;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .btn-green {
            background-color: green;
            color: white;
        }

        .btn-red {
            background-color: red;
            color: white;
            text-decoration: none;
            display: inline-block;
        }
    </style>
</head>
<body>
    <header>Admin</header>

    <div class="nav-bar">
        <img src="{{ asset('asset/img/logo-spbe.png') }}" alt="Logo SPBE">
        <div class="nav-container">
            <div class="manage-label">Manage</div>
            <nav class="nav-menu">
                <li><a href="#">Indikator SPBE</a></li>
                <li><a href="#">Profile</a></li>
                <li><a href="#">Berita</a></li>
                <li><a href="#" class="active">Download</a></li>
                <li><a href="#">Galeri</a></li>
                <li><a href="#">Kontak</a></li>
            </nav>
        </div>
    </div>
    <div class="form-container">
        <h2>Form Menambah File Baru</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="category" placeholder="Category" class="form-control" required>
            <input type="text" name="title" placeholder="Title" class="form-control" required>
            <textarea name="content" placeholder="Content" rows="5" class="form-control" required></textarea>
            <input type="file" name="file" class="form-control" required>

            <div class="form-buttons">
                <button type="submit" class="btn btn-green">Simpan</button>
                <a href="{{ route('admin.download') }}" class="btn btn-red">Batal</a>
            </div>
        </form>
    </div>

</body>
</html>
