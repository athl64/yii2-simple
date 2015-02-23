$(document).ready(function() {
    
    /* upload files on click */
    $('#btn-send').click(function() {
        var frm = $('#fi').find('form')[0];
        var filesData = new FormData(frm);
        
        if(frm[2].files.length == 0) {
            $('#fi-state').html($('#fi-state').html() + '<div class="alert alert-danger" role="alert">no file selected</div>');
            return;
        }
        
        $.ajax({
            url: 'index.php?r=admin/silent-upload', 
            data: filesData,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST',
            xhr : function() {var xhr = new window.XMLHttpRequest(); xhr.upload.addEventListener("progress", function(evt){ if (evt.lengthComputable) { var percentComplete = evt.loaded / evt.total * 100; setProgressBarValue('pBar', Math.round(percentComplete)); /*console.log(percentComplete);*/ } }, false); return xhr;},
            success: function(data, status){
                if(data == 'OK') {
                    $('#fi-state').html('<div class="alert alert-success" role="alert">files uploaded</div>');
                    frm.reset();
                } else {
                    $('#fi-state').html('<div class="alert alert-danger" role="alert">error</div>');
                    return;
                }
            }
            });
            showProgressBar('fi-state', 'pBar');
    });
    
    /* remove file from server */
   $('button').click(function() {
       if(this.attributes.f != undefined && this.attributes.f != null) {
           if(confirm('realy delete: ' + this.attributes.f.value + '?')) {
               $.post("index.php?r=admin/silent-remove",
               {
                   f_path: this.attributes.f.value
               },
               function(data, status){
                    $('#fi-state').html('<div class="alert alert-info" role="alert">deleted</div>');
               });
           }
       } else {
           return;
       }
   });
    
    /* show list of selected files */
   $('#fi input').change(function() {
       var wrap = $('#fi-state');
       var list = document.createElement('ul');
       var totalSize = 0;
       list.setAttribute('class','list-group');
       for(var i = 0; i < this.files.length; i++) {
           var size =  '<br /><span class="label label-default">' + Math.round(this.files[i].size / 1024) + ' KB</span>';
           list.innerHTML += '<li class="list-group-item word-wrap">' + this.files[i].name + size + '</li>';
           totalSize += this.files[i].size;
       }
       totalSize = '<span class="badge">' + Math.round(totalSize / 1024) + ' KB</span>';
       list.innerHTML += '<li class="list-group-item word-wrap">total files size: ' + totalSize + '</li>';
       wrap.html('');
       wrap.append(list);
   });
   
});

/* id - id of container to insert bar; wrapId - outer container id */
function showProgressBar(wrapId, id) {
    var wrap = $('#' + wrapId);
    wrap.html('<div class="progress" id="' + id + '"><div class="progress-bar progress-bar-info" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="min-width: 3em;"></div></div>');
}

/* progress bar id to remove*/
function HideProgressBar(id) {
    /* currently no needed */
}

/* progress bar id */
function setProgressBarValue(id, value) {
    if($('#' + id) != undefined) {
        $('#' + id).children('div').css('width', value + '%').attr('aria-valuenow', value);
        $('#' + id).children('div').html(value + '%');
    }
}

function getFileLink(func, url) {
    window.opener.CKEDITOR.tools.callFunction(func, url,'');
    window.close();
}
