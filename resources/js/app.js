import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube tu imagen aqui",
    acceptedFiles: ".png, .jpg, .jpeg, .jfif, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,
    thumbnailWidth: 250,
    thumbnailHeight: 250,

    init: function(){
        if(document.querySelector('[name="imagen"]').value.trim()){
            
            const imgpublicada = {};
            imgpublicada.size = 123434;
            imgpublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imgpublicada);
            this.options.thumbnail.call(this, imgpublicada, `/upload/${imgpublicada.name}`);

            imgpublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    }
});

dropzone.on('removedfile', function () {
    document.querySelector('[name="imagen"]').value = "";

    
})


// dropzone.on('sending', function (file, xhr, formData) { 
//     console.log(file)
// })

// dropzone.on('sending', function (file, xhr, formData) { 
//     console.log(formData)
// })

dropzone.on('success', function (file, response) { 
    //console.log(response.imagen)
    document.querySelector('[name="imagen"]').value = response.imagen; //aca agregaremos el nombre con el id unico que le asignamos a la imagen al momento de subirlo a la base de datos
})

// dropzone.on('error', function (file, message) { 
//     console.log(message)
// })

