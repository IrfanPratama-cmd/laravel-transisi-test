@extends('layout.main')

@section('container')
<div class="card">
    <div class="card-body">
        <form action="/companies" method="post" class="mb-5" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
              <label for="company_name" class="form-label">Company Name</label>
              <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name"
              name="company_name" value="{{ old('company_name') }}"  required autofocus>
              @error('company_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
            name="email" value="{{ old('email') }}"  required autofocus>
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
            <label for="website" class="form-label">Website</label>
            <input type="text" class="form-control @error('website') is-invalid @enderror" id="name"
            name="website"  required autofocus>
            @error('website')
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
              <label for="image" class="form-label">Company Logo</label>
              <input type="hidden" name="oldImage">

                <img class="img-preview img-fluid mb-3 col-sm-5">
              <input class="form-control @error('logo') is-invalid @enderror" type="file" id="image" name="logo"
              onchange="previewImage()">
              @error('logo')
              <div class="invalid-feedback">
                  {{ $message }}
              </div>
              @enderror
          </div>
          <button type="submit" class="btn btn-primary">Create Company</button>
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

@endsection
