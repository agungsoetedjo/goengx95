@extends('layouts.main')

@section('content')
<div class="container">
    <div class="row">
        <div class="container mt-5">
            <h2 class="text-center">Data Tugas</h2>
            <button class="btn btn-success my-2" onclick="showForm()">Tambah Data</button>
            {{-- <table id="tugasTable" class="table table-bordered"> --}}
            <br>Keterangan Status : <input type=checkbox checked disabled> Selesai, <input type=checkbox disabled> = Belum Selesai <br>
            <table id="example" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="1">Judul</th>
                        <th scope="1">Status Tugas</th>
                        <th scope="1">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tugasTable"></tbody>           
            </table>
        </div>
    </div>
</div>

<!-- Form Modal -->
<div id="tugasModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="tugas_id">
                <input type="text" id="judul" class="form-control my-2" placeholder="Judul Tugas">
                Status Tugas : 
                <input type="checkbox" value="" id="status"> Selesai
            </div>
            <div class="modal-footer">
                <button id="saveTombol" onclick="savetugas()" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(() => loadtugas());

    function loadtugas() {
        $.get('/tugas/data', function(data) {
            let rows = '';
            data.forEach(tugas => {
                rows += `
                    <tr>
                        <td>${tugas.judul}</td>
                        <td><input type="checkbox" class="status" data-id="${ tugas.id }$" ${ tugas.status ? 'checked' : '' } disabled></td>
                        <td>
                            <button onclick="edittugas(${tugas.id})" class="btn btn-primary">Edit</button>
                            <button onclick="deletetugas(${tugas.id})" class="btn btn-danger">Hapus</button>
                        </td>
                    </tr>`;
            });
            $('#tugasTable').html(rows);
        });
    }

    function showForm() {
        $('#tugas_id').val('');
        $('#judul').val('');
        $('#status').is(":checked") ? 1 : 0;
        $('#tugasModal').modal('show');
        $('#modalTitle').text('Tambah Data');
        $('#saveTombol').text('Simpan');
    }

    function savetugas() {
        let id = $('#tugas_id').val();
        let data = {
            judul: $('#judul').val(),
            status: $('#status').is(":checked") ? 1 : 0,
            // status: $('#status').val(),
            _token: '{{ csrf_token() }}'
        };

        if (id) {
            $.post(`/tugas/update/${id}`, data, () => {
                $('#tugasModal').modal('hide');
                loadtugas();
            });
        } else {
            $.post('/tugas/store', data, () => {
                $('#tugasModal').modal('hide');
                loadtugas();
            });
        }
    }

    function edittugas(id) {
        $.get(`/tugas/edit/${id}`, function(data) {
            $('#tugas_id').val(data.id);
            $('#judul').val(data.judul);
            $("#status").prop("checked", data.status == 1); // Checkbox sesuai status
            $('#tugasModal').modal('show');
            $('#modalTitle').text('Edit Data');
            $('#saveTombol').text('Update');
        });
    }

    function deletetugas(id) {
        if (confirm("Yakin ingin menghapus?")) {
            $.ajax({
                url: `/tugas/destroy/${id}`,
                type: 'DELETE',
                data: { _token: '{{ csrf_token() }}' },
                success: () => loadtugas()
            });
        }
    }
</script>
@endsection