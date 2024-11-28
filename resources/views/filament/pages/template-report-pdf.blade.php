<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        th {
            font-weight: 800;
            background-color: #93c5fd;
        }


        hr {
            border: none;
            height: 2px;
            background-color: black;
            margin: 20px 0;
        }

        .header {
            text-align: center;
        }

        .subHeader {
            text-align: center;
        }

        .laporan {
            text-align: center;
            font-size: 22px;
        }

        .footer {
            text-align: right;
            margin-top: 40px;
        }

        .signature {
            margin-right: 50px;
            margin-top: 4px;
            text-align: right;
        }
    </style>
</head>

<body>
    <h1 class="header">Pustakawan</h1>
    <p class="subHeader">Jln. Pustakawan No.27 Tasikmalaya</p>
    <p class="subHeader">No.Telp: (0265) 123456 | No.Whatsapp: 08123456789</p>
    <p class="subHeader">Website: https://pustakawan.id | Instagram: @pustakawan | Email: pustakawan@gmail.com</p>
    <hr />
    <h1 class="laporan">Laporan Peminjaman Buku</h1>
    <p>Tanggal : {{ $formattedDate }}</p>

    <table>
        <thead>
            <tr>
                <th>Buku</th>
                <th>Member</th>
                <th>Tanggal Peminjaman</th>
                <th>Rencana Tanggal Pengembalian</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($records as $record)
                <tr>
                    <td>{{ $record->book->title }}</td>
                    <td>{{ $record->member->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->date_loan)->translatedFormat('l, d F Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($record->date_due)->translatedFormat('l, d F Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Data tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="footer">
        Tasikmalaya, {{ $formattedDate }}
    </div>
    <div class="signature">
        Kepala Pustakawan
    </div>

</body>

</html>
