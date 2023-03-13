@extends('backend.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard / Kelola / Kelola Kelas /</span> Tambah
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Tambah Transaksi</h5>
                <div class="card-body">
                    <form class="forms-sample" action="{{ route('pembayaran.store') }}" method="POST"
                        enctype="multipart/form-data">

                        @csrf

                        <input name="no_transaksi" class="form-control" id="no_transaksi" readonly hidden>
                        <input name="id_unit" class="form-control" id="id_unit" value="{{ auth()->user()->id_unit }}"
                            readonly hidden>
                        <input name="id_unit_account" class="form-control" id="id_unit_account"
                            value="{{ auth()->user()->id }}" readonly hidden>

                        <div class="form-group mb-3">
                            <label for="id_rombel">Rombongan Belajar</label>
                            <select name="id_rombel" class="form-control" id="id_rombel" onclick="getKelas();getJenisTransactionSelected();">
                                <option>- Pilih Rombongan Belajar -</option>
                                @foreach ($getRombel as $item)
                                    <option value="{{ $item->id }}">{{ $item->rombongan_belajar }}</option>
                                @endforeach
                            </select>
                            @error('id_kelas')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="id_kelas">Kelas</label>
                            <select name="id_kelas" class="form-control dynamic" id="dropdownKelas" onclick="getSiswa();">
                                <option>- Pilih Kelas -</option>
                            </select>
                            @error('id_kelas')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="id_siswa">Siswa</label>
                            <select name="id_siswa" class="form-control" id="dropdownSiswa">
                                <option>- Pilih Siswa -</option>
                            </select>
                            @error('id_siswa')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="tanggal_transaksi">Tanggal Transaksi</label>
                            <input name="tanggal_transaksi" class="form-control" type="date" value="1999-11-17"
                                id="tanggal_transaksi" />
                            @error('tanggal_transaksi')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Repeater Form --}}
                        <hr class="my-5">
                        <div class="row">
                            <div class="form-group reapeat-pay-table">
                                <table class="table table-bordered table-responsive repeat-form-pay" id="dynamicAddRemove">
                                    <thead>
                                        <tr>
                                            <th>Jenis Transaksi</th>
                                            <th>Bulan</th>
                                            <th>Biaya</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <tr>
                                            <td>
                                                <div class="form-group mb-3">
                                                    <select name="jenis_transaksi_0" class="form-control"
                                                        id="jenis_transaksi_0" onclick="getValuesNumber(0);">
                                                        <option>- Pilih Jenis Transaksi -</option>
                                                        @foreach ($getJenis as $item)
                                                            <option value='{{$item->biaya_transaksi}}'>{{ $item->jenis_transaksi }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('jenis_transaksi')
                                                        <div class="alert alert-danger mt-2">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group mb-3">
                                                    <select name="transaksi_bulan" class="form-control" id="transaksi_bulan">
                                                        <option>- Pilih Bulan -</option>
                                                        <option value="1">Januari</option>
                                                        <option value="2">Februari</option>
                                                        <option value="3">Maret</option>
                                                        <option value="4">April</option>
                                                        <option value="5">Mei</option>
                                                        <option value="6">Juni</option>
                                                        <option value="7">Juli</option>
                                                        <option value="8">Agustus</option>
                                                        <option value="9">September</option>
                                                        <option value="10">Oktober</option>
                                                        <option value="11">November</option>
                                                        <option value="12">Desember</option>
                                                    </select>
                                                    @error('transaksi_bulan')
                                                        <div class="alert alert-danger mt-2">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </td>
                                            <td><input name="biaya" class="form-control" id="biaya_0"
                                                onclick="sumBiaya();" readonly></td>
                                            <th><a href="javascript:void(0)" class="btn btn-sm btn-danger deleteRow">-</a></th>
                                        </tr> --}}
                                    </tbody>
                                </table>
                                <div class="mt-2 align-right">
                                    <a href="javascript:void(0)" class="btn rounded-pill btn-sm btn-success addRow">Tambah</a>
                                </div>
                            </div>
                        </div>
                        <hr class="my-5">
                        {{-- End Repeat Pay Form --}}

                        <div class="form-group mb-3">
                            <label for="total">Total</label>
                            <input name="total" class="form-control" id="total" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="keterangan">Keterangan</label>
                            <select name="keterangan" class="form-control" id="keterangan">
                                <option>- Pilih -</option>
                                <option>Tunai</option>
                                <option>Transfer</option>
                            </select>
                            @error('keterangan')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Upload Bukti Transfer</label>
                            <div class="input-group col-xs-12">
                                <input type="file" class="form-control @error('bukti_transfer') is-invalid @enderror"
                                    name="bukti_transfer">
                                @error('bukti_transfer')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                        <a href="{{ route('kelas.index') }}" class="btn btn-light">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('jsAddmultiple')
