// Dropzone
$(function() {
  $('#dropzone-demo').dropzone({
    parallelUploads: 2,
    maxFilesize:     50000,
    filesizeBase:    1000,
    addRemoveLinks:  true,
  });
});