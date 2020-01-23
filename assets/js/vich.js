const filePath = document.getElementById('history_imageFile_file')
    || document.getElementById('worker_imageFile_file')
    || document.getElementById('carousel_imageFile_file')
    || document.getElementById('article_imageFile_file')
    || document.getElementById('animation_imageFile_file');

function displayImageName() {
    if (filePath.value !== '') {
        const imageName = filePath.value.split('\\');
        const imageNameLast = imageName.pop();
        document.getElementById('displayVich').innerHTML = imageNameLast;
    }
}

filePath.addEventListener('change', () => {
    displayImageName();
});
