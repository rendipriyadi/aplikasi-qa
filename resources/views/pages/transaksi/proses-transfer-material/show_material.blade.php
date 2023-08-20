<table class="table table-bordered">
    <input type="hidden" name="id" id="id" value="{{ $trans_material->id }}">
    <tr>
        <th>No PP</th>
        <td>{{ isset($trans_material->check_material->inspection_material->material_submission->no_pp) ? $trans_material->check_material->inspection_material->material_submission->no_pp : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Jenis Material</th>
        <td>{{ isset($trans_material->check_material->jenis) ? $trans_material->check_material->jenis : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Sumber Material</th>
        <td>{{ isset($trans_material->check_material->sumber) ? $trans_material->check_material->sumber : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Metode Pemeriksaan</th>
        <td>
            @if ($trans_material->metode == 1)
                <span class="badge badge-success">{{ 'Pembuatan benda uji' }}</span>
            @elseif($trans_material->metode == 2)
                <span class="badge badge-danger">{{ 'Pendaftaran lab' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Jumlah Sampel</th>
        <td>{{ isset($trans_material->jumlah) ? $trans_material->jumlah : 'N/A' }}
            {{ isset($trans_material->satuan_id) ? $trans_material->satuan->name : 'N/A' }}
        </td>
    </tr>
    <tr>
        <th>Hasil Pemeriksaan</th>
        <td>
            @if ($trans_material->hasil == 1)
                <span class="badge badge-yellow">{{ 'Sesuai' }}</span>
            @elseif($trans_material->hasil == 2)
                <span class="badge badge-success">{{ 'Tidak Sesuai' }}</span>
            @else
                <span>{{ 'N/A' }}</span>
            @endif
        </td>
    </tr>
    <tr>
        <th>Created at</th>
        <td>{{ date('d-m-Y H:i', strtotime($trans_material->created_at)) ?? '' }}</td>
    </tr>
</table>
