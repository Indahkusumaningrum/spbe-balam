<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPBE</title>
    <link rel="icon" href="{{ asset('asset/img/logo.png') }}" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" rel="stylesheet" />
    <style>
        * {
            margin: 0; padding: 0; box-sizing: border-box; list-style: none; text-decoration: none;
            -moz-osx-font-smoothing: grayscale; -webkit-font-smoothing: antialiased; text-rendering: optimizeLegibility;
        }
        body { font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif; font-size: 16px; font-weight: normal; line-height: 1.5; color: #252a32; background: #ffffff; }
        .container { max-width: 1200px; width: 100%; padding: 50px 0; margin: 0 auto; }
        .main .swiper-container { position: relative; width: 100vw; left: 50%; transform: translateX(-50%); height: 500px; padding-bottom: 50px; overflow: hidden; perspective: 1200px; margin-bottom: 30px; }
        .main .swiper-container .swiper-wrapper { height: 100%; }
        .main .swiper-container .swiper-wrapper .swiper-slide {
            background: #f1f5f8; display: flex; align-items: center; justify-content: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 3px rgba(0, 0, 0, 0.24); border-radius: 8px; width: 70% !important; opacity: 0.8;
        }
        .main .swiper-container .swiper-wrapper .swiper-slide-active { opacity: 1; }
        .main .swiper-container .swiper-wrapper .swiper-slide .card-image { background: #ffffff; border: none; outline: none; border-radius: 2px; width: 100%; height: 100%; overflow: hidden; }
        .main .swiper-container .swiper-wrapper .swiper-slide .card-image img { display: block; width: 100%; height: 100%; object-fit: cover; }
        .main .swiper-container .swiper-button-next,
        .main .swiper-container .swiper-button-prev {
            background-image: none; background-size: 0; background-repeat: no-repeat; background-position: 0; margin-top: -16px;
            width: auto; height: auto; position: absolute; top: 50%; transform: translateY(-50%); z-index: 10; cursor: pointer;
        }
        .main .swiper-container .swiper-button-next::after,
        .main .swiper-container .swiper-button-prev::after {
            display: none;
        }
        .main .swiper-container .swiper-button-next .arrow-icon,
        .main .swiper-container .swiper-button-prev .arrow-icon {
            font-size: 32px; color: rgba(255,255,255,0.3);
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }
        .main .swiper-container .swiper-button-prev { left: 30px; }
        .main .swiper-container .swiper-button-next { right: 30px; }
        .card-link { display: block; width: 100%; height: 100%; text-decoration: none; color: inherit; }
        .spbe-info-section { display: flex; justify-content: center; flex-wrap: wrap; gap: 50px; padding: 40px 20px; background-color: #ffffff; }
        .info-card { width: 270px; min-width: 250px; max-width: 100%; border: 1.5px solid #facc15; border-radius: 16px; box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5); padding: 24px; text-align: center; transition: transform 0.3s; }
        .info-card:hover { transform: translateY(-20px); }
        .info-card .info-icon { width: 90px; height: 90px; margin-bottom: 15px; }
        .info-card h3 { font-size: 18px; margin: 0 0 8px; color: #000; }
        .info-card p { font-size: 14px; color: #333; margin-bottom: 16px; }
        .info-card a { color: white; font-weight: 600; }
        .btn-selengkapnya {
            display: inline-block; background-color: #ffae00; color: white; padding: 8px 20px; border-radius: 25px; text-decoration: none;
            font-weight: 600; font-size: 15px; transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn-selengkapnya:hover { transform: scale(1.05); }
        .spbe-aspek-section {
            display: flex; width: 100%; justify-content: space-between; align-items: flex-start; padding-top: 40px; background-color: #fff; flex-wrap: wrap;
        }
        .spbe-aspek-section h2 { font-size: 26px; margin-bottom: 22px; color: #1e293b; font-weight: bold; }
        .aspek-left { flex: 1 1 500px; }
        .aspek-kategori { display: flex; flex-direction: column; gap: 20px; }
        .aspek-item { display: flex; gap: 15px; align-items: flex-start; }
        .aspek-item i { font-size: 36px; color: #facc15; min-width: 40px; }
        .aspek-item strong { font-size: 18px; color: #1e293b; }
        .aspek-item p { margin: 5px 0 0; font-size: 16px; color: #334155; }
        .aspek-right img { width: 100%; max-width: 570px; height: auto; display: block; margin-top: 50px;}
        .berita-section { padding: 60px 0px; background-color: #fff; text-align: center; }
        .berita-section h2 { font-size: 28px; color: #2c3e50; margin-bottom: 40px; font-weight: bold; }
        .berita-section h2::after { content: ''; display: block; width: 120px; height: 4px; background-color: #facc15; margin: 10px auto 0; border-radius: 2px; }
        .berita-swiper-container {  max-width: 100%; padding-bottom: 40px; overflow: hidden; margin: 0 auto; }
        .berita-swiper-wrapper { display: flex; }
        .berita-swiper-slide {
            background: #ffffff; border-radius: 8px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); text-align: left; display: flex; flex-direction: column; height: auto; width: 380px; overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease, opacity 0.3s ease, width 0.3s ease;
        }
        .berita-swiper-slide:not(.swiper-slide-active) { opacity: 0.7; transform: scale(0.9); }
        .berita-swiper-slide-active { opacity: 1; transform: scale(1); }
        .berita-swiper-slide:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); }
        .berita-card-link { display: flex; flex-direction: column; height: 100%; text-decoration: none; color: inherit; }
        .berita-image-wrapper { width: 100%; height: 240px;  overflow: hidden; border-top-left-radius: 8px; border-top-right-radius: 8px; }
        .berita-swiper-slide img { width: 100%; height: 240px; object-fit: cover; display: block; transition: transform 0.3s ease; }
        .berita-swiper-slide:hover img { transform: scale(1.05); }
        .berita-content-wrapper { padding: 20px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; }
        .berita-title {
            font-size: 16px; font-weight: bold; color: #001e74; line-height: 1.3; overflow: hidden; text-overflow: ellipsis;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;
        }
        .berita-date { font-size: 13px; color: #777; display: flex; flex-wrap: wrap; gap: 10px; align-items: center; }
        .berita-date i { margin-right: 5px; color: #facc15; }
        .berita-section .berita-swiper-container .berita-navigation-wrapper { display: flex; justify-content: center; align-items: center; gap: 10px; position: absolute; bottom: 0px; left: 50%; transform: translateX(-50%); width: auto; z-index: 10; }
        .berita-section .berita-swiper-container .swiper-pagination.berita-swiper-pagination { position: static; width: auto; margin: 0; }
        .berita-section .berita-swiper-container .swiper-pagination-bullet { opacity: 0.8; background: #31353b; margin: 2px;}
        .berita-section .berita-swiper-container .swiper-pagination-bullet-active { background: #148cb8; }
        .berita-section .berita-swiper-container .berita-swiper-button-next,
        .berita-section .berita-swiper-container .berita-swiper-button-prev {
            position: static; margin-top: 0; transform: none; color: #444;
        }
        .berita-section .berita-swiper-container .berita-swiper-button-next .arrow-icon,
        .berita-section .berita-swiper-container .berita-swiper-button-prev .arrow-icon {
            font-size: 24px; color: #148cb8; text-shadow: none;
        }
        .evaluasi-section { padding: 30px 0; background-color: #fff; text-align: center; position: relative;}
        .evaluasi-section h2 { font-size: 26px; font-weight: bold; color: #2c3e50; position: relative; display: inline-block; }
        .evaluasi-section h2::after { content: ''; display: block; width: 100px; height: 4px; background-color: #facc15; margin: 10px auto 0; border-radius: 2px; }
        .evaluasi-swiper-container { width: 60%; max-width: 600px; margin: 40px auto 0; padding-bottom: 50px; overflow: hidden; }
        .evaluasi-swiper-slide {
            background-color: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2); overflow: hidden;
            transition: background-color: 0.3s ease-in-out; color: 0.3s ease-in-out; flex-direction: column; height: auto;
        }
        .evaluasi-swiper-slide:not(.swiper-slide-active) { opacity: 0.7; transform: scale(0.9); }
        .evaluasi-swiper-slide-active { opacity: 1; transform: scale(1); }
        .evaluasi-swiper-slide:hover { transform: translateY(-8px); box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15); }
        .evaluasi-card-link { text-decoration: none; color: inherit; display: flex; flex-direction: column; height: 100%; }
        .evaluasi-image-wrapper { position: relative; width: 100%; padding-top: 75%; overflow: hidden; border-top-left-radius: 10px; border-top-right-radius: 10px; }
        .evaluasi-image-wrapper img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease-in-out; }
        .evaluasi-swiper-slide:hover .evaluasi-image-wrapper img { transform: scale(1.05); }
        .evaluasi-image-wrapper .overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.6); display: flex; flex-direction: column; justify-content: center; align-items: center; opacity: 0; transition: opacity 0.3s ease-in-out;
        }
        .evaluasi-swiper-slide:hover .evaluasi-image-wrapper .overlay { opacity: 1; }
        .evaluasi-image-wrapper .overlay .tahun { font-size: 30px; font-weight: bold; color: #ecf0f1; margin-bottom: 15px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); }
        .evaluasi-section .evaluasi-swiper-container .evaluasi-swiper-button-next,
        .evaluasi-section .evaluasi-swiper-container .evaluasi-swiper-button-prev {
            background-image: none; background-size: 0; background-repeat: no-repeat; background-position: 0; margin-top: -16px;
            width: auto; height: auto; position: absolute; top: 60%; transform: translateY(-50%); z-index: 10; cursor: pointer;
        }
        .evaluasi-section .evaluasi-swiper-container .evaluasi-swiper-button-next::after,
        .evaluasi-section .evaluasi-swiper-container .evaluasi-swiper-button-prev::after {
            display: none;
        }
        .evaluasi-section .evaluasi-swiper-container .evaluasi-swiper-button-next .arrow-icon,
        .evaluasi-section .evaluasi-swiper-container .evaluasi-swiper-button-prev .arrow-icon {
            font-size: 32px; color: #facc15; text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }
        .evaluasi-section .evaluasi-swiper-container .evaluasi-swiper-button-prev { left: 18%; }
        .evaluasi-section .evaluasi-swiper-container .evaluasi-swiper-button-next { right: 18%; }
        .modal { display: none; position: fixed; z-index: 1000; padding-top: 30px; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.7); }
        .modal-content { margin: auto; display: block; max-width: 100%; border-radius: 10px; box-shadow: 0 0 20px rgba(255,255,255,0.2); }
        .custom-modal { display: none; position: fixed; z-index: 999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.7); overflow-y: auto; padding: 60px 0; }
        .custom-modal-content { background-color: #fff; margin: auto; border-radius: 10px; max-width: 100%; width: 800px; box-shadow: 0 8px 20px rgba(0,0,0,0.3); overflow: hidden; animation: fadeIn 0.3s ease-in-out; }
        .custom-modal-header { background-color: #1e3a8a; color: white; padding: 16px 24px; display: flex; justify-content: space-between; align-items: center }
        .custom-modal-body { padding: 24px; text-align: center; }
        .custom-modal-image { max-width: 100%; height: auto; border-radius: 6px; box-shadow: 0 4px 10px rgba(0,0,0,0.15); margin-bottom: 20px;} /* Added margin-bottom */
        .btn-close { background-color: #1e3a8a; color: white; border: none; padding: 8px 20px; border-radius: 6px; cursor: pointer; font-weight: 600; font-size: 14px; }
        .btn-close:hover { background-color: #3749b7; }
        .custom-close { font-size: 38px; cursor: pointer; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .document-section { margin-top: 20px; text-align: left; border-top: 1px solid #eee; padding-top: 20px; }
        .document-section .section-label { font-size: 18px; color: #2c3e50; margin-bottom: 15px; font-weight: bold; }
        .document-item { display: flex; align-items: center; background-color: #f9f9f9; border: 1px solid #ddd; border-radius: 8px; padding: 15px; margin-bottom: 10px; }
        .document-icon { font-size: 28px; color: #facc15; margin-right: 15px; }
        .document-details { flex-grow: 1; }
        .document-details .file-name { font-size: 16px; color: #333; margin: 0; word-break: break-all; }
        .btn-download {
            display: inline-flex; align-items: center; background-color: #007bff; color: white; padding: 8px 15px; border-radius: 5px;
            text-decoration: none; font-weight: 500; transition: background-color 0.3s ease, transform 0.2s ease
        }
        .btn-download i { margin-right: 8px; }
        .btn-download:hover { background-color: #0056b3; transform: scale(1.05);}
        .form-text { font-style: italic; }

        .aplikasi-section { padding: 60px 0px; background-color: #fff; text-align: center; }
        .aplikasi-section h2 { font-size: 28px; color: #2c3e50; margin-bottom: 40px; font-weight: bold; }
        .aplikasi-section h2::after { content: ''; display: block; width: 120px; height: 4px; background-color: #facc15; margin: 10px auto 0; border-radius: 2px; }
        .aplikasi-swiper-container { max-width: 100%; padding-bottom: 40px; overflow: hidden; margin: 0 auto }
        .aplikasi-swiper-wrapper { display: flex; }
        .aplikasi-swiper-slide {
            background: #fff; border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: left; display: flex; flex-direction: column; height: auto; width: 380px; overflow: hidden; transition: transform 0.3s ease, box-shadow 0.3s ease; opacity: 1;  transform: scale(1); 
        }
        .aplikasi-swiper-slide-active { opacity: 1; transform: scale(1); }
        .aplikasi-swiper-slide:hover {transform: translateY(-5px);  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); } 
.aplikasi-card-link { display: flex; flex-direction: column; height: 100%; text-decoration: none; color: inherit; }
.aplikasi-image-wrapper { width: 100%; height: 240px; overflow: hidden; border-top-left-radius: 8px; border-top-right-radius: 8px; display: flex; justify-content: center; align-items: center; padding: 10px; }
.aplikasi-swiper-slide img { max-width: 100%; max-height: 100%; object-fit: contain; display: block; transition: transform 0.3s ease; }
.aplikasi-swiper-slide:hover img {transform: scale(1.05) }
.aplikasi-content-wrapper { padding: 20px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; }
.aplikasi-title { font-size: 16px; font-weight: bold; color: #001e74; line-height: 1.3; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; margin-bottom: 10px; }
.aplikasi-description { font-size: 14px; color: #555; line-height: 1.4; overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; }
.aplikasi-section .aplikasi-swiper-container .aplikasi-navigation-wrapper { display: flex; justify-content: center; align-items: center; gap: 10px; position: absolute; bottom: 0px; left: 50%; transform: translateX(-50%); width: auto; z-index: 10; }
/* 
@media (max-width: 1024px) {
    .aplikasi-section { padding: 40px 0px; }
    .aplikasi-swiper-container { max-width: 960px; }
    .aplikasi-image-wrapper { height: 180px; }
    .aplikasi-title { font-size: 16px; -webkit-line-clamp: 3; }
}

@media (max-width: 767px) {
    .aplikasi-section { padding: 30px 0px; }
    .aplikasi-swiper-container { max-width: 720px; }
    .aplikasi-swiper-slide { padding: 0px; }
    .aplikasi-swiper-slide img { width: 100%; height: 140px; object-fit: cover; } 
    .aplikasi-image-wrapper { height: 180px; }
    .aplikasi-title { font-size: 15px; -webkit-line-clamp: 3; }
}

@media (max-width: 480px) {
    .aplikasi-section { padding: 40px 0px; }
    .aplikasi-swiper-container { max-width: 400px; }
    .aplikasi-image-wrapper { height: 120px; }
    .aplikasi-title { font-size: 14px; -webkit-line-clamp: 4; }
} */

        @media (max-width: 1024px) {
            .main .swiper-container { height: auto; padding-bottom: 30px; }
            .main .swiper-container .swiper-wrapper .swiper-slide { width: 80% !important; }
            .main .swiper-container .swiper-wrapper .swiper-slide .card-image img { height: auto;}
            .berita-section { padding: 40px 0px; }
            .berita-swiper-container { max-width: 960px; }
            .berita-image-wrapper { height: 180px; }
            .berita-title { font-size: 16px; -webkit-line-clamp: 3; }
            .evaluasi-section .evaluasi-swiper-container .evaluasi-swiper-button-next .arrow-icon,
            .evaluasi-section .evaluasi-swiper-container .evaluasi-swiper-button-prev .arrow-icon {
                font-size: 24px;
            }
            .evaluasi-section .evaluasi-swiper-container .evaluasi-swiper-button-prev { left: 10%; }
            .evaluasi-section .evaluasi-swiper-container .evaluasi-swiper-button-next { right: 10%; }
            .modal { width: 90%; height: 100%; margin: auto; top: 50%;}
            .modal-content { max-width: 90%; margin: auto;}
            .custom-modal-content { margin: auto; max-width: 100%; width: 700px;}
            .custom-modal-header h2 { font-size: 26px;}

        }
        @media (min-width: 768px) and (max-width: 1024px) {
            .main .swiper-container .swiper-wrapper .swiper-slide { width: 65% !important; }
        }
        @media (max-width: 767px) {
            .main .swiper-container { height: auto; padding-bottom: 30px; }
            .main .swiper-container .swiper-wrapper .swiper-slide { width: 80% !important;  }
            .main .swiper-container .swiper-wrapper .swiper-slide .card-image img { height: auto;}
            .berita-section { padding: 30px 0px; }
            .berita-swiper-container { max-width: 720px; }
            .berita-swiper-slide { padding: 0px; }
            .berita-swiper-slide img { width: 100%; height: 140px; object-fit: cover; display: block; transition: transform 0.3s ease; }
            .berita-image-wrapper { height: 180px; }
            .berita-title { font-size: 15px; -webkit-line-clamp: 3; }
            .modal { width: 90%; height: 100%; margin: auto; top: 50%;}
            .modal-content { max-width: 90%; margin: auto;}
            .custom-modal-content { margin: auto; max-width: 100%; width:700px;}
            .custom-modal-header h2 { font-size: 20px;}
        }
        @media (max-width: 480px) {
            .container { padding: 32px 16px; }
            .main .swiper-container .swiper-wrapper .swiper-slide { width: 95% !important; }
            .main .swiper-container .swiper-button-next,
            .main .swiper-container .swiper-button-prev { margin-top: -10px; }
            .main .swiper-container .swiper-button-next .arrow-icon,
            .main .swiper-container .swiper-container .swiper-button-prev .arrow-icon { font-size: 24px; }
            .berita-section { padding: 40px 0px; }
            .berita-swiper-container { max-width: 400px; }
            .berita-image-wrapper { height: 120px; }
            .berita-title { font-size: 14px; -webkit-line-clamp: 4; }
            .evaluasi-section .evaluasi-swiper-container .evaluasi-swiper-button-next .arrow-icon,
            .evaluasi-section .evaluasi-swiper-container .evaluasi-swiper-button-prev .arrow-icon {
                font-size: 24px;
            }
            .evaluasi-section .evaluasi-swiper-container .evaluasi-swiper-button-prev { left: 10%; }
            .evaluasi-section .evaluasi-swiper-container .evaluasi-swiper-button-next { right: 10%; }
            .modal { width: 90%; height: 100%; margin: auto; top: 50%;}
            .modal-content { max-width: 90%; margin: auto;}
            .custom-modal-content { margin: auto; max-width: 100%; width: 400px;}
            .custom-modal-header h2 { font-size: 20px;}
        }

        /* --- Best Practice Apps Section --- */
        .best-practice-section {
            padding: 80px 0; /* Tambah padding vertikal */
            background-color: #f8f9fa; /* Warna latar belakang lebih lembut */
            text-align: center;
        }

        .best-practice-section h2 {
            font-size: 36px; /* Ukuran font lebih besar */
            color: #2c3e50;
            margin-bottom: 50px; /* Jarak bawah lebih besar */
            font-weight: 700; /* Tebal */
            position: relative;
            display: inline-block;
            letter-spacing: 0.5px; /* Sedikit spasi antar huruf */
        }

        .best-practice-section h2::after {
            content: '';
            display: block;
            width: 80px; /* Lebar underline lebih pendek */
            height: 5px; /* Tebal underline */
            background-color: #facc15; /* Warna kuning stabil */
            margin: 15px auto 0; /* Posisi underline */
            border-radius: 3px;
        }

        /* Container untuk layout grid */
        .app-grid-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Responsif grid */
            gap: 30px; /* Jarak antar kartu */
            max-width: 1200px; /* Lebar maksimum container */
            margin: 0 auto; /* Tengah-tengah */
            padding: 0 20px; /* Padding samping untuk responsivitas */
        }

        .app-card {
            background: #ffffff;
            border-radius: 12px; /* Radius sudut lebih lembut */
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08); /* Shadow yang lebih halus */
            text-align: center;
            display: flex;
            flex-direction: column;
            padding: 30px; /* Padding internal kartu */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            color: inherit;
            height: 100%; /* Memastikan tinggi kartu sama */
        }

        .app-card:hover {
            transform: translateY(-10px); /* Efek angkat lebih jelas */
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15); /* Shadow lebih gelap saat hover */
        }

        .app-card img {
            width: 100px; /* Ukuran ikon tetap */
            height: 100px; /* Ukuran ikon tetap */
            margin: 0 auto 25px; /* Jarak bawah ikon */
            object-fit: contain;
            display: block;
            transition: transform 0.3s ease;
        }

        .app-card:hover img {
            transform: scale(1.08); /* Ikon membesar sedikit saat hover */
        }

        .app-card h3 {
            font-size: 22px; /* Ukuran judul lebih besar */
            font-weight: 700; /* Lebih tebal */
            color: #1a202c; /* Warna judul lebih gelap */
            line-height: 1.3;
            margin-bottom: 12px; /* Jarak bawah judul */
        }

        .app-card p {
            font-size: 15px; /* Ukuran deskripsi lebih besar */
            color: #555; /* Warna teks deskripsi */
            min-height: 45px; /* Memastikan tinggi deskripsi minimal */
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2; /* Batasi 2 baris */
            -webkit-box-orient: vertical;
        }

        /* Responsiveness for grid */
        @media (max-width: 768px) {
            .app-grid-container {
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); /* Kolom lebih rapat di tablet */
                gap: 20px;
            }
            .best-practice-section h2 {
                font-size: 30px;
            }
        }

        @media (max-width: 480px) {
            .app-grid-container {
                grid-template-columns: 1fr; /* Satu kolom di mobile */
                gap: 20px;
                padding: 0 15px;
            }
            .best-practice-section {
                padding: 50px 0;
            }
            .best-practice-section h2 {
                font-size: 26px;
                margin-bottom: 30px;
            }
            .app-card {
                padding: 25px;
            }
            .app-card img {
                width: 80px;
                height: 80px;
                margin-bottom: 20px;
            }
            .app-card h3 {
                font-size: 20px;
            }
            .app-card p {
                font-size: 14px;
            }
        }
        .app-carousel-nav {
            display: none;
        }

        /* Style for banner text overlay */
        .swiper-slide .banner-text-overlay {
            position: absolute; /* Posisikan teks secara absolut di atas gambar */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex; /* Gunakan flexbox untuk penataan teks */
            flex-direction: column; /* Teks akan tersusun vertikal */
            justify-content: center; /* Pusatkan teks secara vertikal */
            align-items: flex-start; /* Ratakan teks ke kiri */
            padding: 0 50px; /* Beri padding di sisi kiri dan kanan */
            color: white; /* Warna teks */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7); /* Efek bayangan agar teks lebih terbaca */
            text-align: left; /* Pastikan teks rata kiri */
            pointer-events: none; /* Agar klik pada teks tetap mengaktifkan link di belakangnya */
            z-index: 2; /* Pastikan teks di atas gambar */
        }

        .swiper-slide .banner-text-overlay h1 {
            font-size: 40px;
            margin-bottom: 40px;
            line-height: 1.2;
            font-weight: bold;
        }

        .swiper-slide .banner-text-overlay p {
            font-size: 18px; /* Ukuran font untuk paragraf */
            margin: 5px 0;
            line-height: 1.3;
        }

        /* Penyesuaian responsif untuk teks banner */
        @media (max-width: 1024px) {
            .swiper-slide .banner-text-overlay {
                padding: 0 40px;
            }
            .swiper-slide .banner-text-overlay h1 {
                font-size: 2.5em;
            }
            .swiper-slide .banner-text-overlay p {
                font-size: 1.4em;
            }
        }

        @media (max-width: 767px) {
            .swiper-slide .banner-text-overlay {
                padding: 0 25px;
            }
            .swiper-slide .banner-text-overlay h1 {
                font-size: 1.8em;
                margin-bottom: 5px;
            }
            .swiper-slide .banner-text-overlay p {
                font-size: 1em;
                margin: 2px 0;
            }
        }

        @media (max-width: 480px) {
            .swiper-slide .banner-text-overlay {
                padding: 0 15px;
            }
            .swiper-slide .banner-text-overlay h1 {
                font-size: 1.4em;
            }
            .swiper-slide .banner-text-overlay p {
                font-size: 0.8em;
            }
        }
    </style>
</head>
<body>
@section('navbar', true)
@extends('layouts.layout_user') {{-- Asumsi ini adalah blade layout Anda --}}

@section('content')
<main class="main">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            {{-- Main Banner Slides --}}

            <div class="swiper-slide">
                <a href="https://example.com/page3" target="_blank" class="card-link">
                    <div class="card-image"><img src="/asset/img/4.png" alt="Image Slider"></div>
                    <div class="banner-text-overlay">
                        <h1>Selamat Datang</h1>
                        <p>di website Sistem Pemerintahan</p>
                        <p>Berbasis Elektronik</p>
                        <p>Kota Bandar Lampung</p>
                    </div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="https://tauval.spbe.go.id/" target="_blank" class="card-link">
                    <div class="card-image"><img src="/asset/img/1.png" alt="Image Slider"></div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="https://example.com/page2" target="_blank" class="card-link">
                    <div class="card-image"><img src="/asset/img/2.png" alt="Image Slider"></div>
                </a>
            </div>
            <div class="swiper-slide">
                <a href="https://example.com/page3" target="_blank" class="card-link">
                    <div class="card-image"><img src="/asset/img/3.png" alt="Image Slider"></div>
                </a>
            </div>
            
        </div>
        <div class="swiper-button-next"><i class="fas fa-chevron-circle-right arrow-icon"></i></div>
        <div class="swiper-button-prev"><i class="fas fa-chevron-circle-left arrow-icon"></i></div>
    </div>
</main>
    {{-- InfoCard Section --}}
    <div class="spbe-info-section">
        <div class="info-card">
            <img src="{{ asset('asset/icon/regulasi.png') }}" alt="Regulasi" class="info-icon">
            <h3>Regulasi</h3>
            <p>SPBE akan menjadi platform untuk seluruh regulasi yang ada. Platform ini bermakna pada integrasi. Integrasi ini pada proses bisnis, mulai dari level mikro hingga makro.</p>
            <a href="{{ route('regulasi_index') }}" class="btn-selengkapnya">Selengkapnya</a>
        </div>
        <div class="info-card">
            <img src="{{ asset('asset/icon/tahapan.png') }}" alt="Tahapan SPBE" class="info-icon">
            <h3>Tahapan SPBE</h3>
            <p>Terbagi dalam Peta Rencana SPBE yaitu: Tahapan Rencana Strategis, Tahapan Pembangunan Fondasi SPBE, Tahapan Pengembangan SPBE, dan Inisiatif Strategis.</p>
            <a href="{{ route('tahapan_spbe') }}" class="btn-selengkapnya">Selengkapnya</a>
        </div>
        <div class="info-card">
            <img src="{{ asset('asset/icon/evaluasi.png') }}" alt="Kegiatan" class="info-icon">
            <h3>Evaluasi</h3>
            <p>Hasil evaluasi untuk mengetahui Indeks SPBE sebagai acuan untuk tingkat kematangan penerapan SPBE baik dalam kapabilitas proses maupun kapabilitas fungsi teknis.</p>
            <a href="#evaluasi-section" class="btn-selengkapnya">Selengkapnya</a>
        </div>
    </div>

    {{-- Aspek Section --}}
    <div class="spbe-aspek-section">
        <div class="aspek-left">
            <h2>Sistem Pemerintahan Berbasis Elektronik</h2>
            <div class="aspek-kategori">
                <div class="aspek-item">
                    <i class="far fa-handshake"></i>
                    <div>
                        <strong>Kebijakan SPBE</strong>
                        <p>Aspek 1 - Kebijakan Internal Tata Kelola SPBE</p>
                    </div>
                </div>
                <div class="aspek-item">
                    <i class="fas fa-network-wired"></i>
                    <div>
                        <strong>Tata Kelola SPBE</strong>
                        <p>Aspek 2 - Perencanaan Strategis SPBE<br>
                        Aspek 3 - Teknologi Informasi dan Komunikasi<br>
                        Aspek 4 - Penyelenggara SPBE</p>
                    </div>
                </div>
                <div class="aspek-item">
                    <i class="fas fa-clipboard-check"></i>
                    <div>
                        <strong>Manajemen SPBE</strong>
                        <p>Aspek 5 - Penerapan Manajemen SPBE<br>
                        Aspek 6 - Audit TIK</p>
                    </div>
                </div>
                <div class="aspek-item">
                    <i class="fas fa-headset"></i>
                    <div>
                        <strong>Layanan SPBE</strong>
                        <p>Aspek 7 - Layanan Pemerintah Berbasis Elektronik<br>
                        Aspek 8 - Layanan Publik Berbasis Elektronik</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="aspek-right">
            <img src="{{ asset('asset/img/walkot dan wakil walkot.png') }}" alt="Walikota dan Wakil Walikota">
        </div>
    </div>

    {{-- Berita Section --}}
    <div class="berita-section">
        <h2>Berita Terbaru</h2>
        <div class="berita-swiper-container">
            <div class="swiper-wrapper berita-swiper-wrapper">
                @forelse($beritas as $berita)
                    <div class="swiper-slide berita-swiper-slide">
                        <a href="{{ route('berita.show', $berita->id_berita) }}" class="berita-card-link">
                            <div class="berita-image-wrapper">
                                <img src="{{ asset('uploads/beritas/' . $berita->gambar) }}" alt="{{ $berita->judul }}">
                            </div>
                            <div class="berita-content-wrapper">
                                <h3 class="berita-title">{{ $berita->judul }}</h3>
                                <span class="berita-date"><i class="far fa-calendar-alt"></i> {{ $berita->created_at->format('d M Y') }}</span>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="berita swiper-slide berita-swiper-slide">
                        <p>Belum ada berita terbaru saat ini.</p>
                    </div>
                @endforelse
            </div>
           <div class="berita-navigation-wrapper">
                <div class="berita-swiper-button-prev"><i class="fas fa-chevron-circle-left arrow-icon"></i></div>
                <div class="swiper-pagination berita-swiper-pagination"></div>
                <div class="berita-swiper-button-next"><i class="fas fa-chevron-circle-right arrow-icon"></i></div>
            </div>
        </div>
    </div>

    {{-- Section Evaluasi --}}
    <div class="evaluasi-section" id="evaluasi-section">
        <h2>Hasil Evaluasi </h2>
        <div class="evaluasi-swiper-container">
            <div class="swiper-wrapper evaluasi-swiper-wrapper">
                @forelse($evaluations as $evaluation)
                    <div class="swiper-slide evaluasi-swiper-slide">
                        <a href="javascript:void(0);" class="evaluasi-card-link"
                        onclick="openModal('{{ asset('uploads/evaluasi/' . $evaluation->image) }}', '{{ $evaluation->title }}', '{{ $evaluation->document ? asset('admin/evaluasi/file/' . $evaluation->document) : '' }}', '{{ $evaluation->document ?? '' }}')">
                            <div class="evaluasi-image-wrapper">
                                <img src="{{ asset('uploads/evaluasi/' . $evaluation->image) }}" alt="{{ $evaluation->title }}">
                                <div class="overlay">
                                    <div class="tahun">
                                        {{ Str::of($evaluation->title)->match('/Tahun \d{4}/') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="swiper-slide evaluasi-swiper-slide">
                        <p>Belum ada hasil evaluasi terbaru saat ini.</p>
                    </div>
                @endforelse
            </div>
            <div class="evaluasi-swiper-button-next"><i class="fas fa-chevron-circle-right arrow-icon"></i></div>
            <div class="evaluasi-swiper-button-prev"><i class="fas fa-chevron-circle-left arrow-icon"></i></div>
        </div>
    </div>

    <div class="custom-modal" id="popupModal">
        <div class="custom-modal-content">
            <div class="custom-modal-header">
                <h2 id="modalTitle">Hasil Evaluasi</h2>
                <span class="custom-close" onclick="closeModal()">&times;</span>
            </div>
            <div class="custom-modal-body">
                <img id="modalImage" src="" alt="Evaluasi SPBE" class="custom-modal-image">
                <div class="document-section">
                    <h3 class="section-label">Dokumen Pendukung:</h3>
                    <div id="documentSectionContent">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="imageModal" class="modal" onclick="closeModal()">
        <span class="modal-close">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

    <div class="aplikasi-section">
        <h2>Aplikasi Pemerintah Kota</h2>
        <div class="aplikasi-swiper-container">
            <div class="swiper-wrapper aplikasi-swiper-wrapper">
                <div class="swiper-slide aplikasi-swiper-slide">
                    <a href="https://satudata.bandarlampungkota.go.id/" class="aplikasi-card-link" target="_blank" rel="noopener noreferrer">
                        <div class="aplikasi-image-wrapper">
                            <img src="{{ asset('asset/icon/logo-satu-data.svg') }}" alt="Satu-data">
                        </div>
                        <div class="aplikasi-content-wrapper">
                            <h3 class="aplikasi-title">Satu Data</h3>
                            <p class="aplikasi-description">Layanan Data Terbuka</p>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide aplikasi-swiper-slide">
                    <a href="https://jdih.bandarlampungkota.go.id/" class="aplikasi-card-link" target="_blank" rel="noopener noreferrer">
                        <div class="aplikasi-image-wrapper">
                            <img src="{{ asset('asset/icon/logo-jdih.png') }}" alt="JDIH">
                        </div>
                        <div class="aplikasi-content-wrapper">
                            <h3 class="aplikasi-title">JDIH</h3>
                            <p class="aplikasi-description">Jaringan Dokumentasi dan Informasi hukum</p>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide aplikasi-swiper-slide">
                    <a href="https://bandarlampungkota.go.id/new/egov.html" class="aplikasi-card-link" target="_blank" rel="noopener noreferrer">
                        <div class="aplikasi-image-wrapper">
                            <img src="{{ asset('asset/icon/logo-bandar-lampung.png') }}" alt="e-gov">
                        </div>
                        <div class="aplikasi-content-wrapper">
                            <h3 class="aplikasi-title">E-Goverment</h3>
                            <p class="aplikasi-description">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide aplikasi-swiper-slide">
                    <a href="https://spse.inaproc.id/bandarlampungkota/" class="aplikasi-card-link" target="_blank" rel="noopener noreferrer">
                        <div class="aplikasi-image-wrapper">
                            <img src="{{ asset('asset/icon/logo-spse.png') }}" alt="SPSE">
                        </div>
                        <div class="aplikasi-content-wrapper">
                            <h3 class="aplikasi-title">SPSE</h3>
                            <p class="aplikasi-description">Sistem Pengadaan Secara Elektronik</p>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide aplikasi-swiper-slide">
                    <a href="https://seribuwajah.bandarlampungkota.go.id/" class="aplikasi-card-link" target="_blank" rel="noopener noreferrer">
                        <div class="aplikasi-image-wrapper">
                            <img src="{{ asset('asset/icon/logo-seribu-wajah.png') }}" alt="CCTV">
                        </div>
                        <div class="aplikasi-content-wrapper">
                            <h3 class="aplikasi-title">CCTV Seribu Wajah</h3>
                            <p class="aplikasi-description">Sistem Monitoring CCTV</p>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide aplikasi-swiper-slide">
                    <a href="https://jdih.bandarlampungkota.go.id/" class="aplikasi-card-link" target="_blank" rel="noopener noreferrer">
                        <div class="aplikasi-image-wrapper">
                            <img src="{{ asset('asset/icon/logo-jdih.png') }}" alt="JDIH">
                        </div>
                        <div class="aplikasi-content-wrapper">
                            <h3 class="aplikasi-title">JDIH</h3>
                            <p class="aplikasi-description">Jaringan Dokumentasi dan Informasi hukum</p>
                        </div>
                    </a>
                </div>
                <div class="swiper-slide aplikasi-swiper-slide">
                    <a href="https://spse.inaproc.id/bandarlampungkota/" class="aplikasi-card-link" target="_blank" rel="noopener noreferrer">
                        <div class="aplikasi-image-wrapper">
                            <img src="{{ asset('asset/icon/logo-spse.png') }}" alt="SPSE">
                        </div>
                        <div class="aplikasi-content-wrapper">
                            <h3 class="aplikasi-title">SPSE</h3>
                            <p class="aplikasi-description">Sistem Pengadaan Secara Elektronik</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.esm.bundle.min.js"></script>
<script>
    // Main Banner Swiper
    var swiper = new Swiper(".swiper-container", {
        effect: 'coverflow', grabCursor: true, centeredSlides: true, slidesPerView: 'auto', loop: true, speed: 1000,
        coverflowEffect: { rotate: 30, stretch: 20, depth: 100, modifier: 1, slideShadows: true, },
        autoplay: { delay: 5000, disableOnInteraction: false },
        navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        breakpoints: {
            640: { slidesPerView: 'auto', spaceBetween: 10, },
            768: { slidesPerView: 'auto', spaceBetween: 15,},
            1024: { slidesPerView: 'auto', spaceBetween: 20, },
        }
    });

    // Berita Swiper
    var swiperBerita = new Swiper(".berita-swiper-container", {
        effect: 'coverflow', grabCursor: true, centeredSlides: true, slidesPerView:'auto', loop: true, speed: 1000,
        coverflowEffect: { rotate: 0, stretch: -40, depth: 100, modifier: 1, slideShadows: true, },
        autoplay: { delay: 5000, disableOnInteraction: false },
        pagination: { el: ".berita-swiper-pagination", clickable: true, },
        navigation: { nextEl: ".berita-swiper-button-next", prevEl: ".berita-swiper-button-prev" },
        breakpoints: {
            640: { slidesPerView: 1.5, spaceBetween: 5, },
            768: { slidesPerView: 1, spaceBetween: 15,},
            1024: { slidesPerView: 3, spaceBetween: 5, },
        }
    });

    // Evaluasi Swiper
    var swiperEvaluasi = new Swiper(".evaluasi-swiper-container", {
        effect: 'slide', grabCursor: true, centeredSlides: true, slidesPerView:'auto', loop: true, speed: 1000,
        autoplay: { delay: 5000, disableOnInteraction: false },
        slidesPerView: 1,
        spaceBetween: 20,
        pagination: { el: ".evaluasi-swiper-pagination", clickable: true, },
        navigation: { nextEl: ".evaluasi-swiper-button-next", prevEl: ".evaluasi-swiper-button-prev" },
        breakpoints: {
            640: { slidesPerView: 1, spaceBetween: 20, },
            768: { slidesPerView: 1, spaceBetween: 20,},
            1024: { slidesPerView: 1, spaceBetween: 20, },
        }
    });

    function openModal(imageSrc, title = "Hasil Evaluasi", documentUrl = '', documentName = '') {
        document.getElementById("modalImage").src = imageSrc;
        document.getElementById("modalTitle").innerText = title;

        const documentSectionContent = document.getElementById("documentSectionContent");
        if (documentUrl && documentName) {
            documentSectionContent.innerHTML = `
                <div class="document-item">
                    <div class="document-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="document-details">
                        <p class="file-name">${documentName}</p>
                    </div>
                    <a href="${documentUrl}" target="_blank" class="btn-download">
                        <i class="fas fa-download"></i> Lihat
                    </a>
                </div>
            `;
        } else {
            documentSectionContent.innerHTML = `<p class="form-text" style="color: var(--text-muted);">Tidak ada dokumen pendukung.</p>`;
        }

        document.getElementById("popupModal").style.display = "block";
    }

    function closeModal() {
        document.getElementById("popupModal").style.display = "none";
    }

    window.onclick = function(event) {
        const modal = document.getElementById("popupModal");
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }

    var swiperAplikasi = new Swiper(".aplikasi-swiper-container", {
        effect: 'coverflow', grabCursor: true, centeredSlides: true, slidesPerView:'auto', loop: true, speed: 1000,
        coverflowEffect: { rotate: 0, stretch: -40, depth: 100, modifier: 1, slideShadows: false, },
        autoplay: { delay: 6000, disableOnInteraction: false },
        pagination: { el: ".aplikasi-swiper-pagination", clickable: true, },
        navigation: { nextEl: ".aplikasi-swiper-button-next", prevEl: ".aplikasi-swiper-button-prev" },
        breakpoints: {
            640: { slidesPerView: 1.5, spaceBetween: 5, },
            768: { slidesPerView: 1, spaceBetween: 15,},
            1024: { slidesPerView: 3, spaceBetween: 5, },
        }
    });
</script>
@endpush
</body>
</html>