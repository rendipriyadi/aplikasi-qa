<table class="table table-bordered">
    <input type="hidden" name="id" id="id" value="{{ $trans_tool->id }}">
    <tr>
        <th>No PP</th>
        <td>{{ isset($trans_tool->transfer_material->material_submission->no_pp) ? $trans_tool->transfer_material->material_submission->no_pp : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Jenis</th>
        <td>{{ isset($trans_tool->jenis) ? $trans_tool->jenis : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Jenis / Type</th>
        <td>{{ isset($trans_tool->type) ? $trans_tool->type : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Kapasitas</th>
        <td>{{ isset($trans_tool->kapasitas) ? $trans_tool->kapasitas : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Tahun</th>
        <td>{{ isset($trans_tool->tahun) ? $trans_tool->tahun : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Jumlah</th>
        <td>{{ isset($trans_tool->jumlah) ? $trans_tool->jumlah : 'N/A' }}
            {{ isset($trans_tool->satuan->name) ? $trans_tool->satuan->name : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Kondisi Alat</th>
        <td>
            @if ($trans_tool->kondisi == 1)
                <span class="badge badge-yellow">{{ 'Baik' }}</span>
            @elseif($trans_tool->kondisi == 2)
                <span class="badge badge-success">{{ 'Sedang' }}</span>
            @elseif($trans_tool->kondisi == 3)
                <span class="badge badge-danger">{{ 'Rusak' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Hasil Pemeriksaan</th>
        <td>
            @if ($trans_tool->hasil == 1)
                <span class="badge badge-yellow">{{ 'Sesuai' }}</span>
            @elseif($trans_tool->hasil == 2)
                <span class="badge badge-success">{{ 'Tidak Sesuai' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Created at</th>
        <td>{{ date('d-m-Y H:i', strtotime($trans_tool->created_at)) ?? '' }}</td>
    </tr>
</table>
