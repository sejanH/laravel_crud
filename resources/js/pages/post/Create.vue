<template>
  <div class="container">
    <div class="row mt-3">
      <div class="col-lg-7 col-md-8 col-sm-6">
        <input type="file" name="image" ref="image" hidden />
        <label for="title" class="form-label">* Post Title</label>
        <input
          class="form-control"
          name="title"
          type="text"
          placeholder="Post Title"
          required
          v-model="post.title"
        />

        <label for="" class="form-label">* Post Body</label>
        <editor
          v-model="post.body"
          api-key="zs41zzjg5lt0tepdy0d36hq3gvxxjz30xw80uuqs74mxwydv"
          :plugins="tinyMCE.plugins"
          :toolbar="tinyMCE.toolbar"
          :init="tinyMCE.myInit"
        />
      </div>
      <div class="col-lg-5 col-md-4 col-sm-6">

        <label for="" class="form-label">Post Cover Image</label><br/>
        <small>Click on the light blue area to open file manager</small>
        <upload-image
          is="upload-image"
          :url="forms.images_upload_url"
          :max_files="1"
          name="forms.files[]"
          :resize_enabled="true"
          :resize_max_width="640"
          :button_class="'btn btn-info'"
          :disable_upload="true"
          v-on:upload-image-success="uploadImageSuccess"
          v-on:upload-image-loaded="uploadImageLoaded"
          v-on:upload-image-submit="uploadImageSubmit"
          v-on:upload-image-clicked="uploadImageClicked"
          v-on:upload-image-removed="uploadImageRemoved"
        >
          Note That this image uploads separately. Make sure you press upload
          button before saving your post
        </upload-image>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CreatePost",
  data: function () {
    return {
      tinyMCE: {
        plugins: [
          "advlist autolink lists link image charmap print preview anchor",
          "searchreplace visualblocks code fullscreen",
          "insertdatetime media table paste code wordcount",
        ],
        toolbar:
          "undo redo | formatselect | bold italic backcolor | link image code| \
           alignleft aligncenter alignright alignjustify | \
           bullist numlist outdent indent | removeformat",
        myInit: {
          branding: false,
          height: 400,
          menubar: true,
          forced_root_block: "div",
          file_picker_types: "image",
          automatic_uploads: true,
          images_upload_url: "postAcceptor.php",
          images_upload_base_path: "/../../public/images",
          convert_urls: true,
          images_upload_handler: function (
            blobInfo,
            success,
            failure,
            progress
          ) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open("POST", "postAcceptor.php");

            xhr.upload.onprogress = function (e) {
              progress((e.loaded / e.total) * 100);
            };

            xhr.onload = function () {
              var json;

              if (xhr.status === 403) {
                failure("HTTP Error: " + xhr.status, { remove: true });
                return;
              }

              if (xhr.status < 200 || xhr.status >= 300) {
                failure("HTTP Error: " + xhr.status);
                return;
              }

              json = JSON.parse(xhr.responseText);

              if (!json || typeof json.location != "string") {
                failure("Invalid JSON: " + xhr.responseText);
                return;
              }

              success(json.location);
            };

            xhr.onerror = function () {
              failure(
                "Image upload failed due to a XHR Transport error. Code: " +
                  xhr.status
              );
            };

            formData = new FormData();
            formData.append("file", blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
          },
        },
      },
      post: {
        title: null,
        body: null,
      },
      forms: {
        images_upload_url: "",
        files: [],
      },
    };
  },
  components: {
    editor: () => import("@tinymce/tinymce-vue"),
    uploadImage: () => import("vue-upload-image"),
  },
  methods: {
    uploadImageSuccess: function (result) {
      result[0]; // FormData
      result[1]; // response
    },
    uploadImageLoaded: function (image) {
      image.name || image.file;
    },
    uploadImageClicked: function (image) {
      image.name || image.file;
    },
    uploadImageRemoved: function (image) {
      image.name || image.file;
    },
    uploadImageSubmit: function (images) {
      console.log(images);
    },
  },
};
</script>

<style lang="scss">
.form-label {
  text-transform: capitalize;
  font-variant: small-caps;
  font-weight: 600;
  font-family: "Raleway";
}
.vue_component__upload--image {
  background-color: aliceblue;
  .upload_image_form__thumbnails {
    
  }
}
</style>