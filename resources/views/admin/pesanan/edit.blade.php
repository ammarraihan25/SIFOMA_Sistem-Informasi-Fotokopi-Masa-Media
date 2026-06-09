@extends('layouts.admin')

@section('title', 'Edit Pesanan: ' . $pesanan->kode_pesanan)

@section('content')
<div class="flex justify-between items-center mb-6">
    <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    <div class="flex items-center gap-3">
        <span class="text-sm font-bold text-muted">Status:</span>
        <span class="badge badge-{{ $pesanan->status_color }}">{{ $pesanan->status_label }}</span>
    </div>
</div>

<form action="{{ route('admin.pesanan.update', $pesanan->id) }}" method="POST" id="form-pesanan">
    @csrf
    @method('PUT')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Data Pelanggan -->
        <div class="lg:col-span-1">
            <div class="card">
                <div class="card-header">
                    <h3 class="font-bold"><i class="fas fa-user text-primary"></i> Data Pelanggan & Status</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="status" class="form-label">Status Pesanan <span class="text-red-500">*</span></label>
                        <select name="status" id="status" class="form-control font-bold" required>
                            <option value="antre" {{ (old('status', $pesanan->status) == 'antre') ? 'selected' : '' }}>Antre</option>
                            <option value="proses" {{ (old('status', $pesanan->status) == 'proses') ? 'selected' : '' }}>Sedang Diproses</option>
                            <option value="selesai" {{ (old('status', $pesanan->status) == 'selesai') ? 'selected' : '' }}>Selesai (Siap Diambil)</option>
                            <option value="diambil" {{ (old('status', $pesanan->status) == 'diambil') ? 'selected' : '' }}>Sudah Diambil</option>
                        </select>
                    </div>
                    <hr class="my-4 border-gray-100">
                    <div class="form-group">
                        <label for="nama_pelanggan" class="form-label">Nama Pelanggan <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" value="{{ old('nama_pelanggan', $pesanan->nama_pelanggan) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telepon" class="form-label">Nomor WhatsApp / Telepon</label>
                        <input type="text" name="no_telepon" id="no_telepon" class="form-control" value="{{ old('no_telepon', $pesanan->no_telepon) }}">
                    </div>
                    <div class="form-group">
                        <label for="catatan" class="form-label">Catatan Pesanan</label>
                        <textarea name="catatan" id="catatan" class="form-control" rows="3">{{ old('catatan', $pesanan->catatan) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Item -->
        <div class="lg:col-span-2">
            <div class="card mb-6">
                <div class="card-header flex justify-between items-center">
                    <h3 class="font-bold"><i class="fas fa-list text-primary"></i> Rincian Layanan</h3>
                    <button type="button" class="btn btn-sm btn-outline" id="btn-add-item">
                        <i class="fas fa-plus"></i> Tambah Item
                    </button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0" id="items-table">
                            <thead>
                                <tr class="bg-gray-50">
                                    <th width="40%">Layanan</th>
                                    <th width="20%">Harga (@)</th>
                                    <th width="15%">Jumlah</th>
                                    <th width="20%">Subtotal</th>
                                    <th width="5%"></th>
                                </tr>
                            </thead>
                            <tbody id="order-items">
                                @foreach($pesanan->items as $index => $item)
                                <tr class="item-row" data-raw-subtotal="{{ $item->subtotal }}">
                                    <td>
                                        <select name="items[{{ $index }}][layanan_id]" class="form-control select-layanan" required onchange="calculateRow(this)">
                                            <option value="">-- Pilih Layanan --</option>
                                            @foreach($layanans->groupBy('kategori_layanan_id') as $katId => $layanansList)
                                                <optgroup label="{{ $layanansList->first()->kategori->nama }}">
                                                    @foreach($layanansList as $layanan)
                                                        <option value="{{ $layanan->id }}" 
                                                                data-harga="{{ $layanan->harga }}" 
                                                                data-satuan="{{ $layanan->satuan }}"
                                                                {{ old("items.{$index}.layanan_id", $item->layanan_id) == $layanan->id ? 'selected' : '' }}>
                                                            {{ $layanan->nama }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                        <input type="text" name="items[{{ $index }}][keterangan]" class="form-control mt-2 text-sm" placeholder="Keterangan tambahan" value="{{ old("items.{$index}.keterangan", $item->keterangan) }}">
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="text-sm font-bold text-gray-500 mr-1">Rp</span>
                                            <input type="text" class="form-control border-0 bg-transparent p-0 text-right font-bold text-primary input-harga" readonly value="{{ number_format($item->harga_satuan, 0, '', '') }}">
                                        </div>
                                        <div class="text-xs text-muted text-right mt-1 span-satuan">/ {{ $item->layanan->satuan ?? '-' }}</div>
                                    </td>
                                    <td>
                                        <input type="number" name="items[{{ $index }}][jumlah]" class="form-control text-center input-jumlah" value="{{ old("items.{$index}.jumlah", $item->jumlah) }}" min="1" required onchange="calculateRow(this)" onkeyup="calculateRow(this)">
                                    </td>
                                    <td>
                                        <div class="input-group">
                                            <span class="text-sm font-bold text-gray-500 mr-1">Rp</span>
                                            <input type="text" class="form-control border-0 bg-transparent p-0 text-right font-bold text-gray-800 input-subtotal" readonly value="{{ number_format($item->subtotal, 0, '', '') }}">
                                        </div>
                                    </td>
                                    <td class="text-center align-middle">
                                        <button type="button" class="text-red-500 hover:text-red-700 btn-remove-item" onclick="removeRow(this)">
                                            <i class="fas fa-times-circle text-lg"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-gray-50">
                                    <td colspan="3" class="text-right font-bold text-lg">TOTAL BIAYA:</td>
                                    <td class="text-right">
                                        <div class="input-group justify-end">
                                            <span class="text-lg font-bold text-gray-500 mr-1">Rp</span>
                                            <input type="text" id="total_biaya_display" class="border-0 bg-transparent p-0 text-right font-black text-2xl text-primary w-full" readonly value="{{ number_format($pesanan->total_biaya, 0, '', '') }}">
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="text-right">
                <button type="submit" class="btn btn-primary btn-lg px-12 shadow-lg shadow-blue-500/30">
                    <i class="fas fa-save"></i> Perbarui Pesanan
                </button>
            </div>
        </div>
    </div>
</form>

<!-- Template for JS -->
<template id="row-template">
    <tr class="item-row border-t border-gray-100">
        <td>
            <select name="items[{INDEX}][layanan_id]" class="form-control select-layanan" required onchange="calculateRow(this)">
                <option value="">-- Pilih Layanan --</option>
                @foreach($layanans->groupBy('kategori_layanan_id') as $katId => $items)
                    <optgroup label="{{ $items->first()->kategori->nama }}">
                        @foreach($items as $layanan)
                            <option value="{{ $layanan->id }}" data-harga="{{ $layanan->harga }}" data-satuan="{{ $layanan->satuan }}">{{ $layanan->nama }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            <input type="text" name="items[{INDEX}][keterangan]" class="form-control mt-2 text-sm" placeholder="Keterangan tambahan (opsional)">
        </td>
        <td>
            <div class="input-group">
                <span class="text-sm font-bold text-gray-500 mr-1">Rp</span>
                <input type="text" class="form-control border-0 bg-transparent p-0 text-right font-bold text-primary input-harga" readonly value="0">
            </div>
            <div class="text-xs text-muted text-right mt-1 span-satuan">/ -</div>
        </td>
        <td>
            <input type="number" name="items[{INDEX}][jumlah]" class="form-control text-center input-jumlah" value="1" min="1" required onchange="calculateRow(this)" onkeyup="calculateRow(this)">
        </td>
        <td>
            <div class="input-group">
                <span class="text-sm font-bold text-gray-500 mr-1">Rp</span>
                <input type="text" class="form-control border-0 bg-transparent p-0 text-right font-bold text-gray-800 input-subtotal" readonly value="0">
            </div>
        </td>
        <td class="text-center align-middle">
            <button type="button" class="text-red-500 hover:text-red-700 btn-remove-item" onclick="removeRow(this)">
                <i class="fas fa-times-circle text-lg"></i>
            </button>
        </td>
    </tr>
</template>

@push('scripts')
<script>
    let rowIndex = {{ $pesanan->items->count() }};
    
    // Format number to IDR format
    const formatNumber = (num) => {
        return new Intl.NumberFormat('id-ID').format(num);
    };

    // Initialize formatting on load
    document.addEventListener('DOMContentLoaded', () => {
        // Format initial numbers
        document.querySelectorAll('.input-harga, .input-subtotal').forEach(input => {
            if(input.value) {
                input.value = formatNumber(input.value);
            }
        });
        const totalInput = document.getElementById('total_biaya_display');
        totalInput.value = formatNumber(totalInput.value);
        
        updateRemoveButtons();
    });

    // Calculate specific row
    window.calculateRow = function(element) {
        const row = element.closest('.item-row');
        const select = row.querySelector('.select-layanan');
        const inputJumlah = row.querySelector('.input-jumlah');
        const inputHarga = row.querySelector('.input-harga');
        const inputSubtotal = row.querySelector('.input-subtotal');
        const spanSatuan = row.querySelector('.span-satuan');
        
        const option = select.options[select.selectedIndex];
        
        if (option && option.value) {
            const harga = parseFloat(option.dataset.harga);
            const jumlah = parseInt(inputJumlah.value) || 0;
            const subtotal = harga * jumlah;
            
            inputHarga.value = formatNumber(harga);
            inputSubtotal.value = formatNumber(subtotal);
            spanSatuan.innerText = '/ ' + option.dataset.satuan;
            
            row.dataset.rawSubtotal = subtotal;
        } else {
            inputHarga.value = '0';
            inputSubtotal.value = '0';
            spanSatuan.innerText = '/ -';
            row.dataset.rawSubtotal = 0;
        }
        
        calculateTotal();
    };

    // Calculate grand total
    window.calculateTotal = function() {
        const rows = document.querySelectorAll('.item-row');
        let total = 0;
        
        rows.forEach(row => {
            total += parseFloat(row.dataset.rawSubtotal || 0);
        });
        
        document.getElementById('total_biaya_display').value = formatNumber(total);
    };

    // Remove row
    window.removeRow = function(btn) {
        const row = btn.closest('.item-row');
        row.remove();
        calculateTotal();
        updateRemoveButtons();
    };

    // Add new row
    document.getElementById('btn-add-item').addEventListener('click', function() {
        const template = document.getElementById('row-template').innerHTML;
        const newHtml = template.replace(/{INDEX}/g, rowIndex++);
        
        const tbody = document.getElementById('order-items');
        tbody.insertAdjacentHTML('beforeend', newHtml);
        
        updateRemoveButtons();
    });

    // Toggle remove buttons based on row count
    function updateRemoveButtons() {
        const rows = document.querySelectorAll('.item-row');
        const btns = document.querySelectorAll('.btn-remove-item');
        
        if (rows.length === 1) {
            btns[0].disabled = true;
            btns[0].style.opacity = '0.5';
            btns[0].style.cursor = 'not-allowed';
            btns[0].removeAttribute('onclick');
        } else {
            btns.forEach(btn => {
                btn.disabled = false;
                btn.style.opacity = '1';
                btn.style.cursor = 'pointer';
                if (!btn.getAttribute('onclick')) {
                    btn.setAttribute('onclick', 'removeRow(this)');
                }
            });
        }
    }
</script>
@endpush
@endsection
