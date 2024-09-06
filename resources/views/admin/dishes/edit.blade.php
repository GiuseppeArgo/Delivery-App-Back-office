@extends('layouts.admin')

@section('content')
    {{-- title --}}
    <h1 class=" mb-4 mt-5 text-center">Modifica piatto</h1>
    {{-- /title --}}

    {{-- container --}}
    <div class="form-container form-padding">

        {{-- btn-back-menu --}}
        <a href="{{ route('admin.dishes.index') }}" class="btn-action-form btn-left">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        {{-- btn-back-menu --}}



        {{-- @include('partials.errors') --}}

        {{-- form --}}
        <form action="{{ route('admin.dishes.update', ['dish' => $dish->slug]) }}" method="POST"
            class="d-flex flex-column gap-2" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="container">
                <div class="row">

                    {{-- Name --}}
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                        <label for="name" class="form-label mt-4">Nome piatto <span class="asterisco">*</span>
                            {{-- error message --}}
                            @error('name')
                                <span class="text-danger"> {{ $errors->first('name') }} </span>
                            @enderror

                            {{-- Error name unique --}}
                            @if (session('error'))
                                <span class="text-danger">{{ session('error') }}</span>
                            @endif
                            {{-- error message --}}

                        </label>

                        <input type="text" id="name" name="name"
                            class="form-control @error('name') is-invalid @enderror" minlength="3" maxlength="30"
                            value="{{ old('name', $dish->name) }}" placeholder="es. Carbonara" required>
                    </div>
                    {{-- /Name --}}

                    {{-- Availability --}}
                    <div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-3 align-self-end">
                        <label class="form-label">Disponibilità <span class="asterisco">*</span>

                            {{-- errors --}}
                            <span class="text-danger"> {{ $errors->first('visibility') }} </span>
                            {{-- /errors --}}

                        </label>
                        <div class="btn-group d-flex" role="group" aria-label="Disponibilità">
                            <input type="radio" name="visibility" id="active" value="1" class="btn-check"
                                {{ $dish->visibility == 1 ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary" for="active">Si</label>
                            <input type="radio" name="visibility" id="inactive" value="0" class="btn-check"
                                {{ $dish->visibility == 0 ? 'checked' : '' }}>
                            <label class="btn btn-outline-primary" for="inactive">No</label>
                        </div>
                    </div>
                    {{-- Availability --}}
                </div>
            </div>


            {{-- Description --}}
            <div class="container mb-3">
                <label for="description" class="form-label">Descrizione <span class="asterisco">*</span>

                    {{-- error message --}}
                    @error('description')
                        <span class="text-danger"> {{ $errors->first('description') }} </span>
                    @enderror
                    {{-- error message --}}

                </label>
                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                    minlength="5" maxlength="200" rows="5" placeholder="es. breve descrizione e ingredienti..." required>{{ old('description', $dish->description) }}</textarea>
            </div>
            {{-- Description --}}


            <div class="container">
                <div class="row">
                    {{-- Price --}}
                    <div class="col-12 col-sm-8 mb-3">
                        <label for="price" class="form-label">Prezzo <span class="asterisco">*</span>

                            {{-- error message --}}
                            @error('price')
                                <span class="text-danger"> {{ $errors->first('price') }} </span>
                            @enderror
                            {{-- /error message --}}

                        </label>
                        <input type="number" id="price" name="price"
                            class="form-control @error('price') is-invalid @enderror"
                            value="{{ old('price', $dish->price) }}" placeholder="es. 10.00" required min="3"
                            max="30" step="0.01">
                    </div>
                    {{-- /Price --}}

                    {{-- input file image --}}
                    <div class="col-12 col-sm-4 mb-3">
                        <label for="image" class="form-label">Immagine <span class="asterisco">*</span></label>
                        {{-- <input type="file" name="image" id="image"
                            class="form-control @error('image') is-invalid @enderror"> --}}

                        <!-- customize button -->
                        <button type="button" class="custom-file-upload btn btn-primary d-block">Scegli file</button>

                        <!--  hide Input file -->
                        <input class="form-control @error('image') is-invalid @enderror" type="file" name="image"
                            id="image" style="display:none;">

                    </div>
                    <span id="errorImage" class="text-danger"></span>
                    {{-- /input file image --}}

                </div>
            </div>



            {{-- old and new preview image --}}
            <div class="m-auto mt-3">
                <div class="mt-2 card-img">
                    @if (!empty($dish->image))
                        <img id="oldImg" src="{{ asset('storage/' . $dish->image) }}" alt="Old Image"
                            class="img-fluid mb-2 square-image">
                    @endif
                    <img id="imagePreview" class="hide mb-2 square-image" src="" alt="New Image Preview">


                    {{-- btn-remove --}}
                    <div class="flex-center mb-2">
                        <button id="btnDelete" class="hide" onclick="removeImage(event)">Rimuovi
                        </button>
                    </div>
                    {{-- /btn-remove --}}
                </div>
            </div>
            {{-- old and new preview image --}}


            {{-- button add --}}
            <div class="flex-center">
                <button class="btn btn-success m-0" type="submit">Aggiorna</button>
            </div>
            {{-- /button add --}}


            {{-- hide input --}}
            <input type="text" name="restaurant_id" class="hide" value="{{ $restaurant_id }}">
            <input type="text" name="oldname" class="hide" value="{{ $dish->name }}">
            {{-- hide input --}}

        </form>
        {{-- /form --}}
        <div class="mt-5">
            <span class="asterisco">*</span>
            <span class="field-required">
                questi campi sono obbligatori
            </span>
        </div>
    </div>

    <script>
        // {{-- javascript validation image --}}
        function validateImage(file) {
            return new Promise((resolve) => {
                // control extension image
                const allowedExtensions = ['jpg', 'jpeg', 'png'];
                const extension = file.name.split('.').pop().toLowerCase();
                if (!allowedExtensions.includes(extension)) {
                    resolve({
                        valid: false,
                        error: 'Tipo di file non valido.'
                    });
                    return;
                }

                // control size image
                const maxSize = 1024 * 1024 * 2; // max 2 MB
                if (file.size > maxSize) {
                    resolve({
                        valid: false,
                        error: 'Il file è troppo grande. Dimensione massima consentita: 2 MB.'
                    });
                    return;
                }
                resolve({
                    valid: true
                });
            });
        }

        // listen change to input file
        document.querySelector('#image').addEventListener('change', async function() {
            const file = this.files[0];
            const imgElem = document.getElementById("imagePreview");
            const oldImgElem = document.getElementById("oldImg");
            const errImg = document.getElementById("errorImage");
            const removeImg = document.getElementById("btnDelete");

            if (file) {
                const {
                    valid,
                    error
                    // wait return of function
                } = await validateImage(file);
                //if big image o invalid format reset input and hide image
                if (!valid) {
                    imgElem.src = "";
                    imgElem.classList.add('hide');
                    removeImg.classList.add('hide');
                    errImg.textContent = error;
                    this.value = '';
                } else {
                    // show img preview
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        imgElem.src = event.target.result;
                        imgElem.classList.remove('hide');
                    };
                    reader.readAsDataURL(file);

                    // show button remove image
                    removeImg.classList.remove('hide');
                    errImg.textContent = "";
                }
            } else {
                // hide preview if file dosn't exist
                imgElem.classList.add('hide');
                removeImg.classList.add('hide');
            }
        });

        //reset value when click remove image
        function removeImage(event) {
            event.preventDefault();
            const imageInput = document.querySelector('#image');
            const imagePreview = document.getElementById("imagePreview");
            const oldImage = document.getElementById("oldImg");
            const removeImgBtn = document.getElementById("btnDelete");
            imageInput.value = '';
            imagePreview.src = '';
            imagePreview.classList.add('hide');
            removeImgBtn.classList.add('hide');
            oldImage.classList.remove('hide');
        }

        // hide image to start
        document.addEventListener('DOMContentLoaded', function() {
            const imagePreview = document.getElementById("imagePreview");
            if (!imagePreview.src) {
                imagePreview.classList.add('hide');
            }
        });
        // {{-- /javascript validation image --}}

        // {{-- input file --}}
        document.addEventListener("DOMContentLoaded", function() {
            // Mostra l'input file quando l'utente clicca sul pulsante personalizzato
            document.querySelector('.custom-file-upload').addEventListener('click', function() {
                document.getElementById('image').click();
            });

            // Nasconde l'input file dopo che un file è stato selezionato
            document.getElementById('image').addEventListener('change', function() {
                this.style.display = 'none'; // Nasconde l'input file
            });
        });
        // {{-- input file --}}
    </script>
@endsection
