@extends('layouts.backend')

<!-- cropperjs scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>

@section('content')
    @headerimg()

    <!-- Page Content -->
    <div class="content">

        <div class="">

        <!-- Your Block -->
        <div class="block">

            <div class="block-header">
                <h3 class="block-title">Nieuwe student</h3>
            </div>

            <div class="block-content">

                <form class="" action="/students" method="post" enctype="multipart/form-data">
                    @csrf

                    @fieldabove(['name'=>'student_code', 'label'=>'Studentnummer', 'size'=>'2', 'required'=>'required' ])

                    @fieldabove(['name'=>'voornaam', 'label'=>'Voornaam', 'size'=>'3', 'required'=>'required'])
                    @fieldabove(['name'=>'tussenvoegsel', 'label'=>'Tussenvoegsel', 'size'=>'1'])
                    @fieldabove(['name'=>'achternaam', 'label'=>'Achternaam', 'size'=>'3', 'required'=>'required'])

                    <div class="form-group">
                        <label>Pasfoto</label>
                        <div class="container-img-avatar push">
                            <img class="img-avatar" id="img-avatar-preview" src="/media/avatars/avatar13.jpg" alt="">
                        </div>
                        <div class="custom-file">
                            <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                            <input type="file" class="custom-file-input js-custom-file-input-enabled" data-toggle="custom-file-input" id="avatar" name="avatar">
                            <label class="custom-file-label" for="avatar">Kies een nieuwe pasfoto</label>
                        </div>
                    </div>

                    @fieldabove(['name'=>'schedule_code', 'label'=>'Roostergroep', 'size'=>'2', 'required'=>'required'])

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Opslaan</button>
                    </div>


                </form>
            </div>

        </div>
        <!-- END Your Block -->

        </div>
    </div>
    <!-- END Page Content -->

@endsection

@section('js_after')

    <!-- preview file upload -->
    <script type="application/javascript">
        //var preview = document.getElementById('avatar-preview');
        var URL = window.URL || window.webkitURL;

        //var container = document.querySelector('.container-img-avatar');
        var image = document.getElementById('img-avatar-preview');

        var originalImageURL = image.src;
        var uploadedImageType = 'image/jpeg';
        var uploadedImageName = 'cropped.jpg';
        var uploadedImageURL;

        let cropper

        // Import image
        var inputImage = document.getElementById('avatar');
        if (URL) {
            inputImage.onchange = function () {
                var files = this.files;
                var file;

                if (image && files && files.length) {
                    file = files[0];

                    if (/^image\/\w+/.test(file.type)) {
                        uploadedImageType = file.type;
                        uploadedImageName = file.name;

                        if (uploadedImageURL) {
                            URL.revokeObjectURL(uploadedImageURL);
                        }

                        image.src = uploadedImageURL = URL.createObjectURL(file);
                        //delete existing instance
                        if(cropper) cropper.destroy()
                        //set with new image
                        cropper = new Cropper(image, {
                            aspectRatio: 4/4,
                            crop(event) {
                                let tImagePerson = cropper.getCroppedCanvas()
                                tImagePerson.style.borderRadius = "50%"
                                image.src = tImagePerson.toDataURL("image/jpg")
                            },
                        });
                        //inputImage.value = null;
                        console.log(inputImage.value);
                    } else {
                        window.alert('Please choose an image file.');
                    }
                }
            };
        } else {
            inputImage.disabled = true;
            inputImage.parentNode.className += ' disabled';
        }
    </script>

    <!-- Page JS Plugins -->
    <!--
        <script src="/js/plugins/cropperjs/cropper.min.js"></script>
    -->

    <!--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"
            integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY="
            crossorigin="anonymous"></script>
    -->

    <!-- Cropper JS Code -->
    {{--<script>--}}
        {{--function getRoundedCanvas(sourceCanvas, width, height) {--}}
            {{--var canvas = document.createElement('canvas');--}}
            {{--var context = canvas.getContext('2d');--}}
            {{--var width = width;--}}
            {{--var height = height;--}}

            {{--canvas.width = width;--}}
            {{--canvas.height = height;--}}
            {{--context.imageSmoothingEnabled = true;--}}
            {{--context.drawImage(sourceCanvas, 0, 0, width, height);--}}
            {{--context.globalCompositeOperation = 'destination-in';--}}
            {{--context.beginPath();--}}
            {{--context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI, true);--}}
            {{--context.fill();--}}
            {{--return canvas;--}}
        {{--}--}}

        {{--window.addEventListener('DOMContentLoaded', function () {--}}
            {{--var image = document.getElementById('js-img-cropper');--}}
            {{--var button = document.getElementById('button');--}}
            {{--var result32 = document.getElementById('result32');--}}
            {{--var result64 = document.getElementById('result64');--}}
            {{--var result128 = document.getElementById('result128');--}}
            {{--var croppable = false;--}}
            {{--var cropper = new Cropper(image, {--}}
                {{--aspectRatio: 1,--}}
                {{--viewMode: 1,--}}
                {{--ready: function () {--}}
                    {{--croppable = true;--}}
                {{--},--}}
            {{--});--}}

            {{--button.onclick = function () {--}}
                {{--console.log('entering button.onclick()');--}}

                {{--var croppedCanvas;--}}
                {{--var roundedCanvas;--}}
                {{--var roundedImage;--}}

                {{--if (!croppable) {--}}
                    {{--return;--}}
                {{--}--}}

                {{--// Crop--}}
                {{--croppedCanvas = cropper.getCroppedCanvas();--}}


                {{--// Round--}}
                {{--roundedCanvas32 = getRoundedCanvas(croppedCanvas,32,32);--}}
                {{--roundedCanvas64 = getRoundedCanvas(croppedCanvas,64,64);--}}
                {{--roundedCanvas128 = getRoundedCanvas(croppedCanvas,128,128);--}}

                {{--// Show--}}
                {{--roundedImage32 = document.createElement('img');--}}
                {{--roundedImage32.src = roundedCanvas32.toDataURL();--}}
                {{--roundedImage64 = document.createElement('img');--}}
                {{--roundedImage64.src = roundedCanvas64.toDataURL();--}}
                {{--roundedImage128 = document.createElement('img');--}}
                {{--roundedImage128.src = roundedCanvas128.toDataURL();--}}

                {{--result32.innerHTML = '';--}}
                {{--result32.appendChild(roundedImage32);--}}
                {{--result64.innerHTML = '';--}}
                {{--result64.appendChild(roundedImage64);--}}
                {{--result128.innerHTML = '';--}}
                {{--result128.appendChild(roundedImage128);--}}
            {{--};--}}
        {{--});--}}
    {{--</script>--}}
@endsection
