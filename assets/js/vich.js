let filePath = document.getElementById('history_imageFile_file');


filePath.onchange = function displayImageName() {
    if (filePath.value !== '') {
        let imageName = filePath.value.split('\\');
        let imageNameLast = imageName.pop();
        let vich = document.getElementById('displayVich').innerHTML = imageNameLast;
        vich.textContent;
    }
};