<script type="text/javascript">
    var i = 0;
    $(".addRow").click(function () {
        ++i;

        fileinput = "<tr>"+
                    "<td>"+
                        "<div class='form-group mb-3'>"+
                            "<select name='jenis_transaksi["+i+"]' class='form-control' id='jenis_transaksi_"+i+"' onclick='getValuesNumber("+i+");sumBiaya();' onchange='sumBiaya();'>"+
                                // "<option>- Pilih Jenis Transaksi -</option>"+
                                // "@foreach ($getJenis as $item)"+
                                // "<option value='{{$item->biaya_transaksi}}'>{{ $item->jenis_transaksi }}</option>"+
                                // "@endforeach"+
                            "</select>"+
                            "@error('jenis_transaksi')"+
                            "<div class='alert alert-danger mt-2'>"+
                            "{{ $message }}"+
                            "</div>"+
                            "@enderror"+
                        "</div>"+
                    "</td>"+
                    "<td>"+
                        "<div class='form-group mb-3'>"+
                            "<select name='transaksi_bulan["+i+"]' class='form-control' id='transaksi_bulan'>"+
                                "<option>- Pilih Bulan -</option>"+
                                "<option value='1'>Januari</option>"+
                                "<option value='2'>Februari</option>"+
                                "<option value='3'>Maret</option>"+
                                "<option value='4'>April</option>"+
                                "<option value='5'>Mei</option>"+
                                "<option value='6'>Juni</option>"+
                                "<option value='7'>Juli</option>"+
                                "<option value='8'>Agustus</option>"+
                                "<option value='9'>September</option>"+
                                "<option value='10'>Oktober</option>"+
                                "<option value='11'>November</option>"+
                                "<option value='12'>Desember</option>"+
                            "</select>"+
                            "@error('transaksi_bulan')"+
                                "<div class='alert alert-danger mt-2'>"+
                                "{{ $message }}"+
                                "</div>"+
                            "@enderror"+
                        "</div>"+
                    "</td>"+
                    "<td><input name='biaya["+i+"]' class='form-control' id='biaya_"+i+"'></td>"+
                    "<th><a href='javascript:void(0)' class='btn rounded-pill btn-sm btn-danger remove-input-field'>-</a></th>"+
                "</tr>"
        $("#dynamicAddRemove").append(
            fileinput    );
            getJenisTransactionButton();

    });
    $(document).on('click', '.remove-input-field', function () {
        $(this).parents('tr').remove();
    });
//

function getSelectedOptionAttribute(select, attribute) {
    var selectedOption = select.options[select.selectedIndex];
    return selectedOption.getAttribute(attribute);
}

function getValuesNumber(id){
    var awal = '#jenis_transaksi_'+id;
    // // console.log(id);
    // // console.log(awal);
    // // console.log($(awal+' option:selected').val());
    // // console.log($(awal+' option:selected').text());
    dataPrice = $(awal+' option:selected').attr("data-price-"+id);
//     var select = document.getElementById(awal);
//   var dataPrice = getSelectedOptionAttribute(select, "data-price-"+id);
    $('#biaya_'+id).val(dataPrice);
}

