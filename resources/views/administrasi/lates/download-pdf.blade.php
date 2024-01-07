<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Surat Keterlambatan</title>
    <style>
        #back-wrap {
            margin: 30px auto 0 auto;
            width: 500px;
            display: flex;
            justify-content: flex-end;
        }

        .btn-back {
            width: fit-content;
            padding: 8px 15px;
            color: #fff;
            background: #666;
            border-radius: 5px;
            text-decoration: none;
        }

        #receipt {
            box-shadow: 5px 10px 15px rgba(0, 0, 0, 0.5);
            padding: 20px;
            margin: 30px auto 0 auto;
            width: 500px;
            background: #FFF;
        }

        h2 {
            font-size: .9rem;
        }

        p {
            font-size: .8rem;
            color: #666;
            line-height: 1.2rem;
        }

        #top {
            margin-top: 25px;
        }

        #top .info {
            text-align: left;
            margin: 20px 0;
        }

        table {
            margin-left: auto;
            margin-right: auto; 
        }

        td {
            border: none;
            text-align: center;
            padding-left: 40px;
            padding-right: 40px;
        }

        .tabletitle {
            font-size: .5rem;
            background: #EEE;
        }

        .service {
            border-bottom: 1px solid #EEE;
        }

        .itemtext {
            font-size: .7rem;
        }

        #legalcopy {
            margin-top: 15px;
        }

        .btn-print {
            float: right;
            color: #333;
        }
    </style>
</head>

<body>
    <div id="receipt">
        <center>
            <div class="info">
                <h2>Surat Pernyataan</h2><br>
                <h2>Tidak Akan Datang Terlambat Sekolah</h2>
            </div>
        </center>
        <p>Yang bertanda tangan dibawah ini:</p>
        <div id="mid">
            <div class="info">
                @if ($lates instanceof \Illuminate\Database\Eloquent\Collection)
                    @foreach ($lates as $late)
                        <p>
                            NIS : {{ $late->student->nis }}<br>
                            Nama : {{ $late->student->name }}<br>
                            Rombel : {{ json_decode($late->student->rombel)->rombel ?? 'N/A' }}<br>
                            Rayon : {{ json_decode($late->student->rayon)->rayon ?? 'N/A' }}
                        </p>
                    @endforeach
                @else
                    <p>
                        NIS : {{ $lates->student->nis }}<br>
                        Nama : {{ $lates->student->name }}<br>
                        Rombel : {{ json_decode($lates->student->rombel)->rombel ?? 'N/A' }}<br>
                        Rayon : {{ json_decode($lates->student->rayon)->rayon ?? 'N/A' }}
                    </p>
                    <p>Dengan ini menyatakan bahwa saya telah melakukan pelanggaran tata tertib sekolah, yaitu terlambat
                        datang ke sekolah sebanyak <b>3 kali</b> yang mana hal tersebut termasuk kedalam pelanggaran
                        kedisiplinan. Saya berjanji tidak akan terlambat datang ke sekolah lagi. Apabila saya terlambat
                        datang ke sekolah lagi saya siap diberikan sanksi yang sesuai dengan peraturan sekolah.</p><br>
                    <p>Demikian surat pernyataan terlambat ini saya buat dengan penuh penyesalan.</p>


                @endif
            </div>
        </div>

        <div class="ttd">
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <table>
                <tr>
                    <td></td>
                    <td>Bogor, 24 November 2023</td>
                </tr>
                <tr>
                    <td>Peserta Didik,
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        ({{ $lates->student->name }})
                        <br>
                        <br>
                        <br>
                    </td>
                    <td>
                        Orang Tua/Wali Peserta Didik,
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        (.............)
                        <br>
                        <br>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td> Pembimbing Siswa,
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        ({{ json_decode($lates->student->rayon->user)->name ?? 'N/A' }})
                    </td>
                    <td>
                        Kesiswaan,
                        <br>
                        <br>
                        <br>
                        <br>
                        <br>
                        (.............)
                    </td>
                </tr>

            </table>
        </div>
    </div>
</body>

</html>
