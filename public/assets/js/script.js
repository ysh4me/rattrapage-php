document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.getElementById('file');
    const imagePreview = document.getElementById('image-preview');
    const previewContainer = document.getElementById('image-preview-container');
    const fileUploadLabel = document.querySelector('.custum-file-upload');
    const deleteButton = document.createElement('button');

    deleteButton.textContent = '✖';
    deleteButton.className = 'delete-button';
    deleteButton.style.position = 'absolute';
    deleteButton.style.top = '0rem';
    deleteButton.style.right = '0rem';
    deleteButton.style.background = '#ff0000';
    deleteButton.style.color = 'white';
    deleteButton.style.border = 'none';
    deleteButton.style.borderRadius = '50%';
    deleteButton.style.width = '25px';
    deleteButton.style.height = '25px';
    deleteButton.style.cursor = 'pointer';
    deleteButton.style.display = 'none';

    previewContainer.style.position = 'relative';
    previewContainer.appendChild(deleteButton);

    fileInput.addEventListener('change', (event) => {
        const file = event.target.files[0];

        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();

            reader.onload = (e) => {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                previewContainer.style.display = 'flex';
                previewContainer.style.justifyContent = 'center';
                previewContainer.style.alignItems = 'center';

                fileUploadLabel.style.display = 'none';
                deleteButton.style.display = 'block'; 
            };

            reader.readAsDataURL(file);
        } else {
            resetPreview();
        }
    });

    deleteButton.addEventListener('click', (event) => {
        event.preventDefault(); 
        resetPreview();
    });

    function resetPreview() {
        imagePreview.src = '';
        imagePreview.style.display = 'none';
        fileUploadLabel.style.display = 'flex';
        deleteButton.style.display = 'none';
        fileInput.value = ''; 
    }
});
