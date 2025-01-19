<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sertifikat Penyelesaian</title>
    <style>
        @font-face {
            font-family: 'Gabarito';
            src: url('{{ public_path('fonts/Gabarito-Regular.woff2') }}') format('woff2'),
                 url('{{ public_path('fonts/Gabarito-Regular.woff') }}') format('woff');
            font-weight: normal;
            font-style: normal;
        }

        @page {
            margin: 0in;
            font-family: "Gabarito", sans-serif;
        }
        * {
            margin: 0;
            padding: 0;
            border-radius: 12px;
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 24px solid #4696E6;
            padding: 20px;
            border-radius: 14px;
        }
        .container {
            background: -webkit-linear-gradient(115deg, #FDFDFD 0%, rgba(253, 253, 253, 0.85) 56.1%, #FDFDFD 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            padding: 20px;
            position: relative;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .header td {
            padding: 10px;
            vertical-align: middle;
        }
        .badge {
            color: #167ee6;
            font-size: 21px;
            text-align: right;
            font-weight: 700;
        }
        .content {
            margin-top: 60px;
        }
        .content h1 {
            font-size: 48px;
            margin: 0;
            color: #167ee6;
            font-weight: 700;
        }
        .content p {
            color: #696B6C;
        }
        .decorative {
            margin-left: auto;
            text-align: right;
        }
        .content1 {
            font-size: 28px;
        }
        .content2,
        .content b {
            font-size: 21px;
        }
        .content b{
            font-weight: bold;
        }
        .sertif {
            display: inline;
        }
        .footer {
            text-align: center;
        }
        .footer p {
            color: #494C4D;
            font-size: 16px;
            font-family: 'Gabarito', sans-serif !important;
            font-weight: 600;
        }
        p.font-custome {
            font-family: 'Gabarito', sans-serif;
            color: #171A1B;
            font-size: 21px;
        }
    </style>
  </head>
  <body>
        <div class="container">
            <!-- Header -->
            <table class="header">
                <tr>
                    <td class="logo">
                        <img src="{{ public_path('media/logo.png') }}" alt="Logo">
                    </td>
                    <td class="badge">
                        <img src="{{ public_path('media/illustrations/badge.png') }}" alt="Badge">
                    </td>
                </tr>
            </table>

            <!-- Content -->
            <div class="content">
                <p class="content1">diberikan kepada</p>
                <h1>{{ $name }}</h1>
                <p class="content2">atas kelulusannya pada kelas</p>
                <p class="font-custome"><b>{{ $title }}</b></p>
            </div>

            <table style="margin-top: 13%;">
                <tr>
                    <td>
                        <!-- Footer -->
                        <div class="footer">
                            <p>23 Desember 2024</p>
                            <p><strong>Khafidha Sukma Dewi</strong></p>
                            <img src="{{ public_path('media/illustrations/ttd.png') }}" width="80" alt="Khafidha Sukma Dewi">
                            <p>CEO Pathify</p>
                        </div>
                    </td>
                    <td>
                        <!-- Decorative -->
                        <div class="decorative">
                            <img
                            src="{{ public_path('media/illustrations/certificate.png') }}"
                            alt="Decorative"
                            />
                        </div>
                    </td>
                </tr>
            </table>
        </div>
  </body>
</html>