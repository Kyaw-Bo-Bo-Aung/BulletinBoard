let csv_file = document.getElementById('csv-input');
let preview_img = document.getElementById('preview-img');
let preview_img_info = document.getElementById('preview-img-info');
let close_preview_btn = document.getElementById('close-preview-file-btn');
let upload_form_div = document.getElementById('upload-form');

// console.log(preview_file);
csv_file.addEventListener('change', function (e) {
    preview_img.classList.remove('d-none');
    close_preview_btn.classList.remove('d-none');
    preview_img_info.innerText = e.target.files[0].name + ' (' + e.target.files[0].size / 100 + ' kB)';
    upload_form_div.classList.add('d-none');

})

close_preview_btn.addEventListener('click', function (e) {
    csv_file.value = '';
    preview_img.classList.add('d-none');
    close_preview_btn.classList.add('d-none');
    preview_img_info.innerText = '';
    upload_form_div.classList.remove('d-none');
})

let drop_zone = document.getElementById('drop_zone');
// console.log(drop_zone);

drop_zone.addEventListener('dragover', function(e) {
    e.preventDefault();
    e.stopPropagation();
})

drop_zone.addEventListener('drop', function(e) {
    e.preventDefault();
    document.getElementById('csv-input').files = e.dataTransfer.files;
    preview_img.classList.remove('d-none');
    close_preview_btn.classList.remove('d-none');
    preview_img_info.innerText = e.dataTransfer.files[0].name + ' (' + e.dataTransfer.files[0].size / 100 + ' kB)';
    upload_form_div.classList.add('d-none');

})
