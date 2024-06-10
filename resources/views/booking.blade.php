@extends('layouts.app')

@section('content')
<div class="page-title" data-aos="fade" style="background-image: url(assets/img/fotofor.jpg);">
    <div class="container position-relative">
      <h1>Booking</h1>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="{{ route('home') }}">Home</a></li>
          <li class="current">Booking</li>
        </ol>
      </nav>
    </div>
</div><!-- End Page Title -->
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Booking</div>
                <div class="card-body">
                    <form method="POST" action="{{route('store.booking')}}" id="bookingForm">
                        @csrf

                        <div class="form-group">
                            <label for="nama_peminjam">Nama Peminjam</label>
                            <input type="text" name="nama_peminjam" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="no_telepon">Nomor Telepon</label>
                            <input type="text" name="no_telepon" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_booking">Tanggal Booking</label>
                            <input type="date" name="tanggal_booking" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="jam_mulai">Jam Mulai</label>
                            <select name="jam_mulai" id="jam_mulai" class="form-control" required onchange="calculatePrice()">
                                @for ($i = 7; $i <= 23; $i++)
                                    @for ($j = 0; $j < 60; $j += 60)
                                        @php
                                            $time = sprintf('%02d', $i) . ':' . sprintf('%02d', $j);
                                        @endphp
                                        <option value="{{ $time }}">{{ $time }}</option>
                                    @endfor
                                @endfor
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="jam_selesai">Jam Selesai</label>
                            <select name="jam_selesai" id="jam_selesai" class="form-control" required onchange="calculatePrice()">
                                @for ($i = 7; $i <= 23; $i++)
                                    @for ($j = 0; $j < 60; $j += 60)
                                        @php
                                            $time = sprintf('%02d', $i) . ':' . sprintf('%02d', $j);
                                        @endphp
                                        <option value="{{ $time }}">{{ $time }}</option>
                                    @endfor
                                @endfor
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="total_price">Total Price</label>
                            <input type="text" name="total_price" id="total_price" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <p id="error_message" style="color:red; display:none;">Jam Mulai harus lebih awal dari Jam Selesai</p>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" id="submit_button" class="btn btn-primary mt-3">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('tanggal_booking').addEventListener('input', calculatePrice);
    document.getElementById('jam_mulai').addEventListener('change', calculatePrice);
    document.getElementById('jam_selesai').addEventListener('change', calculatePrice);

    function calculatePrice() {
        var startTime = document.getElementById('jam_mulai').value;
        var endTime = document.getElementById('jam_selesai').value;
        var startHour = parseInt(startTime.split(':')[0]);
        var endHour = parseInt(endTime.split(':')[0]);
        var pricePerHour = 50000;
        var errorMessage = document.getElementById('error_message');
        var submitButton = document.getElementById('submit_button');

        if (endHour <= startHour) {
            errorMessage.style.display = 'block';
            document.getElementById('total_price').value = '0.00';
            submitButton.disabled = true;
        } else {
            errorMessage.style.display = 'none';
            var totalPrice = (endHour - startHour) * pricePerHour;
            document.getElementById('total_price').value = totalPrice.toFixed(2);
            submitButton.disabled = false;
        }
    }
</script>

@endsection
