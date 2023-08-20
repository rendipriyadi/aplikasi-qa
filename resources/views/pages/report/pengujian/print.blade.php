<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan pengujian - QA</title>
</head>

<style type="text/css" media="print">
    @media print {
        @page {
            margin-top: 0;
            margin-bottom: 0;
            margin-left: 0;
            margin-right: 0;
        }

        body {
            padding-top: 3rem;
            padding-bottom: 3rem;
            padding-left: 2rem;
            padding-right: 2rem;
            font-family: 'Ubuntu', sans-serif;
            font-size: 12px;
        }
    }
</style>
<style>
    table {
        border-collapse: collapse;
    }

    tr.noBorder td {
        border: 0;
    }

    .brd {
        border: 0;
    }
</style>

<body onload="window.print();">
    <table border="1" width="100%">
        <thead>
            <tr>
                <th rowspan="3" width="20%"><img width='150px'
                        src="{{ asset('/assets/app-assets/images/logo/cmnplogo.png') }}">
                </th>
                <th align="left" colspan="5" class="brd" style="margin-left: 5px; margin-top: 10px;">PT. CITRA
                    MARGANUSAPALAPERSADA
                    Tbk.</th>
            </tr>
            <tr class="noBorder">
                <td align="left" colspan="5" style="margin-left: 5px;">DIVISI TEKNIK & QA</td>
            </tr>
            <tr>
                <th align="right" colspan="5" class="brd" style="font-size: 10px;">FR-TEK-02/01-002</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td align="center" colspan="6"
                    style="border-bottom: 0; font-weight: bold; font-size: 14px; height: 30px;">FORMULIR
                    DATA PEMERIKSAAN
                    MATERIAL,RAW
                    MATERIAL &
                    EQUIPMENT</td>
            </tr>
            <tr>
                <td align="center" colspan="6" class="brd"
                    style="font-size: 14px; font-weight: bold; height: 10px;">PEKERJAAN
                    {{ strtoupper($material_testing->material_submission->jenis_pekerjaan) }}</td>
            </tr>
            <tr style="font-size: 13px">
                <td style="border-right: 0; font-weight: bold;">Hari/Tgl Pengujian</td>
                <td style="border-left: 0; border-right: 0;">:</td>
                <td style="border-left: 0;">
                    {{ Carbon\Carbon::parse($material_testing->tgl_pengujian)->translatedFormat('l, d F Y') }}
                </td>
                <td style="border-right: 0; font-weight: bold;">Nomor Kontrak</td>
                <td style="border-left: 0; border-right: 0;">:</td>
                <td style="border-left: 0;">{{ $material_testing->material_submission->no_kontrak }}</td>
            </tr>
            <tr style="font-size: 12px">
                <td style="border-right: 0; font-weight: bold;">Lokasi / Work Shop</td>
                <td style="border-left: 0; border-right: 0;">:</td>
                <td style="border-left: 0;">{{ $material_testing->lokasi }}</td>
                <td style="border-right: 0; font-weight: bold;">Kontraktor Pelaksana</td>
                <td style="border-left: 0; border-right: 0;">:</td>
                <td style="border-left: 0;">{{ $material_testing->material_submission->vendor->name }}</td>
            </tr>
            <tr>
                <table border="1" width="100%">
                    <tr style="border-top: 0; font-weight: bold;">
                        <td align="center">A</td>
                        <td align="left" colspan="5">PENGUJIAN MATERIAL</td>
                    </tr>
                    <tr style="font-weight: bold;">
                        <td rowspan="10" style="border-bottom: 0;"></td>
                        <td align="left" style="width: 30%">Jenis Material</td>
                        <td align="center" style="width: 30%">Sumber Material</td>
                        <td align="center" style="width: 10%">Jumlah Sampel</td>
                        <td align="center" colspan="2" style="width: 30%">Hasil Pengujian</td>
                    </tr>
                    @foreach ($test_material as $test_material_item)
                        <tr>
                            <td align="left">
                                {{ $loop->iteration }}.
                                {{ $test_material_item->check_material->jenis }}
                            </td>
                            <td align="center">{{ $test_material_item->check_material->sumber }}</td>
                            <td align="center">
                                {{ $test_material_item->jumlah }}
                                {{ $test_material_item->satuan->name }}
                            </td>
                            <td align="left" colspan="2">
                                @if ($test_material_item->metode == 'Pengujian')
                                    &#128505
                                @else
                                    <input type="checkbox" style="width:10px;">
                                @endif
                                <label>{{ $test_material_item->metode }}</label>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td align="left" colspan="2">
                            <input type="checkbox" style="width:10px;">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td align="left" colspan="2">
                            <input type="checkbox" style="width:10px;">
                        </td>
                    </tr>
                    <tr>
                        <td style="border-bottom: 0;">Hasil Pengujian *</td>
                        <td style="border-bottom: 0;" colspan="4"> <label>:</label>
                            @if ($material_testing->status == 1)
                                &#128505
                            @elseif($material_testing->status == 2)
                                &#128503
                            @else
                                <input type="checkbox" style="width:10px;">
                            @endif
                            <label>
                                @if ($material_testing->status == 1)
                                    {{ 'Sesuai' }}
                                @elseif($material_testing->status == 2)
                                    {{ 'Tidak Sesuai' }}
                                @else
                                @endif
                            </label>
                        </td>
                    </tr>
                </table>
                <table border="1" width="100%">
                    <tr style="border-top: 0; font-weight: bold;">
                        <td align="center">B</td>
                        <td align="left" colspan="7">PENGUJIAN ALAT</td>
                    </tr>
                    <tr>
                        <td rowspan="10"></td>
                        <td align="left" style="width: 25%">Jenis Alat</td>
                        <td align="center">Jenis/Type</td>
                        <td align="center">Kapasitas</td>
                        <td align="center">Tahun</td>
                        <td align="center">Kondisi Alat *</td>
                        <td align="center">Jumlah</td>
                        <td align="center">Hasil Pengujian</td>
                    </tr>
                    @foreach ($test_tool as $test_tool_item)
                        <tr>
                            <td style="height: 20px">
                                {{ $loop->iteration }}.
                                {{ $test_tool_item->jenis }}
                            </td>
                            <td style="height: 20px">{{ $test_tool_item->type }}</td>
                            <td style="height: 20px">{{ $test_tool_item->kapasitas }}</td>
                            <td style="height: 20px" align="center">{{ $test_tool_item->tahun }}</td>
                            <td align="center" style="height: 20px">
                                @if ($test_tool_item->kondisi == 1)
                                    &#128505
                                    <label style="width:10px;">: B</label>
                                    <input type="checkbox" style="width:10px;"><label style="width:10px;">: S</label>
                                    <input type="checkbox" style="width:10px;"><label style="width:10px;">: R</label>
                                @elseif($test_tool_item->kondisi == 2)
                                    <input type="checkbox" style="width:10px;"><label style="width:10px;">: B</label>
                                    &#128505
                                    <label style="width:10px;">: S</label>
                                    <input type="checkbox" style="width:10px;"><label style="width:10px;">: R</label>
                                @elseif($test_tool_item->kondisi == 3)
                                    <input type="checkbox" style="width:10px;"><label style="width:10px;">: B</label>
                                    <input type="checkbox" style="width:10px;"><label style="width:10px;">: S</label>
                                    &#128505
                                    <label style="width:10px;">: R</label>
                                @else
                                    <input type="checkbox" style="width:10px;"><label style="width:10px;">: B</label>
                                    <input type="checkbox" style="width:10px;"><label style="width:10px;">: S</label>
                                    <input type="checkbox" style="width:10px;"><label style="width:10px;">: R</label>
                                @endif
                            </td>
                            <td style="height: 20px" align="center">
                                {{ $test_tool_item->jumlah }}
                                {{ isset($test_tool_item->satuan_id) ? $test_tool_item->satuan->name : '' }}
                            </td>
                            <td style="height: 20px">
                                @if ($test_tool_item->hasil == 1)
                                    &#128505
                                @elseif($test_tool_item->hasil == 2)
                                    &#128503
                                @else
                                    <input type="checkbox" style="width:10px;">
                                @endif
                                @if ($test_tool_item->hasil == 1)
                                    {{ 'Sesuai' }}
                                @elseif($test_tool_item->hasil == 2)
                                    {{ 'Tidak Sesuai' }}
                                @else
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td style="height: 20px"></td>
                        <td style="height: 20px"></td>
                        <td style="height: 20px"></td>
                        <td style="height: 20px"></td>
                        <td align="center" style="height: 20px">
                            <input type="checkbox" style="width:10px;"><label style="width:10px;">: B</label>
                            <input type="checkbox" style="width:10px;"><label style="width:10px;">: S</label>
                            <input type="checkbox" style="width:10px;"><label style="width:10px;">: R</label>
                        </td>
                        <td style="height: 20px"></td>
                        <td style="height: 20px"> <input type="checkbox" style="width:10px;">
                    </tr>
                    <tr>
                        <td style="height: 20px"></td>
                        <td style="height: 20px"></td>
                        <td style="height: 20px"></td>
                        <td style="height: 20px"></td>
                        <td align="center" style="height: 20px">
                            <input type="checkbox" style="width:10px;"><label style="width:10px;">: B</label>
                            <input type="checkbox" style="width:10px;"><label style="width:10px;">: S</label>
                            <input type="checkbox" style="width:10px;"><label style="width:10px;">: R</label>
                        </td>
                        <td style="height: 20px"></td>
                        <td style="height: 20px"> <input type="checkbox" style="width:10px;">
                    </tr>
                    <tr>
                        <td colspan="7" align="right" style="font-size: 9px;">*Ket = B : Baik, S : Sedang, R :
                            Rusak</td>
                    </tr>
                </table>
                <table border="1" width="100%" style="border-top: 0;">
                    <tr>
                        <td colspan="7" style="border-bottom: 0;">Catatan :</td>
                    </tr>
                    <tr>
                        <td width="30px" style="border-right: 0; border-bottom: 0;"></td>
                        <td colspan="5"
                            style="border-left: 0; border-right: 0; height: 20px; font-size: 14px; border-bottom: 0;">
                            {!! $material_testing->keterangan !!}
                        </td>
                        <td width="20px" style="border-left: 0; border-bottom: 0;"></td>
                    </tr>
                    <tr>
                        <td style="border-right: 0;"></td>
                        <td colspan="5" style="border-left: 0; border-right: 0; height: 20px"></td>
                        <td style="border-left: 0;"></td>
                    </tr>
                    <tr>
                        <td style="border-right: 0; border-top: 0; border-bottom: 0;"></td>
                        <td colspan="5" style="border-left: 0; border-right: 0; border-bottom: 0; height: 20px">
                        </td>
                        <td style="border-left: 0; border-bottom: 0;"></td>
                    </tr>
                    <tr>
                        <td style="border-right: 0; border-top: 0; border-bottom: 0;"></td>
                        <td align="center"
                            style="border-left: 0; border-right: 0; height: 20px; font-weight: bold; border-bottom: 0;">
                            Mengetahui,</td>
                        <td
                            style="border-left: 0; border-right: 0; height: 20px; font-weight: bold; border-bottom: 0;">
                        </td>
                        <td align="center"
                            style="border-left: 0; border-right: 0; height: 20px; font-weight: bold; border-bottom: 0;">
                            Diperiksa,</td>
                        <td
                            style="border-left: 0; border-right: 0; height: 20px; font-weight: bold; border-bottom: 0;">
                        </td>
                        <td align="center"
                            style="border-left: 0; border-right: 0; height: 20px; font-weight: bold; border-bottom: 0;">
                            Dibuat,</td>
                        <td style="border-left: 0; border-bottom: 0;"></td>
                    </tr>
                    <tr>
                        <td style="border-right: 0; border-top: 0; border-bottom: 0;"></td>
                        <td align="center" style="border-left: 0; border-right: 0; height: 20px; border-bottom: 0;">
                            Kadep <i>Quality
                                Assurance</i></td>
                        <td style="border-left: 0; border-right: 0; height: 20px; border-bottom: 0;"></td>
                        <td align="center" style="border-left: 0; border-right: 0; height: 20px; border-bottom: 0;">
                            Kasi <i>Quality
                                Assurance</i></td>
                        <td style="border-left: 0; border-right: 0; height: 20px; border-bottom: 0;"></td>
                        <td align="center" style="border-left: 0; border-right: 0; height: 20px; border-bottom: 0;">
                            Staf <i>Quality
                                Assurance</i></td>
                        <td style="border-left: 0; border-bottom: 0;"></td>
                    </tr>
                    <tr>
                        <td style="border-right: 0; border-top: 0; border-bottom: 0;"></td>
                        <td colspan="5" style="border-left: 0; border-right: 0; border-bottom: 0; height: 20px">
                        </td>
                        <td style="border-left: 0; border-bottom: 0;"></td>
                    </tr>
                    <tr>
                        <td style="border-right: 0; border-top: 0; border-bottom: 0;"></td>
                        <td colspan="5" style="border-left: 0; border-right: 0; border-bottom: 0; height: 20px">
                        </td>
                        <td style="border-left: 0; border-bottom: 0;"></td>
                    </tr>
                    <tr>
                        <td style="border-right: 0; border-top: 0; border-bottom: 0;"></td>
                        <td colspan="5" style="border-left: 0; border-right: 0; border-bottom: 0; height: 20px">
                        </td>
                        <td style="border-left: 0; border-bottom: 0;"></td>
                    </tr>
                    <tr>
                        <td style="border-right: 0; border-top: 0; border-bottom: 0;"></td>
                        <td style="border-left: 0; border-right: 0; height: 20px;"></td>
                        <td style="border-left: 0; border-right: 0; height: 20px; border-bottom: 0;"></td>
                        <td style="border-left: 0; border-right: 0; height: 20px;"></td>
                        <td style="border-left: 0; border-right: 0; height: 20px; border-bottom: 0;">
                        <td style="border-left: 0; border-right: 0; height: 20px;">
                        </td>
                        <td style="border-left: 0; border-bottom: 0;"></td>
                    </tr>
                    <tr>
                        <td style="border-right: 0; border-top: 0; border-bottom: 0;"></td>
                        <td align="center" style="border-left: 0; border-right: 0; height: 20px;">Yusri Nur, SE, ST
                        </td>
                        <td width="30px" style="border-left: 0; border-right: 0; height: 20px;"></td>
                        <td align="center" style="border-left: 0; border-right: 0; height: 20px;">Indra Mulyadi</td>
                        <td width="30px" style="border-left: 0; border-right: 0; height: 30px;"></td>
                        <td align="center" style="border-left: 0; border-right: 0; height: 20px;">
                            {{ $material_testing->created_by }}
                        </td>
                        <td style="border-left: 0; border-bottom: 0;"></td>
                    </tr>
                </table>
                <table border="0" width="100%" style="border-top: 0; margin-top: 20px;">
                    <tr>
                        <td style="margin-top: 0; top: 0; width: 120px;">*Keterangan :</td>
                        <td style="width: 120px;">- Hasil Pengujian</td>
                        <td>:</td>
                        <td>
                            &#128505<label>: Sesuai</label>
                            &#128503<label>: Tidak Sesuai</label>
                        </td>
                    </tr>
                </table>
            </tr>
        </tbody>
    </table>
</body>

</html>