function sumBiaya(){
    sumtotal = 0;
    cek = 0;
    // console.log(i);
    for (let a = 0; a <= i; a++) {
        // console.log($('#biaya_'+i).val());
        cek = 0;
        // console.log("log"+a+"= "+$('#biaya_'+a).val())
        if($('#biaya_'+a).val() !== undefined){
            console.log("tidak undefined")
            cek = parseInt($('#biaya_'+a).val());
        }
        sumtotal += cek;

    }
    // console.log(sumtotal);
    $('#total').val(sumtotal);
}

function minBiaya(){

}

function getJenisTransactionSelected(){
    console.log("Jalan");
    var nilaiId ='';
    nilaiId = $('#id_rombel option:selected').val();
    console.log(i);
  $.ajax({
    url: '/api/jenis/byIdRombel/'+nilaiId,
    type: 'GET',
    success: function(response) {
      // Parsing data from the API response
      var data = (response);
    //   console.log(data)
      for (var ilangOption = 0; ilangOption <= i; ilangOption++){
        $('#jenis_transaksi_'+ilangOption).empty();
    $('#jenis_transaksi_'+ilangOption).append('<option value="">-- Pilih Kelas --</option>');
      }
      // Iterating through the data and creating an option element for each item
      for (var nilaiawal = 0; nilaiawal <= i; nilaiawal++) {
        // console.log("JALAN LOOP")
        for (var awal = 0; awal < data.length; awal++) {
            var item = data[awal];
        var option = document.createElement('option');
        option.value = item["jenis_transaksi"];
        option.text = item["jenis_transaksi"];
        option.setAttribute("data-price-"+i,item["biaya_transaksi"]);
        // console.log("JALAN DATA");
        $('#jenis_transaksi_'+nilaiawal).append(option);
      }
      }
    }
  });
}

function getJenisTransactionButton(){
    console.log("Jalan Button");
    var nilaiId ='';
    nilaiId = $('#id_rombel option:selected').val();
    console.log(i);
  $.ajax({
    url: '/api/jenis/byIdRombel/'+nilaiId,
    type: 'GET',
    success: function(response) {
        $('#jenis_transaksi_'+i).empty();
        $('#jenis_transaksi_'+i).append('<option value="">- Pilih Jenis Transaksi -</option>');


      var data = (response);
        for (var awal = 0; awal < data.length; awal++) {
            var item = data[awal];
            var option = document.createElement('option');
            option.value = item["jenis_transaksi"];
            option.text = item["jenis_transaksi"];
            option.setAttribute("data-price-"+i,item["biaya_transaksi"]);
                    $('#jenis_transaksi_'+i).append(option);

        }
    }
  });
}




function getKelas() {
    // console.log("Jalan");
    var nilaiId ='';
    nilaiId = $('#id_rombel option:selected').val();

  $.ajax({
    url: '/api/kelas/byIdRombel/'+nilaiId,
    type: 'GET',
    success: function(response) {
    $('#dropdownKelas').empty();
    $('#dropdownKelas').append('<option value="">- Pilih Kelas -</option>');
      // Parsing data from the API response
      var data = (response);
      console.log(data)
      // Iterating through the data and creating an option element for each item
      for (var i = 0; i < data.length; i++) {
        var item = data[i];
        var option = document.createElement('option');
        option.value = item["id"];
        option.text = item["kelas"];
        $('#dropdownKelas').append(option);
      }
    }
  });
}

function getSiswa() {
    console.log("Jalan");
    var nilaiId ='';
    nilaiId = $('#dropdownKelas option:selected').val();

  $.ajax({
    url: '/api/siswa/byIdRombel/'+nilaiId,
    type: 'GET',
    success: function(response) {
    $('#dropdownSiswa').empty();
    $('#dropdownSiswa').append('<option value="">- Pilih Siswa -</option>');
      // Parsing data from the API response
      var data = (response);
      console.log(data)
      // Iterating through the data and creating an option element for each item
      for (var i = 0; i < data.length; i++) {
        var item = data[i];
        var option = document.createElement('option');
        option.value = item["id_siswa"];
        option.text = item["name"];
        $('#dropdownSiswa').append(option);
      }
    }
  });
}

    </script>
@endpush
