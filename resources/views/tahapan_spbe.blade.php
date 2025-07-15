<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="{{ asset('asset/img/logo.png') }}" type="image/png">
  <title>Tahapan SPBE</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    .progress-container {
        padding: 60px 60px;
        font-family: 'Poppins', sans-serif;
        background-color: #f9fafb;
        text-align: center;
    }

    .progress-title {
        font-size: 32px;
        font-weight: 700;
        color: #001e74;
        margin-bottom: 60px;
    }

    .timeline-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 90px 90px;
        max-width: 1000px;
        margin: 0 auto;
        position: relative;
        height: 400px;
    }

    /* .timeline-step, .timeline-selesai {
    background-color: white;
    padding: 0;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    perspective: 1000px;
    height: 180px;
}

.timeline-inner {
    position: relative;
    width: 100%;
    height: 100%;
    transition: transform 0.6s ease;
    transform-style: preserve-3d;
    border-radius: 16px;
}

.timeline-step:hover .timeline-inner,
.timeline-selesai:hover .timeline-inner {
    transform: rotateY(180deg);
}

.timeline-front, .timeline-back {
    position: absolute;
    width: 100%;
    height: 100%;
    padding: 24px;
    box-sizing: border-box;
    border-radius: 16px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    backface-visibility: hidden;
    transition: background-color 0.4s ease, color 0.4s ease;
}

.timeline-front {
    color: #333;
}

.timeline-back {
    background-color: #facc15;
    color: white;
    transform: rotateY(180deg);
}

.timeline-front .timeline-icon,
.timeline-back .timeline-icon {
    font-size: 36px;
    margin-bottom: 12px;
}

.timeline-front .timeline-icon {
    color: #facc15;
}

.timeline-back .timeline-icon {
    color: white;
}

.timeline-label {
    font-size: 20px;
    font-weight: 600;
    text-align: center;
} */

    .timeline-step, .timeline-selesai {
        background-color: white;
        padding: 24px;
        border-radius: 16px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .timeline-step:hover {
        transform: translateY(-5px);
        color: white;
        background-color: #facc15;
    }

.timeline-step:hover .timeline-icon i,
.timeline-selesai:hover .timeline-icon i {
    color: white;
}

    .timeline-selesai:hover {
        transform: translateY(-5px);
        color: white;
        background-color: #facc15;
    }

    .timeline-icon {
        font-size: 36px;
        color: #facc15;
        margin-bottom: 12px;
    }

    .timeline-label {
        font-size: 20px;
        font-weight: 600;
        color: rgb(61, 61, 61);
    }

    /* Garis horizontal */
    .timeline-step:not(:nth-child(3n))::after {
        content: '';
        position: absolute;
        top: 50%;
        right: -90px;
        width: 90px;
        height: 5px;
        background-color: #facc15;
        z-index: 0;
    }

    .timeline-step:nth-child(3)::before{
        content: '';
        position: absolute;
        bottom: -90px;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 90px;
        background-color: #facc15;
        z-index: 0;
    }

    .timeline-step:nth-child(4)::before{
        content: '';
        position: absolute;
        bottom: -133px;
        left: 50%;
        transform: translateX(-50%);
        width: 4px;
        height: 133px;
        background-color: #facc15;
        z-index: 0;
    }

    .timeline-selesai:not(:nth-child(3n))::after {
        content: '';
        position: absolute;
        top: 50%;
        left: -295px;
        width: 400px;
        height: 5px;
        background-color: #facc15;
        z-index: 0;
    }


    .timeline-finish {
        margin-top: 60px;
        display: flex;
        justify-content: center;
        position: relative;
    }

    .timeline-finish .timeline-selesai {
        background-color: white;
        background-color: #facc15;
    }

    .timeline-finish .timeline-icon {
        color: white;
    }
  </style>
</head>
<body>
@section('navbar', true)
@extends('layouts.layout_user')
@section('content')
<div class="progress-container">
    <h1 class="progress-title">Informasi Progress Tahapan Evaluasi</h1>

    <div class="timeline-grid">
        <div class="timeline-step">
            <div class="timeline-inner">
                <div class="timeline-front">
                    <div class="timeline-icon"><i class="fas fa-user-check"></i></div>
                    <div class="timeline-label">1. Penilaian Dokumen</div>
                </div>
            </div>
        </div>

        <div class="timeline-step">
            <div class="timeline-inner">
                <div class="timeline-front">
                    <div class="timeline-icon"><i class="fas fa-file-alt"></i></div>
                    <div class="timeline-label">2. Penilaian Dokumen</div>
                </div>
            </div>
        </div>

        <div class="timeline-step">
            <div class="timeline-icon"><i class="fas fa-microphone-alt"></i></div>
            <div class="timeline-label">3. Penilaian Interviu</div>
        </div>
        <div class="timeline-step">
            <div class="timeline-icon"><i class="fas fa-check-circle"></i></div>
            <div class="timeline-label">6. Final</div>
        </div>
        <div class="timeline-step">
            <div class="timeline-icon"><i class="fas fa-handshake"></i></div>
            <div class="timeline-label">5. Harmonisasi</div>
        </div>
         <div class="timeline-step">
            <div class="timeline-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div class="timeline-label">4. Penilaian Visitasi</div>
        </div>
    </div>

    <div class="timeline-finish">
        <div class="timeline-selesai">
            <div class="timeline-icon"><i class="fas fa-flag-checkered"></i></div>
            <div class="timeline-label">7. Selesai</div>
        </div>
    </div>
</div>

@endsection
</body>
</html>
