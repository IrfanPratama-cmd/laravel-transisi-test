@extends('layout.main')

@section('container')
<div class="card">
    <div class="card-body">
        <form action="/employees" method="post" class="mb-5" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
              <label for="employee_name" class="form-label">Employee Name</label>
              <input type="text" class="form-control @error('employee_name') is-invalid @enderror" id="employee_name"
              name="employee_name" value="{{ old('employee_name') }}"  required autofocus>
              @error('employee_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
          </div>
          <div class="mb-3">
            <label for="employee_code" class="form-label">Employee Code</label>
            <input type="text" class="form-control @error('employee_code') is-invalid @enderror" id="employee_code"
            name="employee_code" value="{{ old('employee_code') }}"  required autofocus>
            @error('employee_code')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="company" class="form-label">Company</label>
            <div class="input-group">
                <select class="form-select" name="company_id" id="company">
                    <option selected disabled>Select Company</option>
                    @foreach ($company as $c)
                        <option value="{{ $c->id }}">{{ $c->company_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="division" class="form-label">Division</label>
            <div class="input-group">
                {{-- <select class="form-select" name="division_id" id="example-select">
                    <option selected disabled>Select Division</option>
                        @foreach ($division as $d)
                            <option value="{{ $d->id }}">{{ $d->division_name }}</option>
                        @endforeach
                </select> --}}
                <select class="form-select" name="division_id" id="division">
                    <option selected disabled>Select Division</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="position" class="form-label">Position</label>
            <div class="input-group">
                {{-- <select class="form-select" name="position_id" id="example-select">
                    <option selected disabled>Select position</option>
                        @foreach ($position as $p)
                            <option value="{{ $p->id }}">{{ $p->position_name }}</option>
                        @endforeach
                </select> --}}
                <select class="form-select" name="position_id" id="position">
                    <option selected disabled>Select Position</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="name"
            name="email"  required autofocus>
            @error('email')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="number" class="form-control @error('phone_number') is-invalid @enderror" id="name"
            name="phone_number"  required autofocus>
            @error('phone_number')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="entry_date" class="form-label">Entry Date</label>
            <input type="date" class="form-control @error('entry_date') is-invalid @enderror" id="name"
            name="entry_date"  required autofocus>
            @error('entry_date')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control @error('address') is-invalid @enderror" id="name"
            name="address"  required autofocus>
            @error('address')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
            @enderror
          </div>
          <div class="mb-3">
              <label for="image" class="form-label">Employee Image</label>
              <input type="hidden" name="oldImage">

                <img class="img-preview img-fluid mb-3 col-sm-5">
              <input class="form-control @error('asset') is-invalid @enderror" type="file" id="image" name="asset"
              onchange="previewImage()">
              @error('asset')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror
          </div>
          <button type="submit" class="btn btn-primary">Create Employee</button>
        </form>
      </div>
</div>




  <script>

    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFREvent){
        imgPreview.src = oFREvent.target.result;
        }
    }
    </script>

<script>
    $(document).ready(function () {
        $('#company').change(function () {
            var company_id = $(this).val();

            // Make an AJAX request to get divisions and positions
            $.ajax({
                type: "GET",
                url: "/get-division-and-position",
                data: {company_id: company_id},
                dataType: "json",
                success: function (data) {
                    // Update the Division dropdown
                    var divisionDropdown = $('#division');
                    divisionDropdown.empty();
                    divisionDropdown.append('<option selected disabled>Select Division</option>');
                    $.each(data.divisions, function (id, division) {
                        divisionDropdown.append('<option value="' + division.id + '">' + division.division_name + '</option>');
                    });

                    // Update the Position dropdown
                    var positionDropdown = $('#position');
                    positionDropdown.empty();
                    positionDropdown.append('<option selected disabled>Select Position</option>');
                    $.each(data.positions, function (id, position) {
                        positionDropdown.append('<option value="' + position.id + '">' + position.position_name + '</option>');
                    });
                }
            });
        });
    });
</script>

@endsection
