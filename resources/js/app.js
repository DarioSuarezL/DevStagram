import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone',{
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    maxFiles: 1,
    uploadMultiple: false,

    init: function(){ //Parche para que el dropzone sostenga la imagen mientras que los demás errores del form son remendados
        if(document.querySelector('[name="image"]').value.trim()){
            const postedImage = {};

            postedImage.size = 1000;
            postedImage.name = document.querySelector('[name="image"]').value;

            this.options.addedfile.call(this,postedImage);
            this.options.thumbnail.call(this,postedImage,`/uploads/${postedImage.name}`);
            postedImage.previewElement.classList.add("dz-success","dz-complete");
        }
    }
})

dropzone.on("success",function(file,response){
    console.log(response.image);
    document.querySelector('[name="image"]').value = response.image;
});

dropzone.on("removedfile",function(){
    document.querySelector('[name="image"]').value = "";
});