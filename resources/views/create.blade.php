@extends('layout.form-base')
@section('card-title', 'Buat Produk')
@section('card-body')
<div class="card-body">
    @include('layout.alert')
    <form method="POST" action="{{route('create')}}">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-6 no-margin-bottom">
                <label for="product-name">Nama Produk</label>
                <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="@if(old('nama_produk')){{old('nama_produk')}}@endif" placeholder="Nama Produk">
                @error('nama_produk')
                <div class="invalid-feedback" style="display: block">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-6 no-margin-bottom">
                <label for="harga">Harga</label>
                <input type="number" class="form-control" name="harga" id="harga" value="@if(old('harga')){{old('harga')}}@endif" placeholder="Harga Produk">
                @error('harga')
                <div class="invalid-feedback" style="display: block">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6 no-margin-bottom">
                <label for="kategori">Kategori</label>
                <input type="text" class="form-control" name="kategori" id="kategori" value="@if(old('kategori')){{old('kategori')}}@endif" placeholder="Kategori Produk">
                @error('kategori')
                <div class="invalid-feedback" style="display: block">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group col-md-6 no-margin-bottom">
                <label for="status">Status</label>
                <select class="form-control" name="status" id="status" required="">
                    <option value="bisa dijual" @if(old('status') and old('status') == 'bisa dijual') selected @endif>Bisa Dijual</option>
                    <option value="tidak bisa dijual" @if(old('status') and old('status') == 'tidak bisa dijual') selected @endif>Tidak Bisa Dijual</option>
                </select>
                @error('status')
                <div class="invalid-feedback" style="display: block">
                    {{$message}}
                </div>
                @enderror
            </div>
        </div>
        <br>
        <div style="text-align: right">
        <button type="submit" style="width: 30%" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
