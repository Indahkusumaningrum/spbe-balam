<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('asset/img/logo.png') }}" type="image/png">
    <title>Regulasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .regulasi-container {
            max-width: 95%;
            margin: 40px auto;
            font-family: 'Poppins', sans-serif;
            padding: 0 20px;
        }

        .regulasi-container h1 {
            font-size: 28px;
            color: #001e74;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .regulasi-list-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .regulasi-card {
            position: relative;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            cursor: pointer;
            border: 1px solid #e0e0e0;
        }

        .regulasi-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 0%;
            width: 8px;
            background-color: #facc15;
            /* transition: height 0.3s ease; */
            display: none;
        }

        .regulasi-card.active::before {
            /* height: 100%; */
            display: block;
        }

        .regulasi-card-header {
            /* display: flex;
            align-items: center;
            padding: 18px 25px;
            background-color: #ffffff;
            font-size: 20px;
            font-weight: 600;
            color: #333;
            transition: background-color 0.3s ease;
            justify-content: space-between; */
            position: relative;
            padding: 18px 25px;
            background-color: #ffffff;
            font-size: 20px;
            font-weight: 600;
            color: #333;
            transition: background-color 0.3s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .regulasi-card-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 8px;
    background-color: #facc15;
    transition: opacity 0.3s ease;
}
/* Hide header bar when card is active to prevent overlap */
.regulasi-card.active .regulasi-card-header::before {
    opacity: 0;
}

        .regulasi-card-header:hover {
            background-color: #f9f9f9;
        }

        .regulasi-card.active .regulasi-card-header {
            background-color: #fcfcfc;
        }

        .regulasi-card-header h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 600;
            color: #333;
        }

        .regulasi-card-header i {
            font-size: 18px;
            color: #777;
            transition: transform 0.3s ease;
        }

        .regulasi-card.active .regulasi-card-header i {
            transform: rotate(180deg);
        }

        .regulasi-card-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease-out, padding 0.5s ease-out;
            padding: 0 25px;
        }

        .regulasi-card.active .regulasi-card-content {
            max-height: 1000px;
            padding: 20px 25px;
        }

        .regulasi-item-list {
            list-style: none;
            padding: 0;
            background-color: #ffffff;
            margin: 0;
        }

        .regulasi-item-list li {
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 16px;
            color: #555;
            border-bottom: 1px dashed #f0f0f0;
        }

        .regulasi-item-list li:last-child {
            border-bottom: none;
        }


        .regulasi-item-text {
            flex-grow: 1;
            text-align: left;
            color: black;
            text-decoration: none;
            margin-right: 15px;
            line-height: 1.4;
        }

        .download-link {
            color: #2563eb;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
        }

        .download-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .regulasi-container {
                margin: 30px auto;
                padding: 0 15px;
            }
            .regulasi-container h1 {
                font-size: 24px;
                margin-bottom: 20px;
            }
            .regulasi-card-header {
                padding: 15px 20px;
                font-size: 18px;
            }
            .regulasi-card-header h3 {
                font-size: 18px;
            }
            .regulasi-card-header i {
                font-size: 16px;
            }
            .regulasi-card.active .regulasi-card-content {
                padding: 15px 20px;
            }
            .regulasi-item-list li {
                font-size: 15px;
            }
            .download-link {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .regulasi-container h1 {
                font-size: 20px;
            }
            .regulasi-card-header {
                padding: 12px 15px;
                font-size: 16px;
            }
            .regulasi-card-header h3 {
                font-size: 16px;
            }
            .regulasi-card-header i {
                font-size: 14px;
            }
            .regulasi-card.active .regulasi-card-content {
                padding: 10px 15px;
            }
            .regulasi-item-list li {
                flex-direction: column;
                align-items: flex-start;
                font-size: 14px;
                padding: 8px 0;
                color: black;
            }
            .regulasi-item-text {
                width: 100%;
                margin-bottom: 8px;
                margin-right: 0;
            }
            .download-link {
                margin-left: 0;
                margin-top: 5px;
                align-self: flex-end;
            }
        }
    </style>
</head>
<body>

@extends('layouts.layout_user')
@section('navbar', true)
@section('content')

<div class="regulasi-container">
    <h1>Regulasi SPBE</h1>

    <div class="regulasi-list-container">
        @forelse ($regulations as $categoryName => $items)
            <div class="regulasi-card">
                <div class="regulasi-card-header">
                    <h3>{{ $categoryName }}</h3>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="regulasi-card-content">
                    <ul class="regulasi-item-list">
                        @foreach ($items as $item)
                            <li>
                                <span class="regulasi-item-text">{{ $item->content }}</span>
                                <a href="{{ route('admin.regulasi.file', $item->file_path) }}" class="download-link" target="_blank">DOWNLOAD</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @empty
            <p>Belum ada regulasi yang tersedia saat ini.</p>
        @endforelse
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const regulasiCards = document.querySelectorAll('.regulasi-card');

        regulasiCards.forEach(card => {
            const header = card.querySelector('.regulasi-card-header');
            const content = card.querySelector('.regulasi-card-content');

            header.addEventListener('click', () => {
                regulasiCards.forEach(otherCard => {
                    if (otherCard !== card && otherCard.classList.contains('active')) {
                        otherCard.classList.remove('active');
                        otherCard.querySelector('.regulasi-card-content').style.maxHeight = '0';
                    }
                });

                card.classList.toggle('active');
                if (card.classList.contains('active')) {
                    content.style.maxHeight = content.scrollHeight + 30 + 'px';
                } else {
                    content.style.maxHeight = '0';
                }
            });
        });
    });
</script>
@endpush

</body>
</html>
