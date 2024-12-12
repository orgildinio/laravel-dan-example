<x-admin-layout>
    <div class="w-full mx-auto bg-white p-8">
        <h1 class="py-4 mb-2 mt-0 text-2xl font-medium leading-tight text-gray">Шинэ мэдээ нэмэх</h1>
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Гарчиг</label>
                <input type="text" name="title" id="title"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    value="{{ old('title') }}">
                @error('title')
                    <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="post_image" class="block mb-2 text-sm font-medium text-gray-900">Мэдээний зураг</label>
                <input type="file" name="post_image">
                @error('post_image')
                    <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="block mb-2 text-sm font-medium text-gray-900">Агуулга</label>
                <textarea name="content" id="content">{{ old('content') }}</textarea>
                @error('content')
                    <div class="text-red-500 text-sm mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Хадгалах</button>
        </form>
    </div>
</x-admin-layout>

<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.5.1/tinymce.min.js"
    integrity="sha512-8+JNyduy8cg+AUuQiuxKD2W7277rkqjlmEE/Po60jKpCXzc+EYwyVB8o3CnlTGf98+ElVPaOBWyme/8jJqseMA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    tinymce.init({
        selector: 'textarea#content',
        plugins: 'image code',
        toolbar: 'undo redo | link image | code | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
        /* enable title field in the Image dialog*/
        image_title: true,
        /* enable automatic uploads of images represented by blob or data URIs*/
        automatic_uploads: true,
        /*
          URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
          images_upload_url: 'postAcceptor.php',
          here we add custom filepicker only to Image dialog
        */
        file_picker_types: 'image',
        /* and here's our custom image picker*/
        file_picker_callback: function(cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            /*
              Note: In modern browsers input[type="file"] is functional without
              even adding it to the DOM, but that might not be the case in some older
              or quirky browsers like IE, so you might want to add it to the DOM
              just in case, and visually hide it. And do not forget do remove it
              once you do not need it anymore.
            */

            input.onchange = function() {
                var file = this.files[0];

                var reader = new FileReader();
                reader.onload = function() {
                    /*
                      Note: Now we need to register the blob in TinyMCEs image blob
                      registry. In the next release this part hopefully won't be
                      necessary, as we are looking to handle it internally.
                    */
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    /* call the callback and populate the Title field with the file name */
                    cb(blobInfo.blobUri(), {
                        title: file.name,
                        'data-zoom-image': blobInfo.blobUri() // Adds custom attribute
                    });
                };
                reader.readAsDataURL(file);
            };

            input.click();
        },
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
</script>
