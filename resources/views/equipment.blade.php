@extends('layouts.app')

@section('content')
<div class="page-title" data-aos="fade" style="background-image: url({{ asset('assets/img/fotofor.jpg') }});">
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

<div class="container my-4">
    <div class="card">
        <div class="card-header">Booking</div>
        <div class="card-body">
            <form method="POST" action="{{ route('storeEquipment', ['id' => $bookingId]) }}" id="bookingForm">
                @csrf

                <!-- Your existing form fields -->

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="tambahanCheckbox" name="tambahanCheckbox">
                        <label class="form-check-label" for="tambahanCheckbox">Tambahkan Tambahan</label>
                        <input type="hidden" name="booking_id" value="{{ $bookingId }}">
                    </div>
                </div>

                <!-- Tambahan fields -->
                <div id="tambahanFields" style="display: none;">
                    <div class="form-group">
                        <label for="equipment">Select Equipment</label>
                        <select name="equipment_id" id="equipment" class="form-control">
                            <option value="" hidden>Select Equipment</option>
                            @foreach($equipments as $equipment)
                                <option value="{{ $equipment->id }}" data-price="{{ $equipment->harga  }}">{{ $equipment->nama_equipment }}</option>
                            @endforeach
                        </select>                        
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" min="1" value="1">
                    </div>
                    <!-- Display total dynamically -->
                    <div class="form-group">
                        <p>Total: <span id="total"></span></p>
                    </div>
                </div>

                <!-- Your remaining form fields -->

                <div class="form-group">
                    <button type="submit" id="submit_button" class="btn btn-primary mt-3">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('tambahanCheckbox').addEventListener('change', function() {
        var tambahanFields = document.getElementById('tambahanFields');
        tambahanFields.style.display = this.checked ? 'block' : 'none';
    });

    // Function to calculate and display the total dynamically
    function calculateTotal() {
        var equipmentSelect = document.getElementById('equipment');
        var quantityInput = document.getElementById('quantity');
        var totalSpan = document.getElementById('total');

        var selectedOption = equipmentSelect.options[equipmentSelect.selectedIndex];
        var price = parseFloat(selectedOption.getAttribute('data-price'));
        var quantity = parseInt(quantityInput.value);

        var total = price * quantity;
        totalSpan.innerText = total.toFixed(2);
    }

    // Event listener for equipment selection change
    document.getElementById('equipment').addEventListener('change', calculateTotal);

    // Event listener for quantity input change
    document.getElementById('quantity').addEventListener('input', calculateTotal);
</script>

@endsection
