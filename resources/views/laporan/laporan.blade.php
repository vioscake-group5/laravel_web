@extends('main')
@section('konten')
<h3>Laporan Vioscake</h3>

<div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
    <table id="laporanTable" class="table table-bordered">
        <thead class="table-active" style="position: sticky; top: 0; z-index: 1;">
            <tr>
                <th>No</th>
                <th>Base Cake</th>
                <th>Jenis Kue</th>
                <th>Tanggal Pesan</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Vanilla</td>
                <td>Kue Lapis</td>
                <td>2024-05-01</td>
                <td>Rp 5.000.000</td>
                <td>Selesai</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Chocolate</td>
                <td>Kue Nastar</td>
                <td>2024-05-02</td>
                <td>Rp 2.250.000</td>
                <td>Selesai</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Butter</td>
                <td>Kue Putri Salju</td>
                <td>2024-05-03</td>
                <td>Rp 1.250.000</td>
                <td>Selesai</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Red Velvet</td>
                <td>Kue Red Velvet</td>
                <td>2024-05-04</td>
                <td>Rp 2.400.000</td>
                <td>Dalam Proses</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Mascarpone</td>
                <td>Kue Tiramisu</td>
                <td>2024-05-05</td>
                <td>Rp 3.600.000</td>
                <td>Selesai</td>
            </tr>
        </tbody>
    </table>
</div>

<button id="exportButton" class="btn btn-primary mt-3">
    <i class="fas fa-download fa-sm text-white-50"></i>
    Export</button>

@endsection

@section('variables')
<script>
    document.getElementById('exportButton').addEventListener('click', function() {
        var wb = XLSX.utils.table_to_book(document.getElementById('laporanTable'), {sheet: "Laporan"});
        XLSX.writeFile(wb, 'Laporan_Bisnis_Kue.xlsx');
    });
</script>
@endsection